
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
	<div class="col-md-12" style="padding-top: 100px">
		<?=form_open_multipart('invoice/lakukan_konfirmasi/'.$token, array('id'=>'formkonfirmasi'), array('method'=>'add'));?>
		<div class="container div-1">
			<div class="login-box-body">
				    <div class="col-md-6 text-center" style="padding-top: 50px">
						<center>
							<a href="" target="_blank" rel="noopener noreferrer">
								<img src="<?= base_url('assets/dist/img/b.png') ?>" width="15%" alt="" srcset="">
						</center>
						<h3 class=" mt-0 mb-12">
							<b>B</b>imbel <b>CPNS</b><b> O</b>nline
						</h3> </a><br>

						<h2 style="text-align:center">INVOICE: <?php echo$this->uri->segment(3);?></h2>
						<h3 style="text-align:center">Calon Peserta: <?php echo $nama;?></h3>
						<h3 style="text-align:center"><?php echo $jurusan;?> Rp. <?php echo $harga;?></h3>
						<br>
						
						<br>

						<?php if(!empty($file)) : ?>
						    <?=tampil_media('uploads/file_konfirmasi/'.$file);?>
						<?php endif;?>
						<!-- <a href="#" class="button">Konfirmasi</a> -->

					</div>
					<div class=" col-md-6">
						<div class="col-md-12">
						  <ul class="price">
						  	<li class="header" style="background-color:#4CAF50"><?php echo $jurusan;?> Rp. <?php echo $harga;?></li>
						    <li class="grey">Silakan Transfer Rp. <?php echo $harga;?></li>
						    <li>Rekening BCA</li>
						    <li>8886985856</li>
						    <li>Atas Nama : Irawati</li>
						    <input type="hidden" name="token" id="token" value="<?php echo $token;?>">
						    <li class="grey"><button type="submit" id="submit" class="btn btn-success"><i class="fa fa-save"></i> Konfirmasi</button></li>

						  </ul><br>

						  <h5 class="text-danger" style="text-align:center">Pastikan Anda Sudah Transfer Sebelum Klik Konfirmasi.</h5>

						  <label for="file_bukti" class="control-label">Upload Bukti Transfer</label>
						  <div class="form-group">
						      <input type="file" name="file_bukti" class="form-control">
						      <small class="help-block" style="color: #dc3545"><?=form_error('file_bukti')?></small>
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
