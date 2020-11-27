<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class Invoice extends CI_Controller {
 
    public function __construct() { 
                parent::__construct(); 
                $this->load->database();
                $this->load->library('form_validation');
                $this->load->helper(['url', 'language']);
                $this->load->helper('my');// Load Library Ignited-Datatables
                $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
                $this->lang->load('auth');
                $this->load->model('Registrasi_model', 'regis');
                
                require APPPATH.'libraries/phpmailer/src/Exception.php';
                require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
                require APPPATH.'libraries/phpmailer/src/SMTP.php';

                $this->load->model('Master_model', 'master');
                 
                }

                public function output_json($data, $encode = true)
                {
                    if($encode) $data = json_encode($data);
                    $this->output->set_content_type('application/json')->set_output($data);
                }

                function index() 
                {

                }

                public function validasi()
                {

                    $this->form_validation->set_rules('file_bukti', 'File Bukti', 'required');
                }

                public function file_config()
                {
                    $allowed_type   = [
                        "image/jpeg", "image/jpg", "image/png", "image/gif",
                        "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
                        "video/mp4", "application/octet-stream"
                    ];
                    $config['upload_path']      = FCPATH.'uploads/file_konfirmasi/';
                    $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
                    $config['encrypt_name']     = TRUE;
                    
                    return $this->load->library('upload', $config);
                }

                function konfirmasi($token) 
                {

                    $datapeserta  = $this->master->getMahasiswaByToken($token);

                    // $this->data['password'] = [
                    //     'name' => 'password',
                    //     'id' => 'password',
                    //     'type' => 'password',
                    //     'placeholder' => 'Password',
                    //     'class' => 'form-control',
                    // ];

                    $data = [
                        'token' => $token,
                        'kelas_id' => $datapeserta->kelas_id,
                        'harga' => $datapeserta->harga,
                        'jurusan' => $datapeserta->nama_jurusan,
                        'nama' => $datapeserta->nama,
                        'file' => $datapeserta->url_bukti
                    ];


                    $this->load->view('_templates/auth/_header');
                    $this->load->view('auth/invoice', $data);
                    $this->load->view('_templates/auth/_footer');
                }

                function lakukan_konfirmasi($token) 
                {
                    $method = $this->input->post('method', true);
                    $this->validasi();
                    $this->file_config();

                    
                    if($this->form_validation->run() === true){
                        $this->form_validation->set_rules('file_bukti', 'File Bukti', 'required');
                        $data = [
                            'status'    => false,
                            'errors'    => [
                                'file_bukti' => form_error('file_bukti')
                            ]
                        ];
                        //$this->output_json($data);
                    }else{

                        $i = 0;
                        foreach ($_FILES as $key => $val) {
                            $img_src = FCPATH.'uploads/file_konfirmasi/';
                            //$getdata  = $this->master->getMahasiswaByToken($token);
                            
                            $error = '';
                            
                                 //print_r($img_src);
                                if(!empty($_FILES['file_bukti']['name'])){
                                    if (!$this->upload->do_upload('file_bukti')){
                                        $error = $this->upload->display_errors();
                                        show_error($error, 500, 'File Bukti Error');
                                        exit();
                                    }else{
                                        if($method === 'edit'){
                                            // if(!unlink($img_src.$getsoal->file)){
                                            //     show_error('Error saat delete gambar <br/>'.var_dump($getsoal), 500, 'Error Edit Gambar');
                                            //     exit();
                                            // }
                                        }
                                        // $data['file_bukti'] = $this->upload->data('file_name');
                                        // $data['tipe_file'] = $this->upload->data('file_type');
                                    }
                                }

                           
                           $i++;  
                        }
                            
                        

                        if($method==='add'){
                            $dataR = [
                                'status' => true
                            ];
                            //push array
                            $data = [
                                'tabel' => 'mahasiswa',
                                'url_bukti' =>  $this->upload->data('file_name')
                            ];
                            $where = [
                                'token' => $token
                            ];

                            //update data
                            $this->master->updateData($data, $where);
                            //$this->output_json($data);

                            $kontenHTML = '<p>konfirmasi berhasil akun kamu akan aktif segera !</p>';
                            $subject = 'konfirmasi berhasil';
                            
                            $this->kirim_email_konfirmasi($token, $subject, $kontenHTML);
                            //redirect('soal');
                        }else{
                            show_error('Method tidak diketahui, kembali ke halaman sebelumnya', 404);

                        }

                       
                    }

                }


                public function kirim_email($token)
                {
                    $datamhs  = $this->master->getMahasiswaByToken($token);
                    //print_r($datamhs->email);

                    // PHPMailer object
                     $response = false;
                     $mail = new PHPMailer();
                   
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = $this->config->item('webemail'); //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = $this->config->item('email'); // user email
                    $mail->Password = $this->config->item('pass_email'); // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
            
                    $mail->setFrom($this->config->item('email'), ''); // user email
                    $mail->addReplyTo($this->config->item('email'), ''); //user email
            
                    // Add a recipient
                    $mail->addAddress($datamhs->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = 'Pendaftaran Bimbel CPNS Online'; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);

                    if ($datamhs->kelas_id == 1) {
                        $paket = 'Paket Materi Rp 150.000';
                        $bayar = 'Rp 150.000';
                    }else if ($datamhs->kelas_id == 2) {
                        $paket = 'Paket Soal Rp 250.000';
                        $bayar = 'Rp 250.000';
                    }else if ($datamhs->kelas_id == 3) {
                        $paket = 'Paket Bimbel Rp 350.000';
                        $bayar = 'Rp 350.000';
                    }

                    $token = $datamhs->token;

            
                    // Email body content
                    $mailContent = '<!DOCTYPE html>
                            <html>
                            <head>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <style>
                            * {
                              box-sizing: border-box;
                            }

                            .columns {
                              float: left;
                              width: 33.3%;
                              padding: 8px;
                            }

                            .price {
                              list-style-type: none;
                              border: 1px solid #eee;
                              margin: 0;
                              padding: 0;
                              -webkit-transition: 0.3s;
                              transition: 0.3s;
                            }

                            .price:hover {
                              box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
                            }

                            .price .header {
                              background-color: #111;
                              color: white;
                              font-size: 25px;
                            }

                            .price li {
                              border-bottom: 1px solid #eee;
                              padding: 20px;
                              text-align: center;
                            }

                            .price .grey {
                              background-color: #eee;
                              font-size: 20px;
                            }

                            .button {
                              background-color: #4CAF50;
                              border: none;
                              color: white;
                              padding: 10px 25px;
                              text-align: center;
                              text-decoration: none;
                              font-size: 18px;
                            }

                            @media only screen and (max-width: 600px) {
                              .columns {
                                width: 100%;
                              }
                            }
                            </style>
                            </head>
                            <body>

                            <h2 style="text-align:center">INVOICE: '.$token.'</h2>
                            <p style="text-align:center">Pastikan Anda Sudah Transfer Sebelum Klik Konfirmasi.

                            

                            <div class="col-md-12 text-center">
                              <ul class="price">
                                <li class="header" style="background-color:#4CAF50">'.$paket.'</li>
                                <li class="grey">Silakan Transfer '.$bayar.'</li>
                                <li>Ke rekening BCA</li>
                                <li>156121921152</li>
                                <li>Atas Nama</li>
                                <li>Irawati</li>
                                <li class="grey"><a href="https://member.bimbelcpnsonline.id/invoice/konfirmasi/'.$token.'" class="button">Konfirmasi</a></li>
                              </ul>
                            </div>

                            

                            </body>
                            </html>
                            '; // isi email
                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        //echo 'Message has been sent';
                        redirect('invoice/konfirmasi/'.$token);
                    }
                }

                public function kirim_email_konfirmasi($token, $subject, $kontenHTML)
                {
                    print_r($token, $subject);
                    $datamhs  = $this->master->getMahasiswaByToken($token);
                    //print_r($datamhs->email);

                    // PHPMailer object
                    $response = false;
                    $mail = new PHPMailer();
                   
                
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = $this->config->item('webemail'); //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = $this->config->item('email'); // user email
                    $mail->Password = $this->config->item('pass_email'); // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
            
                    $mail->setFrom($this->config->item('email'), ''); // user email
                    $mail->addReplyTo($this->config->item('email'), ''); //user email
                
                    // Add a recipient
                    $mail->addAddress($datamhs->email); //email tujuan pengiriman email
                
                    // Email subject
                    $mail->Subject = $subject; //subject email
                
                    // Set email format to HTML
                    $mail->isHTML(true);
                
                    // Email body content
                    $mailContent = $kontenHTML; // isi email
                    $mail->Body = $mailContent;
                
                    // Send email
                    if(!$mail->send()){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        //echo 'Message has been sent';
                        $this->konfirmasi($token);
                    }
                }
 
}