<div class="login-box pt-5">
	<!-- /.login-logo -->
	<div class="login-box-body">
	<center>
	<a href="#" target="_blank" rel="noopener noreferrer">
	<img src="<?= base_url('assets/dist/img/b.png') ?>" width="50%" alt="" srcset="">
	</center>
	<!-- <h3 class="text-center mt-0 mb-4">
		<b>B</b>imbel <b>CPNS</b><b> O</b>nline
	</h3>  -->
	<link rel="icon" href="<?=base_url()?>assets/dist/img/b.png" type="png">
</a>
	<p class="login-box-msg">Masukan akun anda</p>
	<!-- <p class="login-box-msg">Gunakan <b>Email</b> sebagai <b>Password</b> saat pertama login</p> -->

	<div id="infoMessage" class="text-center"><?php echo $message;?></div>

	<?= form_open("auth/cek_login", array('id'=>'login'));?>
		<div class="form-group has-feedback">
			<?= form_input($identity);?>
			<span class="fa fa-envelope form-control-feedback"></span>
			<span class="help-block"></span>
		</div>
		<div class="form-group has-feedback">
			<?= form_input($password);?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<span class="help-block"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
			<div class="checkbox icheck">
				<label>
				<?= form_checkbox('remember', '', FALSE, 'id="remember"');?> Ingat saya
				</label>
			</div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
			<?= form_submit('submit', lang('login_submit_btn'), array('id'=>'submit','class'=>'btn btn-primary btn-block btn-flat'));?>
			</div>
			<!-- /.col -->
		</div>
		<?= form_close(); ?>
		<h5>
			<!-- <a href="<?=base_url()?>auth/forgot_password" class="text-center"><?= lang('login_forgot_password');?></a> -->
			<!-- <a href="<?=base_url()?>auth/registrasi" class="text-center pull-right"><?= lang('index_create_user_link');?></a> -->


			
		</h5>
		<br>
		<br>
		<br>
		<hr>
			<a class="btn btn-success" href="https://bimbelcpnsonline.id/#services-section">Daftar Sekarang</a> 
			<label>Jika Belum Terdaftar !</label>
		
	</div>
	
</div>

<script type="text/javascript">
	let base_url = '<?=base_url();?>';
</script>
<script src="<?=base_url()?>assets/dist/js/app/auth/login.js"></script>