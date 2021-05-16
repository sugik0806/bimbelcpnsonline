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
		$this->load->helper('my');// Load Library Ignited-Datatables
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

		  $tgl_awal = $_POST['tgl_awal'];
    	  $tgl_akhir = $_POST['tgl_akhir'];
    	  $rekening = $_POST['rekening'];
    	  

		//$tgl_awal = $this->input->post('tgl_awal', true);
		$this->output_json($this->laporan->getPendapatan($tgl_awal, $tgl_akhir, $rekening), false);
	}

	public function fee()
	{
		  $tgl_awal = $_POST['tgl_awal'];
		  $tgl_akhir = $_POST['tgl_akhir'];
		  $penerima_fee = $_POST['penerima_fee'];
		$this->output_json($this->laporan->getFee($tgl_awal, $tgl_akhir, $penerima_fee), false);
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
			'referal' => $this->master->getAllMarketing()
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

	public function encrypt()
	{
		$penerima_fee = $_POST['penerima_fee'];
		if ($penerima_fee != '0') {
			$key = urlencode($this->encryption->encrypt($penerima_fee));
		}else{
			$key = '0';
		}
		
		if ($key != '0') {
			$keydec = $this->encryption->decrypt(rawurldecode($key));
		}else{
			$keydec = '0';
		}
		
		$this->output_json(['penerima_fee'=>$key, 'penerima_fee_asli'=>$keydec]);
	}

	public function cetak_fee($tgl_awal, $tgl_akhir, $penerima_fee)
	{	
		//print($penerima_fee);
		$this->load->library('Pdf');
		
		if ($penerima_fee != '0') {
			$penerima_fee_decrypt = $this->encryption->decrypt(rawurldecode($penerima_fee));
		}else{
			$penerima_fee_decrypt = '0';
		}
		
		

		// $tgl_awal = $_POST['tgl_awal'];
		// $tgl_akhir = $_POST['tgl_akhir'];
		// $penerima_fee = $_POST['penerima_fee'];

		//if ($penerima_fee_decrypt) {
			$hasil 	= $this->laporan->getFeeReport($tgl_awal, $tgl_akhir, $penerima_fee_decrypt);
					
			if ($penerima_fee != '0') {
				$referal 	= $this->master->getMarketingByRef($penerima_fee_decrypt);
				$penerima_nya = "Penerima Fee = " . $referal[0]->nama_marketing;
			}else{
				$penerima_nya = "";
			}
			
			$data = [
				
				'laporan' => $hasil,
				'tgl_awal' => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'penerima_nya' => $penerima_nya
			];
			
			$this->load->view('laporan/cetak_fee', $data);
		//}

		
	}

	public function cetak($tgl_awal, $tgl_akhir, $rekening)
	{
		$this->load->library('Pdf');

		
		$hasil 	= $this->laporan->getPendapatanReport($tgl_awal, $tgl_akhir, $rekening);
		$pengeluaran 	= $this->laporan->getPengeluaran($tgl_awal, $tgl_akhir);
		
		
		if ($rekening != 0) {
			$rekeningnya = "Rekening = " . $rekening;
		}else{
			$rekeningnya = "";
		}
		 
		
		$data = [
			
			'laporan' => $hasil,
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'rekening' => $rekeningnya,
			'pengeluaran' => $pengeluaran
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