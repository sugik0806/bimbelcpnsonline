<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Pengeluaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->is_admin() AND !$this->ion_auth->in_group('dosen')) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->load->model('Laporan_model', 'laporan');
		$this->form_validation->set_error_delimiters('', '');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function index()
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Pengeluaran',
			'subjudul' => 'Data Pengeluaran'
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('laporan/pengeluaran/data');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Tambah Pengeluaran',
			'subjudul'	=> 'Tambah Data Pengeluaran',
			'banyak'	=> $this->input->post('banyak', true)
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('laporan/pengeluaran/add');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function data()
	{
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		$this->output_json($this->laporan->getDataPengeluaran($tgl_awal, $tgl_akhir), false);
	}



	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('pengeluaran');
		} else {
			$pengeluaran = $this->laporan->getPengeluaranById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit Pengeluaran',
				'subjudul'	=> 'Edit Data Pengeluaran',
				'pengeluaran'	=> $pengeluaran
			];
			$this->load->view('_templates/dashboard/_header', $data);
			$this->load->view('laporan/pengeluaran/edit');
			$this->load->view('_templates/dashboard/_footer');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('nama_pengeluaran', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$nama_pengeluaran = 'nama_pengeluaran[' . $i . ']';
			$nominal = 'nominal[' . $i . ']';
			$this->form_validation->set_rules($nama_pengeluaran, 'Pengeluaran', 'required');
			$this->form_validation->set_rules($nominal, 'Nominal', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$nama_pengeluaran => form_error($nama_pengeluaran),
					$nominal => form_error($nominal)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'nama_pengeluaran' => $this->input->post($nama_pengeluaran, true),
						'nominal' => $this->input->post($nominal, true),
						'tanggal_pengeluaran' => date('Y-m-d')
					];
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_pengeluaran'	=> $this->input->post('id_pengeluaran[' . $i . ']', true),
						'nama_pengeluaran' 	=> $this->input->post($nama_pengeluaran, true),
						'nominal' => $this->input->post($nominal, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('pengeluaran', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('pengeluaran', $update, 'id_pengeluaran', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
	}

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('pengeluaran', $chk, 'id_pengeluaran')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function load_pengeluaran()
	{
		$data = $this->master->getJurusan();
		$this->output_json($data);
	}

	public function import($import_data = null)
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Paker Bimbingan',
			'subjudul' => 'Import Paket Bimbingan'
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('laporan/pengeluaran/import');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function preview()
	{
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
			$ext = $this->upload->data('file_ext');

			switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
			}

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$pengeluaran = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				if ($sheetData[$i][0] != null) {
					$pengeluaran[] = $sheetData[$i][0];
				}
			}

			unlink($file);

			$this->import($pengeluaran);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('pengeluaran', true));
		$pengeluaran = [];
		foreach ($data as $j) {
			$pengeluaran[] = ['nama_pengeluaran' => $j];
		}

		$save = $this->master->create('pengeluaran', $pengeluaran, true);
		if ($save) {
			redirect('pengeluaran');
		} else {
			redirect('pengeluaran/import');
		}
	}
}
