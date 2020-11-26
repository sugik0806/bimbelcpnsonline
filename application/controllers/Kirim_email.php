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

                public function kirim_email($token, $subject, $content)
                {
                    $data  = $this->master->getMahasiswaByToken($token);
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
                    $mail->addAddress($data->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = $subject; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);

                    // Email body content
                    $mailContent = $content; // isi email
                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        echo 'Message has been sent';
                        //redirect('invoice/konfirmasi/'.$token);
                    }
                }
 
}