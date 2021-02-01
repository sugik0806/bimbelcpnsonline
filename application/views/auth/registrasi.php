
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
</head>
<body>
	<div class="col-md-12" style="padding-top: 5%; padding-bottom: 5%">
		<div class="container div-1">
			<div class="login-box-body">

					<div class="col-md-4">
						<center>
						
							<img src="<?= base_url('assets/dist/img/b.png') ?>" width="80%" alt="" srcset="">
						</center>
						<!-- <h3 class="text-center mt-0 mb-12">
							<b>B</b>imbel <b>CPNS</b><b> O</b>nline
						</h3>  -->
					</div>
					<div class=" col-md-8">

						<nav aria-label="breadcrumb">
							<h4>Tiga Langkah Pendaftaran</h4>
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item active"><b>1. Registrasi</b></li>
						    <li class="breadcrumb-item">2. Konfirmasi</li>
						    <li class="breadcrumb-item">3. Selesai</li>
						  </ol>
						</nav>
						
				
						<?php if( $this->uri->segment(3) == 1) : ?>
							<h2 class="alert alert-info text-center">Pendaftaran Akun <b>Paket Materi Rp 150.000</b></h2>
							<h5 class="text-right"><b>Ada pengurangan angka unik !</b></h5>
						<?php elseif( $this->uri->segment(3) == 2) : ?>
							<h2 class="alert alert-success text-center">Pendaftaran Akun <b>Paket Soal Rp 250.000</b></h2>
							<h5 class="text-right"><b>Ada pengurangan angka unik !</b></h5>
						<?php elseif( $this->uri->segment(3) == 3) : ?>
							<h2 class="alert alert-warning text-center">Pendaftaran Akun <b>Paket Bimbel Rp 350.000</b></h2>
							<h5 class="text-right"><b>Ada pengurangan angka unik !</b></h5>
						<?php elseif( $this->uri->segment(3) == 4) : ?>
							<h2 class="alert alert-success text-center">Pendaftaran Akun <b>Paket Bimbel Rp 100.000</b></h2>
							<h5 class="text-right"><b>Ada pengurangan angka unik !</b></h5>	
						<?php elseif( !$this->uri->segment(3)) : ?>
							<h2>Pendaftaran Akun</h2>
						<?php endif; ?>


						<!-- <div id="infoMessage" class="text-center"><?php echo $listpaket;?></div> -->


						<?= form_open("auth/cek_registrasi", array('id'=>'registrasi'));?>
						<label for="name">Nama</label>
						<p>
							<input class="form-control" type="text" id="name" name="name" placeholder="Isikan Nama" value="<?=set_value('name')?>"/>
						</p>
						<small class="help-block" style="color: #dc3545"><?=form_error('name')?></small>

	 			<!-- <p>Username:</p>
	 			<p>
	 			<input class="form-control" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/> 
	 			</p>
	 			<p> <?php echo form_error('username'); ?> </p> -->
	 			
	 			<label for="email">Email</label>
	 			<p>
	 				<input class="form-control" type="text" id="email" name="email" placeholder="contoh: email@email.com (email aktif)" value="<?php echo set_value('email'); ?>"/>
	 			</p>
	 			<p> <?php echo form_error('email'); ?> </p>

	 			<label for="whatsapp">Whatsapp</label>
	 			<p>
	 				<input class="form-control" type="number" id="whatsapp" name="whatsapp" placeholder="Isikan Nomor Whatsapp" value="<?php echo set_value('whatsapp'); ?>"/>
	 			</p>
	 			<p> <?php echo form_error('whatsapp'); ?> </p>
	 			
	 			
 			    <label>Provinsi</label>
 			    <?php ?>
 			    <select name="provinsi" required="required" id="provinsi" class="form-control select2 form-group" style="width:100% !important">
 			        <option value="" disabled selected>Pilih Provinsi</option>
 			        <?php foreach ($provinsi as $d) : ?>
 			            <option value="<?=$d->id_provinsi?>"><?=$d->nama_provinsi?></option>
 			        <?php endforeach; ?>
 			    </select>
 			    <small class="help-block" style="color: #dc3545"><?=form_error('provinsi')?></small>
 			    
 			   <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
 			   
 			    <?php ?>
	 			   
	 			

	 			<div class="form-group">
	 				<label for="gender">Jenis Kelamin</label>
	 				<select id="gender" name="gender" class="form-control select2 form-group">
	 					<option value="">-- Pilih --</option>
	 					<option value="L">Laki-laki</option>
	 					<option value="P">Perempuan</option>
	 				</select>
	 				<small class="help-block"></small>
	 			</div>
	 			<div class="form-group">

	 				<?php if( $this->uri->segment(3)) : ?>
	 					<label hidden="true" for="jurusan">Paket</label>
	 					<input class="form-control" type="hidden" id="jurusan" name="jurusan" value="<?php echo $this->uri->segment(3); ?>"/>
	 				<?php elseif( !$this->uri->segment(3)) : ?>
	 					<label for="jurusan">Paket</label>
	 					<select id="jurusan" name="jurusan" class="form-control select2">
	 						<option value="">-- Pilih --</option>
	 						<option value="1">Paket Materi</option>
	 						<option value="2">Paket Soal</option>
	 						<option value="3">Paket Bimbel</option>
	 					</select>
	 					
	 				<?php endif; ?>

	 				<small class="help-block"></small>
	 			</div>

	            <!-- <select name="jurusan" required="required" id="jurusan" class="select2 form-group" style="width:100% !important">
	                <option value="" disabled selected>Pilih Paket</option>
	                <?php foreach ($jurusan as $d) : ?>
	                    <option value="<?=$d->id_jurusan?>"><?=$d->nama_jurusan?></option>
	                <?php endforeach; ?>
	            </select> -->
	            

	            <!-- <?=$data?> -->

	            <!-- <div class="col-xs-6">
	            	<a class="btn btn-primary btn-block btn-flat pull-left" style="border-radius:2px;background-color:#228B22;color:#fffffa" href="https://wa.me/6282244795027?text=Mohon%20info,%20Bimbingan%20Belajar%20CPNS%20di%20bimbelCPNSonline.id" target="_blank">Daftar Via Whatsapp</a>
	            </div> -->

	            <div class="col-xs-6 pull-right">

	            	<?= form_submit('submit', lang('create_user_submit_btn'), array('id'=>'submit','class'=>'btn btn-primary btn-block btn-flat'));?>
	            </div>

	            <div class="col-md-12 pull-right text-right" style="padding-top: 10px; padding-bottom: 20px">
	            	<h5>Jika sudah punya akun silakan klik
	            		<b><a href="<?=base_url()?>" class="text-center"><?= lang('login_submit_btn');?></a></b>
	            	</h5>
	            </div>

	            <?= form_close(); ?>

	        </div>


	    </div>
	</div>
</div>


</body>
</html>

<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/registrasi.js"></script>