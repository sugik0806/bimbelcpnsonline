<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public $mhs, $user;

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		
		$this->load->library(['datatables']);// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->load->model('Ujian_model', 'ujian');
		$this->load->model('laporan_model', 'laporan');
		
		$this->user = $this->ion_auth->user()->row();
		$this->mhs 	= $this->ujian->getIdMahasiswa($this->user->username);
	}

	public function output_json($data, $encode = true)
	{
		if($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function data()
	{
		$this->output_json($this->laporan->getPendapatan(), false);
	}

	public function fee()
	{
		$this->output_json($this->laporan->getFee(), false);
	}

	public function index()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Laporan',
			'subjudul'=> 'Laporan Pendapatan',
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('laporan/laporan_pendapatan');
		$this->load->view('_templates/dashboard/_footer.php');
	}

		public function fee_marketing()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Laporan',
			'subjudul'=> 'Laporan Fee Marketing',
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('laporan/laporan_fee_marketing');
		$this->load->view('_templates/dashboard/_footer.php');
	}
	
	public function detail($id)
	{
		$ujian = $this->ujian->getUjianById($id);
		$nilai = $this->ujian->bandingNilai($id);

		$data = [
			'user' => $this->user,
			'judul'	=> 'Ujian',
			'subjudul'=> 'Detail Hasil Ujian',
			'ujian'	=> $ujian,
			'nilai'	=> $nilai
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('laporan/laporan_pendapatan');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function cetak_fee()
	{
		$this->load->library('Pdf');

		
		$hasil 	= $this->laporan->getFeeReport();
		
		
		$data = [
			
			'laporan' => $hasil
		];
		
		$this->load->view('laporan/cetak_fee', $data);
	}

	public function cetak()
	{
		$this->load->library('Pdf');

		
		$hasil 	= $this->laporan->getPendapatanReport();
		
		
		$data = [
			
			'laporan' => $hasil
		];
		
		$this->load->view('laporan/cetak', $data);
	}

	public function cetak_detail($id)
	{
		$this->load->library('Pdf');

		$hasil 	= $this->laporan->getPendapatanReportbyID($id);
		
		
		$data = [
			
			'hasil' => $hasil
		];

		$this->load->view('laporan/cetak_detail', $data);
	}
	
}