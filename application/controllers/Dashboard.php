<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->model('Dashboard_model', 'dashboard');
		$this->load->model('Ujian_model', 'ujian');
		$this->load->model('Master_model', 'master');
		$this->user = $this->ion_auth->user()->row();
		$this->mhs 	= $this->ujian->getIdMahasiswa($this->user->username);
	}

	public function admin_box()
	{
		$box = [
			[
				'box' 		=> 'light-blue',
				'total' 	=> $this->dashboard->total('jurusan'),
				'title'		=> 'Paket',
				'icon'		=> 'graduation-cap',
				'url'		=> 'jurusan'
			],
			[
				'box' 		=> 'olive',
				'total' 	=> $this->dashboard->total('kelas'),
				'title'		=> 'Kelas',
				'icon'		=> 'building-o',
				'url'		=> 'kelas'
			],
			[
				'box' 		=> 'yellow-active',
				'total' 	=> $this->dashboard->total('dosen'),
				'title'		=> 'Pembimbing',
				'icon'		=> 'user-secret',
				'url'		=> 'dosen'
			],
			[
				'box' 		=> 'red',
				'total' 	=> $this->dashboard->total('mahasiswa'),
				'title'		=> 'Peserta',
				'icon'		=> 'user',
				'url'		=> 'mahasiswa'
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function user_box_skd()
	{
		$box['box'] = $this->dashboard->getDashboardPesertaSKD($this->mhs->id_mahasiswa);
		$info_box_skd = json_decode(json_encode($box['box']), FALSE);
		return $info_box_skd;
	}

	public function user_box_skb()
	{
		$box['box'] = $this->dashboard->getDashboardPesertaSKB($this->mhs->id_mahasiswa);
		$info_box_skb = json_decode(json_encode($box['box']), FALSE);
		return $info_box_skb;
	}

	public function index()
	{
		$user = $this->user;
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Dashboard',
			'subjudul'	=> 'Data Aplikasi',
		];

		if ( $this->ion_auth->is_admin() ) {
			$data['info_box'] = $this->admin_box();
		} elseif ( $this->ion_auth->in_group('dosen') ) {
			$matkul = ['matkul' => 'dosen.matkul_id=matkul.id_matkul'];
			$data['dosen'] = $this->dashboard->get_where('dosen', 'nip', $user->username, $matkul)->row();

			$kelas = ['kelas' => 'kelas_dosen.kelas_id=kelas.id_kelas'];
			$data['kelas'] = $this->dashboard->get_where('kelas_dosen', 'dosen_id' , $data['dosen']->id_dosen, $kelas, ['nama_kelas'=>'ASC'])->result();

					$ujian 	= $this->ujian->getUjianAll();

					foreach ($ujian as $as => $value) {
						
						//print_r($value->id_ujian);
							$data['data'][$as]['title'] = $value->nama_ujian;
				            $data['data'][$as]['start'] = $value->tgl_mulai;
				            $data['data'][$as]['end'] = $value->terlambat;
				            $data['data'][$as]['id'] = $value->id_ujian;
				            if ($value->nama_matkul == "SKD") {


				            	if ($value->terbit == 1) {
				            		

				            		if ($value->tgl_mulai >  date('Y-m-d H:i:s')) {
				            			//print_r('belum mulai');

				            			$data['data'][$as]['counter'] = `<div class="callout callout-danger">
				            			    <i class="fa fa-clock-o"></i> <strong class="countdown" data-time="<?=date('Y-m-d H:i:s', strtotime($value->terlambat))?>">00 Hari, 00 Jam, 00 Menit, 00 Detik</strong><br/>
				            			    Batas waktu menekan tombol mulai.
				            			</div>`;

				            			$data['data'][$as]['backgroundColor'] = "#EEAD0E";
				            		}else if ($value->terlambat >  date('Y-m-d H:i:s')) {
				            			//print_r('masuk waktu');
				            			$data['data'][$as]['backgroundColor'] = "#00a65a";
				            			
				            		}else{
				            			//print_r('waktu habis');
				            			$data['data'][$as]['backgroundColor'] = "#E31212";
				            		}



				            	}else if ($value->terbit == 0) {
				            		$data['data'][$as]['backgroundColor'] = "#A0A0A0";
				            	}
				            	
				            	

				          
				            	
				            }else{

				            	if ($value->terbit == 1) {
				            		

				            		if ($value->tgl_mulai >  date('Y-m-d H:i:s')) {
				            			//print_r('belum mulai');

				            			$data['data'][$as]['counter'] = `<div class="callout callout-danger">
				            			    <i class="fa fa-clock-o"></i> <strong class="countdown" data-time="<?=date('Y-m-d H:i:s', strtotime($value->terlambat))?>">00 Hari, 00 Jam, 00 Menit, 00 Detik</strong><br/>
				            			    Batas waktu menekan tombol mulai.
				            			</div>`;

				            			$data['data'][$as]['backgroundColor'] = "#EEAD0E";
				            		}else if ($value->terlambat >  date('Y-m-d H:i:s')) {
				            			//print_r('masuk waktu');
				            			$data['data'][$as]['backgroundColor'] = "#37BED6";
				            			
				            		}else{
				            			//print_r('waktu habis');
				            			$data['data'][$as]['backgroundColor'] = "#E31212";
				            		}


				            	}else if ($value->terbit == 0) {
				            		$data['data'][$as]['backgroundColor'] = "#A0A0A0";
				            	}
				            	
				            }
			        }
		}else{
			$data['info_box_skd'] = $this->user_box_skd();
			$data['info_box_skb'] = $this->user_box_skb();
			$join = [
				'kelas b' 	=> 'a.kelas_id = b.id_kelas',
				'jurusan c'	=> 'b.jurusan_id = c.id_jurusan',
				'matkul m'  => 'm.id_matkul = a.id_matkul' 
			];
			$data['mahasiswa'] = $this->dashboard->get_where('mahasiswa a', 'nim', $user->username, $join)->row();
		}

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('dashboard');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

	// public function dataCalender()
	// {

	// 			$ujian 	= $this->ujian->getUjianAll();

	// 			foreach ($ujian as $as => $value) {
	// 				//print_r($value->terbit);
	// 				//if ($value->terbit == '1') {
	// 					$data['data'][$as]['title'] = $value->nama_ujian;
	// 		            $data['data'][$as]['start'] = $value->tgl_mulai;
	// 		            $data['data'][$as]['end'] = $value->terlambat;
	// 		            $data['data'][$as]['backgroundColor'] = "#00a65a";
	// 				//}
		            
	// 	        }

	// 	 $this->output_json($data);
	// }


	public function getDataMahasiswa()
	{
		$mhs = $this->master->getDataMahasiswaAll();
		$this->output_json($mhs);
	}
}