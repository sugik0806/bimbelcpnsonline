<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}else if(!$this->ion_auth->is_admin()){
            show_error('Hanya Admin yang boleh mengakses halaman ini', 403, 'Akses dilarang');
		}
		$this->load->model('Settings_model', 'settings');
		$this->load->model('Master_model', 'master');
	}
	
	public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
	}

    public function index()
    {
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Settings',
			'subjudul'=> 'Hapus data',
		];

        $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('settings');
		$this->load->view('_templates/dashboard/_footer.php');
	}
	
	public function truncate()
	{	
		$tables = ['h_ujian', 'm_ujian', 'tb_soal', 'kelas_dosen', 'dosen', 'mahasiswa', 'kelas', 'jurusan_matkul', 'matkul', 'jurusan'];
		$this->settings->truncate($tables);

		$this->output_json(['status'=>true]);
	}

	public function kosongkanUjian()
	{		
			$idmhsIn = array();
			$idmhs = $this->master->getMahasiswaByIdKelas(3);//array
			foreach($idmhs as $i => $mhs) {
			    $idmhsIn[] = $mhs->id_mahasiswa;
			}

			//print_r($idmhsIn);

			$tgl1 = date('y-m-d');
			$tgl_selesaimin7 = date('y-m-d', strtotime('-7 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 7 hari

			$input['aktif'] = 0;
			$action = $this->settings->update('h_ujian', $input, 'tgl_selesai', $tgl_selesaimin7, $idmhsIn);
			
			if ($action) {
				$this->output_json(['status' => true]);
			} else {
				$this->output_json(['status' => false]);
			}

		$this->output_json(['status'=>true]);
	}
}