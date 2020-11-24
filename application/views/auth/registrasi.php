
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
	<div class="col-md-12" style="padding-top: 100px">
		<div class="container div-1">
			<div class="login-box-body">
				<div class="col-md-4" style="padding-top: 50px">
					<center>
						<a href="" target="_blank" rel="noopener noreferrer">
							<img src="<?= base_url('assets/dist/img/b.png') ?>" width="80%" alt="" srcset="">
						</center>
						<h3 class="text-center mt-0 mb-12">
							<b>C</b>omputer <b>B</b>ased <b>T</b>est
						</h3> </a>
					</div>
					<div class=" col-md-8">
						<h2>Pendaftaran Akun</h2>

						<!-- <div id="infoMessage" class="text-center"><?php echo $data;?></div> -->


						<?= form_open("auth/cek_registrasi", array('id'=>'registrasi'));?>
						<label for="name">Nama</label>
						<p>
							<input class="form-control" type="text" id="name" name="name" value="<?=set_value('name')?>"/>
						</p>
						<small class="help-block" style="color: #dc3545"><?=form_error('name')?></small>

	 			<!-- <p>Username:</p>
	 			<p>
	 			<input class="form-control" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/> 
	 			</p>
	 			<p> <?php echo form_error('username'); ?> </p> -->
	 			
	 			<label for="email">Email</label>
	 			<p>
	 				<input class="form-control" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>"/>
	 			</p>
	 			<p> <?php echo form_error('email'); ?> </p>
	 			

	 			<div class="form-group">
	 				<label for="gender">Jenis Kelamin</label>
	 				<select id="gender" name="gender" class="form-control select2">
	 					<option value="">-- Pilih --</option>
	 					<option value="L">Laki-laki</option>
	 					<option value="P">Perempuan</option>
	 				</select>
	 				<small class="help-block"></small>
	 			</div>
	 			<div class="form-group">
	 				<label for="jurusan">Paket</label>
	 				<select id="jurusan" name="jurusan" class="form-control select2">
	 					<option value="">-- Pilih --</option>
	 					<option value="1">Paket Materi</option>
	 					<option value="2">Paket Tryout</option>
	 					<option value="3">Paket Bimbel</option>
	 				</select>
	 				<small class="help-block"></small>
	 			</div>

	            <!-- <select name="jurusan" required="required" id="jurusan" class="select2 form-group" style="width:100% !important">
	                <option value="" disabled selected>Pilih Paket</option>
	                <?php foreach ($jurusan as $d) : ?>
	                    <option value="<?=$d->id_jurusan?>"><?=$d->nama_jurusan?></option>
	                <?php endforeach; ?>
	            </select> -->
	            

	            <!-- <?=$data?> -->

	            <div class="col-xs-4 pull-right">
	            	<?= form_submit('submit', lang('create_user_submit_btn'), array('id'=>'submit','class'=>'btn btn-primary btn-block btn-flat'));?>
	            </div>

	            <?= form_close(); ?>

	        </div>

	        <div class="col-md-6 pull-right text-right" style="padding-top: 10px">
	        	<h4>Jika sudah punya akun silakan klik
	        		<a href="<?=base_url()?>" class="text-center"><?= lang('login_submit_btn');?></a>
	        	</h4>
	        </div>

	        <div class="row"></div>



	    </div>
	</div>
</div>


</body>
</html>

<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/registrasi.js"></script>