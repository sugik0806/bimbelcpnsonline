<nav class="navbar navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<!-- <a href="<?=base_url()?>" class="navbar-brand"><i class="fa fa-laptop"></i> <b>B</b>imbel <b>CPNS</b> <b>O</b>nline </a> -->
			<img src="https://bimbelcpnsonline.id/wp-content/uploads/2020/12/logo-bimbel-cpns-online-merah-putih.png" width="70px" alt="" srcset="" style="padding: 10px">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<i class="fa fa-bars"></i>
			</button>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="#"><?=$mhs->nama?> - <?=$mhs->nama_kelas?></a></li>
				<!-- <li><a href="#"><?=$mhs->nama_kelas?></a></li> -->
			</ul>
		</div>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li><a href="#" onclick="simpan_akhir()">Akhiri</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						<?=$user->username?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?=base_url('logout')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
        </div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
