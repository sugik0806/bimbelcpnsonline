<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class Kirim_email extends CI_Controller {
 
    public function __construct() { 
                parent::__construct(); 
                
                require APPPATH.'libraries/phpmailer/src/Exception.php';
                require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
                require APPPATH.'libraries/phpmailer/src/SMTP.php';

                $this->load->model('Master_model', 'master');
                 
                }

                public function output_json($data, $encode = true)
                {
                  if ($encode) $data = json_encode($data);
                  $this->output->set_content_type('application/json')->set_output($data);
                }

                function index() 
                {

                }

                public function kirim_email($token, $subject, $content)
                {
                    $data  = $this->master->getMahasiswaByToken($token);
                    //print_r($datamhs->email);

                    // PHPMailer object
                     $response = false;
                     $mail = new PHPMailer();
                   
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = $this->config->item('webemail'); //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = $this->config->item('smptauth');
                    $mail->Username = $this->config->item('email'); // user email
                    $mail->Password = $this->config->item('pass_email'); // password email
                    $mail->SMTPSecure = $this->config->item('smptsecure');
                    $mail->Port     =$this->config->item('port');
                    $mail->setFrom($this->config->item('email'), ''); // user email
                    $mail->addReplyTo($this->config->item('email'), ''); //user email
            
                    // Add a recipient
                    $mail->addAddress($data->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = $subject; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);

                    // Email body content
                    $mailContent = 'Password Anda '. $token.  ' Gunakan Email Sebagai Username, Silakan login ke '. $this->config->item('urlbimbel'); // isi email
                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        //echo 'Message has been sent';
                        //redirect('invoice/konfirmasi/'.$token);
                        $data = [
                          'status'  => true,
                          'msg'  => 'Buat / Reset Password Berhasil. Password '. $token
                        ];
                      //redirect('mahasiswa');  
                      $this->output_json($data);  
                    }
                }
 
}