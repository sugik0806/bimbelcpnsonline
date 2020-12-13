<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian extends CI_Controller {

	public $mhs, $user;

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->helper('my');
		$this->load->model('Master_model', 'master');
		$this->load->model('Soal_model', 'soal');
		$this->load->model('Ujian_model', 'ujian');
		$this->form_validation->set_error_delimiters('','');

		$this->user = $this->ion_auth->user()->row();
		$this->mhs 	= $this->ujian->getIdMahasiswa($this->user->username);
    }

    public function akses_dosen()
    {
        if ( !$this->ion_auth->in_group('dosen') ){
			show_error('Halaman ini khusus untuk dosen untuk membuat Test Online, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function akses_mahasiswa()
    {
        if ( !$this->ion_auth->in_group('mahasiswa') ){
			show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
    }

    public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
	}
	
	public function json($id=null)
	{
        $this->akses_dosen();

		$this->output_json($this->ujian->getDataUjian($id), false);
	}

    public function master()
	{
        $this->akses_dosen();
        $user = $this->ion_auth->user()->row();
        $data = [
			'user' => $user,
			'judul'	=> 'Tryout',
			'subjudul'=> 'Data Tryout',
			'dosen' => $this->ujian->getIdDosen($user->username),
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function add()
	{
		$this->akses_dosen();
		
		$user = $this->ion_auth->user()->row();

        $data = [
			'user' 		=> $user,
			'judul'		=> 'Tryout',
			'subjudul'	=> 'Tambah Tryout',
			//'matkul'	=> $this->master->getAllMatkul($user->username),
			'dosen'		=> $this->ujian->getIdDosen($user->username),
		];
		$data['matkul'] = $this->master->getAllMatkul();
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}
	
	public function edit($id)
	{
		$this->akses_dosen();
		
		$user = $this->ion_auth->user()->row();

        $data = [
			'user' 		=> $user,
			'judul'		=> 'Tryout',
			'subjudul'	=> 'Edit Tryout',
			//'matkul'	=> $this->master->getMatkulDosen($user->username),
			'dosen'		=> $this->ujian->getIdDosen($user->username),
			'ujian'		=> $this->ujian->getUjianById($id),
		];
		$data['matkul'] = $this->master->getAllMatkul();

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function convert_tgl($tgl)
	{
		$this->akses_dosen();
		return date('Y-m-d H:i:s', strtotime($tgl));
	}

	public function validasi()
	{
		$this->akses_dosen();
		
		$user 	= $this->ion_auth->user()->row();
		$dosen 	= $this->ujian->getIdDosen($user->username);
		$jml 	= $this->ujian->getJumlahSoal($dosen->id_dosen)->jml_soal;
		$jml_a 	= $jml + 1; // Jika tidak mengerti, silahkan baca user_guide codeigniter tentang form_validation pada bagian less_than

		$this->form_validation->set_rules('nama_ujian', 'Nama Ujian', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('matkul_id', 'Nama Bimbingan', 'required');

		$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', "required|integer|less_than[{$jml_a}]|greater_than[0]", ['less_than' => "Soal tidak cukup, anda hanya punya {$jml} soal"]);
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
		$this->form_validation->set_rules('waktu', 'Waktu', 'required|integer|max_length[4]|greater_than[0]');
		$this->form_validation->set_rules('jenis', 'Acak Soal', 'required|in_list[acak,urut]');
	}

	public function save()
	{
		$this->validasi();
		$this->load->helper('string');

		$method 		= $this->input->post('method', true);
		$dosen_id 		= $this->input->post('dosen_id', true);
		$matkul_id 		= $this->input->post('matkul_id', true);
		$nama_ujian 	= $this->input->post('nama_ujian', true);
		$jumlah_soal 	= $this->input->post('jumlah_soal', true);
		$tgl_mulai 		= $this->convert_tgl($this->input->post('tgl_mulai', 	true));
		$tgl_selesai	= $this->convert_tgl($this->input->post('tgl_selesai', true));
		$waktu			= $this->input->post('waktu', true);
		$jenis			= $this->input->post('jenis', true);
		$token 			= strtoupper(random_string('alpha', 5));

		if( $this->form_validation->run() === FALSE ){
			$data['status'] = false;
			$data['errors'] = [
				'nama_ujian' 	=> form_error('nama_ujian'),
				'jumlah_soal' 	=> form_error('jumlah_soal'),
				'tgl_mulai' 	=> form_error('tgl_mulai'),
				'tgl_selesai' 	=> form_error('tgl_selesai'),
				'waktu' 		=> form_error('waktu'),
				'jenis' 		=> form_error('jenis'),
				'matkul_id' 	=> form_error('matkul_id'),
			];
		}else{
			$input = [
				'nama_ujian' 	=> $nama_ujian,
				'jumlah_soal' 	=> $jumlah_soal,
				'tgl_mulai' 	=> $tgl_mulai,
				'terlambat' 	=> $tgl_selesai,
				'waktu' 		=> $waktu,
				'jenis' 		=> $jenis,
			];
			if($method === 'add'){
				$input['dosen_id']	= $dosen_id;
				$input['matkul_id'] = $matkul_id;
				$input['token']		= $token;
				$input['terbit']	= 0;
				$action = $this->master->create('m_ujian', $input);
			}else if($method === 'edit'){
				$id_ujian = $this->input->post('id_ujian', true);
				$input['matkul_id'] = $matkul_id;
				$input['terbit']	= $this->input->post('terbit_id', true);
				$action = $this->master->update('m_ujian', $input, 'id_ujian', $id_ujian);
			}
			$data['status'] = $action ? TRUE : FALSE;
		}
		$this->output_json($data);
	}

	public function delete()
	{
		$this->akses_dosen();
		$chk = $this->input->post('checked', true);
        if(!$chk){
            $this->output_json(['status'=>false]);
        }else{
            if($this->master->delete('m_ujian', $chk, 'id_ujian')){
                $this->output_json(['status'=>true, 'total'=>count($chk)]);
            }
        }
	}

	public function refresh_token($id)
	{
		$this->load->helper('string');
		$data['token'] = strtoupper(random_string('alpha', 5));
		$refresh = $this->master->update('m_ujian', $data, 'id_ujian', $id);
		$data['status'] = $refresh ? TRUE : FALSE;
		$this->output_json($data);
	}

	/**
	 * BAGIAN MAHASISWA
	 */

	public function list_json()
	{
		$this->akses_mahasiswa();
		
		$list = $this->ujian->getListUjian($this->mhs->id_mahasiswa, $this->mhs->kelas_id, $this->mhs->id_matkul);
		$this->output_json($list, false);
	}
	
	public function list()
	{
		$this->akses_mahasiswa();

		$user = $this->ion_auth->user()->row();

		$list = $this->ujian->getListUjianbox($this->mhs->id_mahasiswa, $this->mhs->kelas_id, $this->mhs->id_matkul);
		
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Tryout',
			'subjudul'	=> 'List Tryout',
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'list' => $list
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/list');
		$this->load->view('_templates/dashboard/_footer.php');
	}
	
	public function token($id)
	{
		$this->akses_mahasiswa();
		$user = $this->ion_auth->user()->row();
		
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Tryout',
			'subjudul'	=> 'Token Tryout',
			'nama_ujian' => $this->ujian->getUjianById($id)->nama_ujian,
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'ujian'		=> $this->ujian->getUjianById($id),
			'encrypted_id' => urlencode($this->encryption->encrypt($id)),
			'url'		=> $this->uri->segment('4')
		];

		if ($data['url']) {
			$input['review'] = 'Y';
			$where = [
				'ujian_id' 		=> $id,
				'mahasiswa_id' 	=> $this->mhs->id_mahasiswa
			];
			$action = $this->ujian->updateStatus($input, $where);
		}
		
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/token');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function cektoken()
	{
		$id = $this->input->post('id_ujian', true);
		$token = $this->input->post('token', true);
		$cek = $this->ujian->getUjianById($id);
		
		$data['status'] = $token === $cek->token ? TRUE : FALSE;
		$this->output_json($data);
	}

	public function encrypt()
	{
		$id = $this->input->post('id', true);
		$key = urlencode($this->encryption->encrypt($id));
		$this->output_json(['key'=>$key]);
	}

	public function index()
	{
		$this->akses_mahasiswa();
		$key = $this->input->get('key', true);
		$id  = $this->encryption->decrypt(rawurldecode($key));
		
		$ujian 		= $this->ujian->getUjianById($id);

		if ($ujian->id_matkul == 1) {
			$soal = $this->ujian->getSoalSKB($id);
		}elseif ($ujian->id_matkul == 2){
			$soalTWK	= $this->ujian->getSoal($id);
			$soalTIU 	= $this->ujian->getSoalTIU($id);
			$soalTKP 	= $this->ujian->getSoalTKP($id);

			$soal = array_merge($soalTWK, $soalTIU, $soalTKP);
		}

		$mhs		= $this->mhs;
		$h_ujian 	= $this->ujian->HslUjian($id, $mhs->id_mahasiswa);
	
		$cek_sudah_ikut = $h_ujian->num_rows();

		if ($cek_sudah_ikut < 1) {
			$soal_urut_ok 	= array();
			$i = 0;
			foreach ($soal as $s) {
				$soal_per = new stdClass();
				$soal_per->id_soal 		= $s->id_soal;
				$soal_per->soal 		= $s->soal;
				$soal_per->file 		= $s->file;
				$soal_per->tipe_file 	= $s->tipe_file;
				$soal_per->opsi_a 		= $s->opsi_a;
				$soal_per->opsi_b 		= $s->opsi_b;
				$soal_per->opsi_c 		= $s->opsi_c;
				$soal_per->opsi_d 		= $s->opsi_d;
				$soal_per->opsi_e 		= $s->opsi_e;
				$soal_per->jawaban 		= $s->jawaban;
				$soal_urut_ok[$i] 		= $soal_per;
				$i++;
			}
			$soal_urut_ok 	= $soal_urut_ok;
			$list_id_soal	= "";
			$list_jw_soal 	= "";
			if (!empty($soal)) {
				foreach ($soal as $d) {
					$list_id_soal .= $d->id_soal.",";
					$list_jw_soal .= $d->id_soal."::N,";
				}
			}
			$list_id_soal 	= substr($list_id_soal, 0, -1);
			$list_jw_soal 	= substr($list_jw_soal, 0, -1);
			$waktu_selesai 	= date('Y-m-d H:i:s', strtotime("+{$ujian->waktu} minute"));
			$time_mulai		= date('Y-m-d H:i:s');

			$input = [
				'ujian_id' 		=> $id,
				'mahasiswa_id'	=> $mhs->id_mahasiswa,
				'list_soal'		=> $list_id_soal,
				'list_jawaban' 	=> $list_jw_soal,
				'jml_benar'		=> 0,
				'nilai'			=> 0,
				'nilai_bobot'	=> 0,
				'tgl_mulai'		=> $time_mulai,
				'tgl_selesai'	=> $waktu_selesai,
				'status'		=> 'Y'
			];
			$this->master->create('h_ujian', $input);

			// Setelah insert wajib refresh dulu
			redirect('ujian/?key='.urlencode($key), 'location', 301);
		}
		
		$q_soal = $h_ujian->row();
		
		$urut_soal 		= explode(",", $q_soal->list_jawaban);
		$soal_urut_ok	= array();
		for ($i = 0; $i < sizeof($urut_soal); $i++) {
			$pc_urut_soal	= explode(":",$urut_soal[$i]);
			$pc_urut_soal1 	= empty($pc_urut_soal[1]) ? "''" : "'{$pc_urut_soal[1]}'";
			$ambil_soal 	= $this->ujian->ambilSoal($pc_urut_soal1, $pc_urut_soal[0]);
			$soal_urut_ok[] = $ambil_soal; 

		}

		$detail_tes = $q_soal;
		$soal_urut_ok = $soal_urut_ok;

		$pc_list_jawaban = explode(",", $detail_tes->list_jawaban);
		$arr_jawab = array();
		foreach ($pc_list_jawaban as $v) {
			$pc_v 	= explode(":", $v);
			$idx 	= $pc_v[0];
			$val 	= $pc_v[1];
			$rg 	= $pc_v[2];

			$arr_jawab[$idx] = array("j"=>$val,"r"=>$rg);
		}

		$arr_opsi = array("a","b","c","d","e");
		$abjad = ['a', 'b', 'c', 'd', 'e'];
		$html = '';
		$no = 1;
		$cxk = 1;
		$jawaban_benar = "";

if (!empty($soal_urut_ok)) {
			$tampilUser = "";
			$tampilPem = "";

	foreach ($soal_urut_ok as $s) {

		if ($q_soal->review == "Y") {
			$count = 0;
			$per = $this->ujian->getPertanyaan($q_soal->id, $mhs->id_mahasiswa, $s->id_soal);

			$totalper = $this->ujian->getJumlahPertanyaan($q_soal->id, $mhs->id_mahasiswa, $s->id_soal);

			foreach ($per as $key) {
				if ($key->id_soal == $s->id_soal && !empty($key->pertanyaan)) {
					// print_r($key->pertanyaan);
					// print_r($key->id_pertanyaan);
					$jawaban = '
					    	      <div class="direct-chat-msg left">
									  <div class="direct-chat-info clearfix">
									    <span class="direct-chat-name pull-left">Pembimbing</span>
									    <span class="direct-chat-timestamp pull-right"></span>
									  </div>
									  <img class="direct-chat-img" src="../assets/dist/img/b.png" alt="message user image pull-left">

									  <div class="direct-chat-text">
									   Belum ada jawaban dari pembimbing.. !
									  </div>

									</div>
									';
					if ($key->jawaban) {
						$jawaban = '
					    	      <div class="direct-chat-msg left">
									  <div class="direct-chat-info clearfix">
									    <span class="direct-chat-name pull-left">Pembimbing</span>
									    <span class="direct-chat-timestamp pull-right">'.$key->answer_date.'</span>
									  </div>
									  <img class="direct-chat-img" src="../assets/dist/img/b.png" alt="message user image pull-left">

									  <div class="direct-chat-text" style="background: #CFFFD7">
									   '.$key->jawaban.'
									  </div>

									</div>
						';
					}

					$tampilUser .= 
					'
			    	      <div class="direct-chat-msg right">
			    	        <div class="direct-chat-info clearfix">
			    	          <span class="direct-chat-name pull-right">Anda</span>
			    	          <span class="direct-chat-timestamp pull-left">'.$key->created_date.'</span>
			    	        </div>


			    	        <img class="direct-chat-img pull-right" src="../assets/dist/img/b.png" alt="message user image">

			    	        <div class="direct-chat-text" style="background: #C8D5FF">
			    	         '.$key->pertanyaan.'
			    	        </div>

			    	      </div>

			    	      '.$jawaban.'
			    	    '
					;

					
				}else{
					$tampilUser = "";
				}


				// if ($key->id_soal == $s->id_soal && !empty($key->jawaban)) {
				// 	// print_r($key->pertanyaan);
				// 	// print_r($key->id_pertanyaan);

				// 	$tampilPem .= 
				// 			'
				// 			<div class="direct-chat-msg left">
				// 			  <div class="direct-chat-info clearfix">
				// 			    <span class="direct-chat-name pull-left">Pembimbing</span>
				// 			    <span class="direct-chat-timestamp pull-right">'.$key->created_date.'</span>
				// 			  </div>
				// 			  <img class="direct-chat-img" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="message user image">

				// 			  <div class="direct-chat-text bg-danger">
				// 			   '.$key->jawaban.'
				// 			  </div>

				// 			</div>
				// 			'
				// 		;
				// }else{
				// 	$tampilPem = "";
				// }
				
				
			}
		}

		$path = 'uploads/bank_soal/';
		$vrg = $arr_jawab[$s->id_soal]["r"] == "" ? "N" : $arr_jawab[$s->id_soal]["r"];

		$html .= '<input type="hidden" name="id_soal_'.$no.'" value="'.$s->id_soal.'">';
		$html .= '<input type="hidden" name="rg_'.$no.'" id="rg_'.$no.'" value="'.$vrg.'">';
		

		$html .= '<div class="step" id="widget_'.$no.'">';

		$html .= '
		<div class="text-center">
			<div class="w-25">'.tampil_media($path.$s->file).'</div>
		</div>

		'.$s->soal.'
			<h3 class="box-title">
				<span class="badge bg-green">
					<span id="jenis">'.$s->tipe.'</span> 
				</span>
			</h3>'.'

		<!-- start pilihan jawaban -->
		<div class="funkyradio">
			';

			for ($j = 0; $j < $this->config->item('jml_opsi'); $j++) {
				$opsi 			= "opsi_".$arr_opsi[$j];
				$file 			= "file_".$arr_opsi[$j];
				
				//if ($q_soal->status === "Y") {
				$checked 	= $arr_jawab[$s->id_soal]["j"] == strtoupper($arr_opsi[$j]) ? "checked" : "";

				if (!empty($s->jawaban[1])) {
					$ek 	= explode(",", $s->jawaban);
					foreach ($ek as $k) {
						$n = $k[2];
						if ($n == 5) {
							$jawaban_benar = $k[0];
							
						}
						
					}
					
				}else{
					$jawaban_benar = $s->jawaban;
				}

				$klas 	= $jawaban_benar == $s->jawabanpc ? "success" : "danger";

				

				// $html .= '<div class="w-25">'.$jawaban_benar.$s->jawabanpc.'</div>';

				if ($s->pembahasan != null && $q_soal->review == "Y") {
					$penjelasan = "<hr><b>Pembahasan:</b> </br></br>".$s->pembahasan. "</br>"; 
				}else{
					$penjelasan = "</br>";
				}
		
				
	            $pilihan_opsi 	= !empty($s->$opsi) ? $s->$opsi : "";

	            
				$tampil_media_opsi = (is_file(base_url().$path.$s->$file) || $s->$file != "") ? tampil_media($path.$s->$file) : "";

				$q_soal->review != "Y" ? 
					$html .= 
					'
					<div class="funkyradio-success" onclick="return simpan_sementara();">
						<input type="radio" id="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id_soal.'" name="opsi_'.$no.'" value="'.strtoupper($arr_opsi[$j]).'" '.$checked.'> 

						<label for="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id_soal.'">
							<div class="huruf_opsi">'.$arr_opsi[$j].'</div> 
							<p>'.$pilihan_opsi.'</p>
							<div class="w-25">'.$tampil_media_opsi.'</div>
						</label>
					</div>
			 		'
			 		:

					$html .= 
					'
					<div class="funkyradio-'.$klas.'" onclick="return simpan_sementara();">
						<input type="radio" id="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id_soal.'" name="opsi_'.$no.'" value="'.strtoupper($arr_opsi[$j]).'" '.$checked.'>

						<label for="opsi_'.strtolower($arr_opsi[$j]).'_'.$s->id_soal.'">
							<div class="huruf_opsi">'.$arr_opsi[$j].'</div> 
							<p>'.$pilihan_opsi.'</p>
							<div class="w-25">'.$tampil_media_opsi.'</div>
						</label>
					</div>
			 		';
			 		  
				; 		  

			}
			

			if ($q_soal->review == "Y") {

				// $html .= '<div class="box-footer text-center">
				//     <a class="action back btn btn-info" rel="0" onclick="return back();"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
				//     <a class="ragu_ragu btn btn-warning" rel="1" onclick="return tidak_jawab();">Ragu-ragu</a>
				//     <a class="action next btn btn-info" rel="2" onclick="return next();"><i class="glyphicon glyphicon-chevron-right"></i> Next</a>
				//     <a class="selesai action submit btn btn-danger" onclick="return simpan_akhir();"><i class="glyphicon glyphicon-stop"></i> Selesai</a>
				//     <input type="hidden" name="jml_soal" id="jml_soal" value="'.$no.'">
				// </div>';
				if ( $s->tipe == "TKP") {
					$nilaiBenar = ' <span class="badge bg-blue">'.$s->jawaban.'</span>';
				}else{
					$nilaiBenar = "";
				}

				$html .= '
				<br><span class="badge bg-green">'.'<b>Jawaban Benar : '.$jawaban_benar.'</b>'.'</span>'.$nilaiBenar.$penjelasan . '<br>';


						

				$html .= '<input type="hidden" class="form-control" value="'.$klas.'" placeholder="'.$klas.'" id="jawaban_benar_'.$no.'" name="jawaban_benar_'.$no.'">';		

			}
			if ($mhs->id_mahasiswa == 1 && $q_soal->review != "Y"){
				$html .= '
				<br><span class="badge bg-yellow">'.'<b>Jawaban Benar : '.$jawaban_benar.'</b>'.'</span>';
			}

			if ($mhs->id_mahasiswa == 1 && $q_soal->review == "Y"){
				$html .= '<a class="btn btn-warning btn_soal btn-sm" style="margin-bottom: 15px" onclick="return modeNormal('.$id.');">Ke Mode Ujian</a>';
			}

		$html .= '</div>  <!-- end pilihan jawaban -->';

			if ($q_soal->review == "Y") {

				$html .= 
				'
				<!-- start chat -->
				<div class="box box-success collapsed-box direct-chat">
				  <div class="box-header with-border">
				    <h3 class="box-title">Pertanyaan</h3>
				    <div class="box-tools pull-right">
				    <!--span data-toggle="tooltip" title="ada '.$s->id_soal.' Pertanyaan" class="badge bg-yellow">'.$s->id_soal.'</span-->
				      <span data-toggle="tooltip" title="ada '.$totalper->jml_pertanyaan.' Pertanyaan" class="badge bg-red">'.$totalper->jml_pertanyaan.'</span>
				      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i> Buka / Tutup</button>
				    
				      <!--button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
				      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
				    </div>
				  </div>
				  <div class="box-body">
				   
				    <div class="direct-chat-messages">
				     
				      <div class="direct-chat-msg">
				       
				        <!--img class="direct-chat-img" src="../assets/dist/img/b.png" alt="message user image"-->
				        <div class="direct-chat-text" style="background: #ffffff">
				          '.$tampilUser.'
				        </div>
				      </div>

				     
				      <div class="direct-chat-msg">
				        <div class="direct-chat-info clearfix">
				          <span class="direct-chat-name">Admin</span>
				          <span class="direct-chat-timestamp pull-right"></span>
				        </div>
				        <img class="direct-chat-img" src="../assets/dist/img/b.png" alt="message user image">
				        <div class="direct-chat-text bg-yellow">
				          Periksa pertanyaan anda sebelumnya, sebelum bertanya lagi...!
				        </div>
				      </div>
				    </div>

				    
				    <div class="direct-chat-contacts">
				      <ul class="contacts-list">
				        <li>
				          <a href="#">
				            <img class="contacts-list-img" src="../assets/dist/img/b.png" alt="Contact Avatar">
				            <div class="contacts-list-info">
				              <span class="contacts-list-name">
				                Count Dracula
				                <small class="contacts-list-date pull-right">2/28/2015</small>
				              </span>
				              <span class="contacts-list-msg">How have you been? I was...</span>
				            </div>
				          </a>
				        </li>
				      </ul>
				    </div>
				  </div>
				  <div class="box-footer">
				    <div class="input-group">
		    	      <textarea rows="1" class="form-control" placeholder="Tulis Pertanyaan" id="pertanyaan_'.$no.'" name="pertanyaan_'.$no.'"></textarea>
		    	      <span class="input-group-btn">
		    	        <button type="button" class="btn btn-success btn-flat"  onclick="return pertanyaan();">Kirim</button>
		    	      </span>
		    	    </div>
				  </div>
				</div>

				<!-- end chat -->
				';
			
			}

		
			$html .= '</div>';
			$no++;
	}
}

		// Enkripsi Id Tes
		$id_tes = $this->encryption->encrypt($detail_tes->id);

		$data = [
			'user' 		=> $this->user,
			'mhs'		=> $this->mhs,
			'judul'		=> 'Tryout',
			'subjudul'	=> 'Lembar Tryout',
			'nama_ujian' => $ujian->nama_ujian,
			'soal'		=> $detail_tes,
			'no' 		=> $no,
			'html' 		=> $html,
			'id_tes'	=> $id_tes,
			'id_user'	=> $mhs->id_mahasiswa

		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/sheet');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function modeNormal()
	{
		$id = $this->input->post('id', true);
		
		$dd = date("d");
		$mm = date("m");
		$yy = date("y");
		$h = date("H");
		$i = date("i");
		$s = date("s");
		$hplus = $h + 1;

			$d_update = [
				
				'review' => 'N',
				'status' => 'Y',
				'tgl_selesai'=> $yy.'-'.$mm.'-'.$dd.' '.$hplus.':'.$i.':'.$s
 
				
			];
			$where = [
				'ujian_id' =>$this->input->post('id', true)
			];

			$this->ujian->modeNormal($d_update, $where);
		 $this->output_json(['status'=>true]);
	}

	public function pertanyaan($id_count)
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);

		$mhs	  = $this->mhs;
		$ujian 	  = $this->ujian->HslUjianStatus($id_tes, $mhs->id_mahasiswa);

		if ($ujian->review == 'Y') {
			$input 	= $this->input->post(null, true);
			$list_jawaban 	= "";
			$cek_pertanyaan = $this->ujian->getPertanyaanBy($id_tes, $mhs->id_mahasiswa);

			for ($i = 1; $i < $input['jml_soal']; $i++) {
				//print_r($input['jml_soal']-1);
				$_tidsoal 	= "id_soal_".$i;
				$_pertanyaan = "pertanyaan_".$i;

				$d_simpan = [
					'id_soal' => $input[$_tidsoal] ,
					'pertanyaan' => $input[$_pertanyaan],
					'id_test' => $id_tes,
					'id_mahasiswa' => $mhs->id_mahasiswa,
					'created_date' => date('Y-m-d H:i:s')
				];

				$d_update = [
					
					'pertanyaan' => $input[$_pertanyaan],
					'created_date' => date('Y-m-d H:i:s')
					
				];

				$where = [
					'id_soal' => $input[$_tidsoal] ,
					'id_test' => $id_tes,
					'id_mahasiswa' => $mhs->id_mahasiswa
				];

				if (empty($cek_pertanyaan)) {
					$this->master->create('pertanyaan_detail', $d_simpan);
				}
				if ($i == $id_count) {
						//print_r($i.' ->'.$id_count);
						$this->master->create('pertanyaan_detail', $d_simpan);
						
				}

				// if ($i == $id_count) {
				// 		//print_r($i.' ->'.$id_count);
				// 		$this->ujian->updatePertanyaan($d_update, $where);
						
				// }

			}

			 $this->output_json(['status'=>true]);
		}

		
	}

	public function kirim()
	{
		$id = $this->input->post('id', true);
		$mes = $this->input->post('mes', true);


			$d_update = [
				
				'jawaban' => $mes,
				'answer_date' => date('Y-m-d H:i:s')
				
			];

			$where = [
				'id_pertanyaan' =>$this->input->post('id', true)
			];

			$this->ujian->updatePertanyaan1($d_update, $where);
		 $this->output_json(['status'=>true]);
	}

	public function jawabpertanyaan()
	{
		$this->akses_dosen();

		$user = $this->ion_auth->user()->row();

		//$per = $this->ujian->getPertanyaanAll(2);
		//$path = 'uploads/bank_soal/';

		// foreach ($per as $key) {
		// 	$v = explode(",", $key->list_jawaban);
		// 	foreach ($v as $ke) {
		// 		$pc_v 	= explode(":", $ke);
		// 		if ($key->id_soal == $pc_v[0] ) {

		// 			$key->jawabanmhs = $pc_v[1];
		// 			$key->fileimage = base_url().$path.$key->file;

					
		// 			if (!empty($key->jawaban_benar[1])) {
		// 				$ek 	= explode(",", $key->jawaban_benar);
		// 				foreach ($ek as $k) {
		// 					$n = $k[2];
		// 					if ($n == 5) {
		// 						$jwb = $k[0];
		// 						//print_r($jwb);
		// 						$file_ = "file_".strtolower($jwb);
		// 						$opsi_ = "opsi_".strtolower($jwb);
		// 					}
							
		// 				}
						
		// 			}else{
		// 				$file_ = "file_".strtolower($key->jawaban_benar);
		// 				$opsi_ = "opsi_".strtolower($key->jawaban_benar);
		// 			}
					
		// 			$key->fileimagejwb = base_url().$path.$key->$file_;

		// 			$file_mhs = "file_".strtolower($key->jawabanmhs);
		// 			$key->fileimagemhs = base_url().$path.$key->$file_mhs;


					
		// 			$key->opsi = $key->$opsi_;

		// 			$opsi_mhs = "opsi_".strtolower($key->jawabanmhs);
		// 			$key->opsimhs = $key->$opsi_mhs;

		// 		}

		// 	}
		// }

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Jawab Pertanyaan',
			'subjudul'	=> 'Jawab Pertanyaan Peserta',
			//'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			//'list' => $per
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/jawabpertanyaan');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function datapertanyaan($id)
	{
		$this->akses_dosen();

		$user = $this->ion_auth->user()->row();

		$per = $this->ujian->getPertanyaanAll($id);
		$path = 'uploads/bank_soal/';
		//print_r($per);

		foreach ($per as $key) {
			$v = explode(",", $key->list_jawaban);
			foreach ($v as $ke) {
				$pc_v 	= explode(":", $ke);
				if ($key->id_soal == $pc_v[0] ) {

					$key->jawabanmhs = $pc_v[1];
					$key->fileimage = base_url().$path.$key->file;

					if (!empty($key->jawaban_benar[1])) {
						$ek 	= explode(",", $key->jawaban_benar);
						foreach ($ek as $k) {
							$n = $k[2];
							if ($n == 5) {
								$jwb = $k[0];
								//print_r($jwb);
								$file_ = "file_".strtolower($jwb);
								$opsi_ = "opsi_".strtolower($jwb);
							}
							
						}
						
					}else{
						$file_ = "file_".strtolower($key->jawaban_benar);
						$opsi_ = "opsi_".strtolower($key->jawaban_benar);
					}

					//$file_ = "file_".strtolower($key->jawaban_benar);
					$key->fileimagejwb = base_url().$path.$key->$file_;

					$file_mhs = "file_".strtolower($key->jawabanmhs);
					$key->fileimagemhs = base_url().$path.$key->$file_mhs;


					//$opsi_ = "opsi_".strtolower($key->jawaban_benar);
					$key->opsi = $key->$opsi_;

					$opsi_mhs = "opsi_".strtolower($key->jawabanmhs);
					$key->opsimhs = $key->$opsi_mhs;

				}

			}
		}

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Jawab Pertanyaan',
			'subjudul'	=> 'Jawab Pertanyaan',
			//'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'list' => $per
		];

		$this->output_json($per);
		
	}

	public function simpan_satu()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);

		$mhs	  = $this->mhs;
		$ujian 	  = $this->ujian->HslUjianStatus($id_tes, $mhs->id_mahasiswa);

		if ($ujian->status == 'Y') {
			$input 	= $this->input->post(null, true);
			$list_jawaban 	= "";
			for ($i = 1; $i < $input['jml_soal']; $i++) {
				$_tjawab 	= "opsi_".$i;
				$_tidsoal 	= "id_soal_".$i;
				$_ragu 		= "rg_".$i;
				$jawaban_ 	= empty($input[$_tjawab]) ? "" : $input[$_tjawab];
				$list_jawaban	.= "".$input[$_tidsoal].":".$jawaban_.":".$input[$_ragu].",";
			}
			$list_jawaban	= substr($list_jawaban, 0, -1);
			$d_simpan = [
				'list_jawaban' => $list_jawaban
			];
			
			// Simpan jawaban
			$this->master->update('h_ujian', $d_simpan, 'id', $id_tes);
			$this->output_json(['status'=>true]);
		}

		
	}

	public function simpan_akhir()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		print_r($id_tes);
		$id_tes = $this->encryption->decrypt($id_tes);
		$mhs	  = $this->mhs;
		$ujian 	  = $this->ujian->HslUjianStatus($id_tes, $mhs->id_mahasiswa);

		if ($ujian->status == 'Y') {
			// Get Jawaban
			$list_jawaban = $this->ujian->getJawaban($id_tes);

			// Pecah Jawaban
			$pc_jawaban = explode(",", $list_jawaban);
			
			$jumlah_benar 	= 0;
			$jumlah_salah 	= 0;
			$jumlah_ragu  	= 0;
			$nilai_bobot 	= 0;
			$total_bobot	= 0;
			$total_bobot_twk	= 0;
			$total_bobot_tiu	= 0;
			$total_bobot_tkp	= 0;
			$jumlah_soal	= sizeof($pc_jawaban);

			foreach ($pc_jawaban as $jwb) {
				$pc_dt 		= explode(":", $jwb);
				$id_soal 	= $pc_dt[0];
				$jawaban 	= $pc_dt[1];
				$ragu 		= $pc_dt[2];

				$cek_jwb 	= $this->soal->getSoalById($id_soal);
				
				if ($cek_jwb->tipe <> 3) {
					if ($jawaban == $cek_jwb->jawaban) {
						$total_bobot = $total_bobot + $cek_jwb->bobot;
						$jumlah_benar++;

						if ($cek_jwb->tipe == 1) {//jika twk
							$total_bobot_twk = $total_bobot_twk + $cek_jwb->bobot;
						}else if ($cek_jwb->tipe == 2) {//jika tiu
							$total_bobot_tiu = $total_bobot_tiu + $cek_jwb->bobot;
						}

					}else{
						$jumlah_salah++;
					}
				}else{//jika tkp

					$jaw = explode(",",$cek_jwb->jawaban);

					$arru = 0;
					foreach ($jaw as $key) {
						$ex_key = explode(":", $key);
							if ($jawaban == $ex_key[0]) {
						 		
						 		$total_bobot = $total_bobot + $ex_key[1];
						 		$total_bobot_tkp = $total_bobot_tkp + $ex_key[1];
						 		//print_r($ex_key[1]);
						 		if ($ex_key[1] == 5) {
						 			$jumlah_benar++;
						 		}
						 		
							}else{
								//print_r('i bawah'.$key);
							}

					}
				}

			}

			$nilai = ($jumlah_benar / $jumlah_soal)  * 100;
			//$nilai_bobot = ($total_bobot / $jumlah_soal)  * 100;
			$nilai_bobot = $total_bobot;

			$d_update = [
				'jml_benar'		=> $jumlah_benar,
				'nilai'			=> number_format(floor($nilai_bobot), 0),
				'nilai_bobot'	=> number_format(floor($nilai_bobot), 0),
				'status'		=> 'N',
				'twk'			=> $total_bobot_twk,
				'tiu'			=> $total_bobot_tiu,
				'tkp'			=> $total_bobot_tkp
			];

			$this->master->update('h_ujian', $d_update, 'id', $id_tes);
			$this->output_json(['status'=>TRUE, 'data'=>$d_update, 'id'=>$id_tes]);
		}
	}
}