
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>  
<head>
	<meta charset="UTF-8">
	<title>

	</title>
	<style>
		.div-1 {
			background-color: #ffffff;
		}

		.div-2 {
			background-color: #ABBAEA;
		}

		.div-3 {
			background-color: #FBD603;
		}
	</style>

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
	<div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px">
		<?=form_open_multipart('invoice/lakukan_konfirmasi/'.$token, array('id'=>'formkonfirmasi'), array('method'=>'add'));?>
		<div class="container div-1">
			<div class="login-box-body">
				    <div class="col-md-6 text-center" style="padding-top: 50px">
						<center>
							<!-- <a href="" target="_blank" rel="noopener noreferrer"> -->
								<img src="<?= base_url('assets/dist/img/b.png') ?>" width="40%" alt="" srcset="">
						</center>
						<!-- <h3 class=" mt-0 mb-12">
							<b>B</b>imbel <b>CPNS</b><b> O</b>nline
						</h3>  -->
					<!-- </a> -->

						<h2 style="text-align:center">INVOICE: <?php echo$this->uri->segment(3);?></h2>
						<h3 style="text-align:center">Calon Peserta: <?php echo $nama;?></h3>
						<!-- <h3 style="text-align:center"><?php echo $jurusan;?> Rp. <?php echo $harga;?></h3> -->
						<br>
						
						<br>

						<?php if(!empty($file)) : ?>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<?=tampil_media('uploads/file_konfirmasi/'.$file);?>
							</div>
							<div class="col-md-1"></div>
						    
						<?php endif;?>
						<!-- <a href="#" class="button">Konfirmasi</a> -->

					</div>
					<div class=" col-md-6">
						 <?php if(!empty($file)) : ?>
							<nav aria-label="breadcrumb">
								<h4>Tiga Langkah Pendaftaran</h4>
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item">1. Pendaftaran</li>
							    <li class="breadcrumb-item">2. Konfirmasi</li>
							    <li class="breadcrumb-item active"><b>3. Selesai</b></li>
							  </ol>
							</nav>
							<h5 class="alert bg-info text-center">Setelah Data Konfirmasi Kami Verifikasi Password Akan di kirim via Email ! <b><?php echo $email;?></b>, Periksa Pada Kotak Masuk Atau SPAM</h5>
						   <?php else : ?>
						    <nav aria-label="breadcrumb">
						    	<h4>Tiga Langkah Pendaftaran</h4>
						      <ol class="breadcrumb">
						        <li class="breadcrumb-item">1. Pendaftaran</li>
						        <li class="breadcrumb-item active"><b>2. Konfirmasi</b></li>
						        <li class="breadcrumb-item">3. Selesai</li>
						      </ol>
						    </nav>
						    <h5 class="alert bg-info text-center">Invoice juga kami kirim via Email! <b><?php echo $email;?></b>, Periksa Pada Kotak Masuk Atau SPAM</h5>
						   <?php endif;?>

						<div class="col-md-12">
						  <ul class="price">
						  	<!-- 4CAF50 -->
						  	<li class="header" style="background-color:#4CAF50"><?php echo $jurusan;?></li>
						    <li class="grey">Silakan Transfer Rp. <?php echo $jumlah_transfer;?></li>
						    <li>Rekening Mandiri</li>
						    <li>9000025229858</li>
						    <li>Atas Nama : Sugik Kusmanto</li>
						    
							
						    <input type="hidden" name="token" id="token" value="<?php echo $token;?>">
						    

						    <?php if(!empty($file)) : ?>

						        <li class="grey"><label class="btn btn-primary btn-flat disabled">Konfirmasi Berhasil</label>
						        </li>

						    <?php else : ?>

					    	    <li><label for="file_bukti" class="control-label pull-left">Upload Bukti Transfer</label>
					    		  <div class="form-group">
					    		      <input type="file" name="file_bukti" class="form-control">
					    		      <small class="help-block" style="color: #dc3545"><?=form_error('file_bukti')?></small>
					    		  </div>
					    		</li>
						    	<h5 class="text-danger" style="text-align:center">Pastikan Anda Sudah Transfer Sebelum Klik Konfirmasi Pembayaran.</h5>  
						        <!-- <li class="grey"><?= form_submit('submit', lang('deactivate_validation_confirm_label'), array('id'=>'submit','class'=>'btn btn-primary'));?>
						        </li> -->
						        <button id="submit" name="submit" class="btn btn-primary btn-block btn-flat">Konfirmasi Pembayaran</button></br>

						    <?php endif;?>

						  </ul><br>
						  <h5 class="text-center">Jika ada kendala Konfirmasi Sistem, Klik Konfirmasi Via Whatsapp !</h5>
						  <div class="text-center">
						  	<a class="btn btn-success" href="https://wa.me/6282244795027?text=Mohon%20dibantu,%20Saya%20kesulitan%20Konfirmasi%20via%20sistem%20bimbelCPNSonline.id" target="_blank">Konfirmasi Via Whatsapp</a>  
						  </div>
						  

						</div>
		    		</div>
		    		<div class="row"></div>
		    </div>
	    </div>
	     <?=form_close();?>
	</div>
</body>
</html>

<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/invoice.js"></script>
