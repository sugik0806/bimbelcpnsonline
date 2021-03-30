<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url()?>assets/dist/img/bmerahp.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$user->first_name?></p>
				<small><?=$user->email?></small>
			</div>
		</div>
		
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MENU UTAMA</li>
			<!-- Optionally, you can add icons to the links -->
			<?php 
			$page = $this->uri->segment(1);
			$master = ["jurusan", "kelas", "matkul", "dosen", "mahasiswa" ,"marketing"];
			$relasi = ["kelasdosen", "jurusanmatkul"];
			$users = ["users"];

				if ($this->ion_auth->in_group('admin')) {
					$group = 'admin';
				}else if($this->ion_auth->in_group('dosen')){
					$group = 'dosen';
				}else if($this->ion_auth->in_group('mahasiswa')){
					$group = 'mahasiswa';
				}
			?>

			<li class="<?= $page === 'dashboard' ? "active" : "" ?>"><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

			<?php
            // data main menu
           
           // $this->master->getMenu();

            $main_menu = $this->db->get_where('menus', array('induk' => 0, 'tipe' => 'main','group' => $group , 'aktif' => 1));
            foreach ($main_menu->result() as $main) {
                // Query untuk mencari data sub menu
                $sub_menu = $this->db->get_where('menus', array('induk' => $main->id, 'tipe' => 'main','group' => $group, 'aktif' => 1));
                // periksa apakah ada sub menu
                if ($sub_menu->num_rows() > 0) {
                    // main menu dengan sub menu
                    echo "<li class='treeview'>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu .
                            '<span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>');
                    // sub menu nya disini
                    echo "<ul class='treeview-menu'>";
                    foreach ($sub_menu->result() as $sub) {
                        echo "<li>" . anchor($sub->url, '<i class="' . $sub->icon . '"></i>' . $sub->menu) . "</li>";
                    }
                    echo"</ul></li>";
                } else {
                    // main menu tanpa sub menu
                    echo "<li>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu) . "</li>";

                }
            }
            ?>

            <li class="header">LAPORAN</li>

			<?php
            // data report
            $main_menu = $this->db->get_where('menus', array('induk' => 0, 'tipe' => 'report','group' => $group, 'aktif' => 1));
            foreach ($main_menu->result() as $main) {
                // Query untuk mencari data sub menu
                $sub_menu = $this->db->get_where('menus', array('induk' => $main->id, 'tipe' => 'report','group' => $group, 'aktif' => 1));
                // periksa apakah ada sub menu
                if ($sub_menu->num_rows() > 0) {
                    // main menu dengan sub menu
                    echo "<li class='treeview'>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu .
                            '<span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>');
                    // sub menu nya disini
                    echo "<ul class='treeview-menu'>";
                    foreach ($sub_menu->result() as $sub) {
                        echo "<li>" . anchor($sub->url, '<i class="' . $sub->icon . '"></i>' . $sub->menu) . "</li>";
                    }
                    echo"</ul></li>";
                } else {
                    // main menu tanpa sub menu
                    echo "<li>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu) . "</li>";
                }
            }
            ?>

            <li class="header">PENGATURAN</li>

			<?php
            // data report
            $main_menu = $this->db->get_where('menus', array('induk' => 0, 'tipe' => 'admin', 'group' => $group, 'aktif' => 1));
            foreach ($main_menu->result() as $main) {
                // Query untuk mencari data sub menu
                $sub_menu = $this->db->get_where('menus', array('induk' => $main->id, 'tipe' => 'admin', 'group' => $group, 'aktif' => 1));
                // periksa apakah ada sub menu
                if ($sub_menu->num_rows() > 0) {
                    // main menu dengan sub menu
                    echo "<li class='treeview'>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu .
                            '<span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>');
                    // sub menu nya disini
                    echo "<ul class='treeview-menu'>";
                    foreach ($sub_menu->result() as $sub) {
                        echo "<li>" . anchor($sub->url, '<i class="' . $sub->icon . '"></i>' . $sub->menu) . "</li>";
                    }
                    echo"</ul></li>";
                } else {
                    // main menu tanpa sub menu
                    echo "<li>" . anchor($main->url, '<i class="' . $main->icon . '"></i>' . $main->menu) . "</li>";
                }
            }
            ?>

			<!-- aaaaaaaaaaaa -->

			
		</ul>

	</section>
	<!-- /.sidebar -->
</aside>