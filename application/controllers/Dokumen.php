<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->helper('my');// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
        $this->load->model('Dokumen_model', 'dokumen');
		$this->form_validation->set_error_delimiters('','');
        $this->load->model('Ujian_model', 'ujian');
        $this->user = $this->ion_auth->user()->row();
        $this->mhs  = $this->ujian->getIdMahasiswa($this->user->username);
	}

    public function file_config()
    {
        $allowed_type   = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH.'uploads/dokumen/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4|pdf';
        $config['encrypt_name']     = TRUE;
        
        return $this->load->library('upload', $config);
    }

	public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function index()
	{
        $user = $this->ion_auth->user()->row();
		$data = [
			'user' => $user,
			'judul'	=> 'Materi',
			'subjudul'=> 'Bank Dokumen',
            'mhs'=> $this->mhs
        ];
        
        $data['matkul'] = $this->master->getAllMatkul();
        $data['jenis'] = $this->master->getAlljenis();

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/dokumen/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }
    
    public function detail($id)
    {
        $user = $this->ion_auth->user()->row();
		$data = [
			'user'      => $user,
			'judul'	    => 'Soal',
            'subjudul'  => 'Edit Soal',
            'soal'      => $this->soal->getSoalById($id),
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('soal/detail');
		$this->load->view('_templates/dashboard/_footer.php');
    }
    
    public function add()
	{
        $user = $this->ion_auth->user()->row();
		$data = [
			'user'      => $user,
			'judul'	    => 'Dokumen',
            'subjudul'  => 'Tambah Dokumen'
        ];

        $data['matkul'] = $this->master->getAllMatkul();
        $data['jenis'] = $this->master->getAlljenis();

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/dokumen/add');
		$this->load->view('_templates/dashboard/_footer.php');
    }

    public function edit($id)
	{
		$data = [
            'user'      => $this->ion_auth->user()->row(),
            'judul'     => 'Edit Dokumen',
            'subjudul'  => 'Edit Data Dokumen',
            'matkul'    => $this->master->getAllMatkul(),
            'jenis'     => $this->master->getAlljenis(),
            'data'      => $this->dokumen->getDokumenById($id)
        ];

//print_r($data['data']);
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('master/dokumen/edit');
        $this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{  
        $kelas_id = $this->mhs->kelas_id;
        if ($this->ion_auth->in_group('mahasiswa')) {
          $akses = 0;
        }else{
          $akses = 1;
        }

        $doc = $this->dokumen->getDataDokumen($akses, $kelas_id);
		$this->output_json($doc, false);
        //print_r($doc);
    }

    public function validasi()
    {

    
    $this->form_validation->set_rules('matkul', 'matkul', 'required');
    $this->form_validation->set_rules('jenis', 'jenis', 'required');
    $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required|trim|min_length[3]|max_length[50]');

    //$this->form_validation->set_rules('file_dokumen', 'file dokumen', 'required');
    }
    
    public function save()
    {
        $method = $this->input->post('method', true);
        $this->validasi();
        $this->file_config();


        $id_dokumen   = $this->input->post('id_dokumen', true);
        $nama_dokumen = $this->input->post('nama_dokumen', true);
        $file_dokumen = $this->input->post('file_dokumen', true);
        $matkul     = $this->input->post('matkul', true);
        $jenis     = $this->input->post('jenis', true);

        $data = [
            'id_matkul'        => $this->input->post('matkul', true),
            'id_jenis'         => $this->input->post('jenis', true),
            'nama_dokumen'     => $this->input->post('nama_dokumen', true),
            'file_dokumen'     =>$this->input->post('file_dokumen', true)
        ];

        $dataTanpaFile = [
            'id_matkul'        => $this->input->post('matkul', true),
            'id_jenis'         => $this->input->post('jenis', true),
            'nama_dokumen'     => $this->input->post('nama_dokumen', true)
        ];

        if ($method == 'add') {
            //$nama_dokumen = '|is_unique[dokumen.nama_dokumen]';


           // print_r($nama_dokumen);
        } else {
            $dbdata     = $this->dokumen->getDokumenById($id_dokumen);
            $nama_dokumen    = $dbdata->nama_dokumen === $nama_dokumen ? "" : "|is_unique[dokumen.nama_dokumen]";
        }


        if ($this->form_validation->run() == FALSE) {
            $data = [
                'status'    => false,
                'errors'    => [
                    'matkul' => form_error('matkul'),
                    'jenis' => form_error('jenis'),
                    'nama_dokumen' => form_error('nama_dokumen'),
                    'file_dokumen' => form_error('file_dokumen')
                ]
            ];

            $this->output_json($data);
        } else {
            //print_r($_FILES);
            $i =0;
            foreach ($_FILES as $key => $val) {
                $img_src = FCPATH.'uploads/dokumen/';
                
                $error = '';
                
                     //print_r($_FILES);
                if(!empty($_FILES['file_dokumen']['name'])){
                    if (!$this->upload->do_upload('file_dokumen')){
                        $error = $this->upload->display_errors();
                        show_error($error, 500, 'File Soal Error');
                        exit();
                    }else{
                        if($method === 'edit'){
                            // if(!unlink($file_dokumen)){
                            //     show_error('Error saat delete gambar <br/>'.var_dump($file_dokumen), 500, 'Error Edit Gambar');
                            //     exit();
                            // }
                        }
                        $data['file_dokumen'] = $this->upload->data('file_name');
                    }
                }
                $i++;    

            }

            if ($method === 'add') {
                $action = $this->master->create('m_dokumen', $data);
            } else if ($method === 'edit') {
                if($_FILES['file_dokumen']['name'] == ""){
                    $action = $this->master->update('m_dokumen', $dataTanpaFile, 'id_dokumen', $id_dokumen);
                }else{
                    $action = $this->master->update('m_dokumen', $data, 'id_dokumen', $id_dokumen);
                }
                
            }

            if ($action) {
                $this->output_json(['status' => true]);
            } else {
                $this->output_json(['status' => false]);
            }
        }
    }


    public function delete()
    {
        $chk = $this->input->post('checked', true);
        if (!$chk) {
            $this->output_json(['status' => false]);
        } else {
            if ($this->master->delete('m_dokumen', $chk, 'id_dokumen')) {
                $this->output_json(['status' => true, 'total' => count($chk)]);
            }
        }
    }

    public function import($import_data = null)
    {
        $data = [
            'user' => $this->ion_auth->user()->row(),
            'judul' => 'Pembimbing',
            'subjudul' => 'Import Data Pembimbing',
            'matkul' => $this->master->getAllMatkul()
        ];
        if ($import_data != null) $data['import'] = $import_data;

        $this->load->view('_templates/dashboard/_header', $data);
        $this->load->view('master/dosen/import');
        $this->load->view('_templates/dashboard/_footer');
    }
    public function preview()
    {
        $config['upload_path']      = './uploads/import/';
        $config['allowed_types']    = 'xls|xlsx|csv';
        $config['max_size']         = 2048;
        $config['encrypt_name']     = true;

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
            $data = [];
            for ($i = 1; $i < count($sheetData); $i++) {
                $data[] = [
                    'nip' => $sheetData[$i][0],
                    'nama_dosen' => $sheetData[$i][1],
                    'email' => $sheetData[$i][2],
                    'matkul_id' => $sheetData[$i][3]
                ];
            }

            unlink($file);

            $this->import($data);
        }
    }

    public function do_import()
    {
        $input = json_decode($this->input->post('data', true));
        $data = [];
        foreach ($input as $d) {
            $data[] = [
                'nip' => $d->nip,
                'nama_dosen' => $d->nama_dosen,
                'email' => $d->email,
                'matkul_id' => $d->matkul_id
            ];
        }

        $save = $this->master->create('dosen', $data, true);
        if ($save) {
            redirect('dosen');
        } else {
            redirect('dosen/import');
        }
    }
}