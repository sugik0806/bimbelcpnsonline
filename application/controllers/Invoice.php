<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class Invoice extends CI_Controller {
 
    public function __construct() { 
                parent::__construct(); 
                $this->load->database();
                $this->load->library('form_validation');
                $this->load->helper(['url', 'language', 'number']);
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

                    $data = [
                        'token' => $token,
                        'kelas_id' => $datapeserta->kelas_id,
                        'harga' => $datapeserta->harga,
                        'jurusan' => $datapeserta->nama_jurusan,
                        'nama' => $datapeserta->nama,
                        'file' => $datapeserta->url_bukti,
                        'jumlah_transfer' => number_format($datapeserta->harga - $datapeserta->angka_unik),
                        'email' => $datapeserta->email
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

                        //print_r($this->form_validation->run());
                        if (empty($_FILES['file_bukti']['name']))
                        {
                            $data = [
                                'status' => false,
                                'msg'    => 'File Bukti Masih Kosong !'
                            ];
                            $this->output_json($data);
                            //redirect('auth/registrasi');
                        }else{

                        $i = 0;
                        foreach ($_FILES as $key => $val) {
                            $img_src = FCPATH.'uploads/file_konfirmasi/';
                            $error = '';
                            
                                 //print_r($img_src);
                                if(!empty($_FILES['file_bukti']['name'])){
                                    if (!$this->upload->do_upload('file_bukti')){
                                        $error = $this->upload->display_errors();
                                        show_error($error, 500, 'File Bukti Error');
                                        exit();
                                    }else{
                                        if($method === 'edit'){
                                        }
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

                            $this->master->updateData($data, $where);
                            
                            $kontenHTML = '<p>Konfirmasi Berhasil, Akun Kamu Akan Segera Aktif !</p> Tunggu Email Pembertahuan Berikutnya';
                            $subject = 'Konfirmasi Berhasil';
                            
                            $this->kirim_email_konfirmasi($token, $subject, $kontenHTML);
                            $this->kirim_email_admin($token, $subject, $kontenHTML);
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
                    $mail->SMTPAuth = $this->config->item('smptauth');
                    $mail->Username = $this->config->item('email'); // user email
                    $mail->Password = $this->config->item('pass_email'); // password email
                    $mail->SMTPSecure = $this->config->item('smptsecure');
                    $mail->Port     =$this->config->item('port');
                    $mail->setFrom($this->config->item('email'), ''); // user email
                    $mail->addReplyTo($this->config->item('email'), ''); //user email
            
                    // Add a recipient
                    $mail->addAddress($datamhs->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = 'Pendaftaran Bimbel CPNS Online'; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);

                    if ($datamhs->kelas_id == 1) {
                        $paket = 'Paket Materi';
                        $bayar = number_format($datamhs->harga - $datamhs->angka_unik);
                    }else if ($datamhs->kelas_id == 2) {
                        $paket = 'Paket Soal';
                        $bayar = number_format($datamhs->harga - $datamhs->angka_unik);
                    }else if ($datamhs->kelas_id == 3) {
                        $paket = 'Paket Bimbel';
                        $bayar = number_format($datamhs->harga - $datamhs->angka_unik);
                    }else if ($datamhs->kelas_id == 4) {
                        $paket = 'Paket Soal Mini';
                        $bayar = number_format($datamhs->harga - $datamhs->angka_unik);
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
                                <li class="grey">Silakan Transfer '.$bayar.'<p style="text-align:center">Sudah dikurangi angka unik</p></li>
                                <li>Ke rekening Mandiri</li>
                                <li>9000025229858</li>
                                <li>Atas Nama</li>
                                <li>Sugik Kusmanto</li>
                                <li class="grey"><a href="https://member.bimbelcpnsonline.id/invoice/konfirmasi/'.$token.'" class="button">Konfirmasi</a></li>
                              </ul>
                            </div>

                            

                            </body>
                            </html>
                            '; // isi email

                    $mailContentx ='
                    <style>
                    /* -------------------------------------
                        GLOBAL
                        A very basic CSS reset
                    ------------------------------------- */
                    * {
                        margin: 0;
                        padding: 0;
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        box-sizing: border-box;
                        font-size: 14px;
                    }

                    img {
                        max-width: 100%;
                    }

                    body {
                        -webkit-font-smoothing: antialiased;
                        -webkit-text-size-adjust: none;
                        width: 100% !important;
                        height: 100%;
                        line-height: 1.6;
                    }

                    /* Lets make sure all tables have defaults */
                    table td {
                        vertical-align: top;
                    }

                    /* -------------------------------------
                        BODY & CONTAINER
                    ------------------------------------- */
                    body {
                        background-color: #f6f6f6;
                    }

                    .body-wrap {
                        background-color: #f6f6f6;
                        width: 100%;
                    }

                    .container {
                        display: block !important;
                        max-width: 600px !important;
                        margin: 0 auto !important;
                        /* makes it centered */
                        clear: both !important;
                    }

                    .content {
                        max-width: 600px;
                        margin: 0 auto;
                        display: block;
                        padding: 20px;
                    }

                    /* -------------------------------------
                        HEADER, FOOTER, MAIN
                    ------------------------------------- */
                    .main {
                        background: #fff;
                        border: 1px solid #e9e9e9;
                        border-radius: 3px;
                    }

                    .content-wrap {
                        padding: 20px;
                    }

                    .content-block {
                        padding: 0 0 20px;
                    }

                    .header {
                        width: 100%;
                        margin-bottom: 20px;
                    }

                    .footer {
                        width: 100%;
                        clear: both;
                        color: #999;
                        padding: 20px;
                    }
                    .footer a {
                        color: #999;
                    }
                    .footer p, .footer a, .footer unsubscribe, .footer td {
                        font-size: 12px;
                    }

                    /* -------------------------------------
                        TYPOGRAPHY
                    ------------------------------------- */
                    h1, h2, h3 {
                        font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                        color: #000;
                        margin: 40px 0 0;
                        line-height: 1.2;
                        font-weight: 400;
                    }

                    h1 {
                        font-size: 32px;
                        font-weight: 500;
                    }

                    h2 {
                        font-size: 24px;
                    }

                    h3 {
                        font-size: 18px;
                    }

                    h4 {
                        font-size: 14px;
                        font-weight: 600;
                    }

                    p, ul, ol {
                        margin-bottom: 10px;
                        font-weight: normal;
                    }
                    p li, ul li, ol li {
                        margin-left: 5px;
                        list-style-position: inside;
                    }

                    /* -------------------------------------
                        LINKS & BUTTONS
                    ------------------------------------- */
                    a {
                        color: #1ab394;
                        text-decoration: underline;
                    }

                    .btn-primary {
                        text-decoration: none;
                        color: #FFF;
                        background-color: #1ab394;
                        border: solid #1ab394;
                        border-width: 5px 10px;
                        line-height: 2;
                        font-weight: bold;
                        text-align: center;
                        cursor: pointer;
                        display: inline-block;
                        border-radius: 5px;
                        text-transform: capitalize;
                    }

                    /* -------------------------------------
                        OTHER STYLES THAT MIGHT BE USEFUL
                    ------------------------------------- */
                    .last {
                        margin-bottom: 0;
                    }

                    .first {
                        margin-top: 0;
                    }

                    .aligncenter {
                        text-align: center;
                    }

                    .alignright {
                        text-align: right;
                    }

                    .alignleft {
                        text-align: left;
                    }

                    .clear {
                        clear: both;
                    }

                    /* -------------------------------------
                        ALERTS
                        Change the class depending on warning email, good email or bad email
                    ------------------------------------- */
                    .alert {
                        font-size: 16px;
                        color: #fff;
                        font-weight: 500;
                        padding: 20px;
                        text-align: center;
                        border-radius: 3px 3px 0 0;
                    }
                    .alert a {
                        color: #fff;
                        text-decoration: none;
                        font-weight: 500;
                        font-size: 16px;
                    }
                    .alert.alert-warning {
                        background: #f8ac59;
                    }
                    .alert.alert-bad {
                        background: #ed5565;
                    }
                    .alert.alert-good {
                        background: #1ab394;
                    }

                    /* -------------------------------------
                        INVOICE
                        Styles for the billing table
                    ------------------------------------- */
                    .invoice {
                        margin: 40px auto;
                        text-align: left;
                        width: 80%;
                    }
                    .invoice td {
                        padding: 5px 0;
                    }
                    .invoice .invoice-items {
                        width: 100%;
                    }
                    .invoice .invoice-items td {
                        border-top: #eee 1px solid;
                    }
                    .invoice .invoice-items .total td {
                        border-top: 2px solid #333;
                        border-bottom: 2px solid #333;
                        font-weight: 700;
                    }

                    /* -------------------------------------
                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                    ------------------------------------- */
                    @media only screen and (max-width: 640px) {
                        h1, h2, h3, h4 {
                            font-weight: 600 !important;
                            margin: 20px 0 5px !important;
                        }

                        h1 {
                            font-size: 22px !important;
                        }

                        h2 {
                            font-size: 18px !important;
                        }

                        h3 {
                            font-size: 16px !important;
                        }

                        .container {
                            width: 100% !important;
                        }

                        .content, .content-wrap {
                            padding: 10px !important;
                        }

                        .invoice {
                            width: 100% !important;
                        }
                    }
                    </style>

                    <table class="body-wrap">
                        <tbody><tr>
                            <td></td>
                            <td class="container" width="600">
                                <div class="content">
                                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody><tr>
                                            <td class="content-wrap aligncenter">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tbody><tr>
                                                        <td class="content-block">
                                                            <h2>Tinggal Selangkah Lagi</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            <table class="invoice">
                                                                <tbody><tr>
                                                                    <td>'.$datamhs->nama.'<br>Invoice '.$token.'<br>'. time().'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                                            <tbody><tr>
                                                                                <td>'.$paket.'</td>
                                                                                <td class="alignright">'.$bayar.'</td>
                                                                            </tr>
                                                                            
                                                                            <tr class="total">
                                                                                <td class="alignright" width="80%">Total</td>
                                                                                <td class="alignright">'.$bayar.'</td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            <a href="https://member.bimbelcpnsonline.id/invoice/konfirmasi/'.$token.'">Menuju Konfirmasi</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            Bimbel CPNS Online
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    <div class="footer">
                                        <table width="100%">
                                            <tbody><tr>
                                                <td class="aligncenter content-block">Questions? Email <a href="mailto:">info@bimbelcpnsonline.id</a></td>
                                            </tr>
                                        </tbody></table>
                                    </div></div>
                            </td>
                            <td></td>
                        </tr>
                    </tbody></table>
                    ';        


                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        $data = [
                                'status'    => false,
                                'msg'    => 'Email Salah !' .$mail->ErrorInfo
                            ];
                        $this->output_json($data);
                    }else{
                        //echo 'Message has been sent';
                        redirect('invoice/konfirmasi/'.$token);
                    }
                }

                public function kirim_email_konfirmasi($token, $subject, $kontenHTML)
                {
                    //print_r($token, $subject);
                    $datamhs  = $this->master->getMahasiswaByToken($token);
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
                        $data = [
                            'status'    => true,
                            'token' => $token,
                            'msg' => 'Berhasil Konfirmasi dan Kirim Email ke ' . $datamhs->email,
                            'errors'    => ''
                        ];
                        $this->output_json($data);

                        //$this->konfirmasi($token);
                    }
                }

                public function kirim_email_admin($token, $subject, $kontenHTML)
                {
                    //print_r($token, $subject);
                    $datamhs  = $this->master->getMahasiswaByToken($token);
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
                    $mail->addAddress('copycut7@gmail.com'); //email tujuan pengiriman email
                
                    // Email subject
                    $mail->Subject = 'Aktifkan Akun '. $datamhs->email; //subject email
                
                    // Set email format to HTML
                    $mail->isHTML(true);
                
                    // Email body content
                    $mailContent = 'Calon Peserta Dengan Email ' . $datamhs->email . ' Sudah Melakukan Konfirmasi Pembayaran, Segera Aktifkan User Pada Menu Master Peserta, <br> Klik '. $this->config->item('urlbimbel') .' Untuk Login' ; // isi email
                    $mail->Body = $mailContent;
                
                    // Send email
                    if(!$mail->send()){
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                        //echo 'Message has been sent';
                        //$this->konfirmasi($token);
                    }
                }
 
}