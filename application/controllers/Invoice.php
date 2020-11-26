<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class Invoice extends CI_Controller {
 
    public function __construct() { 
                parent::__construct(); 
                
                require APPPATH.'libraries/phpmailer/src/Exception.php';
                require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
                require APPPATH.'libraries/phpmailer/src/SMTP.php';

                $this->load->model('Master_model', 'master');
                 
                }

                function index() 
                {

                }

                function konfirmasi($token) 
                {

                    $this->data['password'] = [
                        'name' => 'password',
                        'id' => 'password',
                        'type' => 'password',
                        'placeholder' => 'Password',
                        'class' => 'form-control',
                    ];

                    $data = [
                        'user' => $this->ion_auth->user()->row(),
                        'judul' => 'Invoice',
                        'subjudul' => 'Invoice'
                    ];
                    $this->load->view('_templates/auth/_header.php', $data);
                    $this->load->view('auth/invoice');
                    $this->load->view('_templates/auth/_footer.php');
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
                    $mail->Host     = 'mail.bimbelcpnsonline.id'; //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = '_mainaccount@bimbelcpnsonline.id'; // user email
                    $mail->Password = '8SKoRi86!R7es#'; // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
            
                    $mail->setFrom('info@bimbelcpnsonline.id', ''); // user email
                    $mail->addReplyTo('info@bimbelcpnsonline.id', ''); //user email
            
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

                            <h2 style="text-align:center">INVOICE: '.$token.'></h2>
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
 
}