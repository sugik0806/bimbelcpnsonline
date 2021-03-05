<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Marketing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->is_admin()) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
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
			'judul'	=> 'Marketing',
			'subjudul' => 'Data Marketing'
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('master/marketing/data');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Tambah Marketing',
			'subjudul'	=> 'Tambah Data Marketing',
			'banyak'	=> $this->input->post('banyak', true)
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('master/marketing/add');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function data()
	{
		$this->output_json($this->master->getDataMarketing(), false);
	}

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('marketing');
		} else {
			$marketing = $this->master->getMarketingById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit Paket Bimbingan',
				'subjudul'	=> 'Edit Paket Data Bimbingan',
				'marketing'	=> $marketing
			];
			$this->load->view('_templates/dashboard/_header', $data);
			$this->load->view('master/marketing/edit');
			$this->load->view('_templates/dashboard/_footer');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('nama_marketing', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$nama_marketing = 'nama_marketing[' . $i . ']';
			$referal = 'referal[' . $i . ']';
			$fee = 'fee[' . $i . ']';
			$this->form_validation->set_rules($nama_marketing, 'Marketing', 'required');
			$this->form_validation->set_rules($referal, 'Referal', 'required');
			$this->form_validation->set_rules($fee, 'Fee', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$nama_marketing => form_error($nama_marketing),
					$referal => form_error($referal),
					$fee => form_error($fee)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'nama_marketing' => $this->input->post($nama_marketing, true),
						'referal' => $this->input->post($referal, true),
						'fee' => $this->input->post($fee, true)
					];
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_marketing'	=> $this->input->post('id_marketing[' . $i . ']', true),
						'nama_marketing' 	=> $this->input->post($nama_marketing, true),
						'referal' => $this->input->post($referal, true),
						'fee' => $this->input->post($fee, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('marketing', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('marketing', $update, 'id_marketing', null, true);
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
			if ($this->master->delete('marketing', $chk, 'id_marketing')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function load_marketing()
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
		$this->load->view('master/marketing/import');
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
			$marketing = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				if ($sheetData[$i][0] != null) {
					$marketing[] = $sheetData[$i][0];
				}
			}

			unlink($file);

			$this->import($marketing);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('marketing', true));
		$marketing = [];
		foreach ($data as $j) {
			$marketing[] = ['nama_marketing' => $j];
		}

		$save = $this->master->create('marketing', $marketing, true);
		if ($save) {
			redirect('marketing');
		} else {
			redirect('marketing/import');
		}
	}
}
