    <link rel="stylesheet" href="<?= base_url('assets/dist/css/fullcalendar.min.css') ?>" />
    <script src="<?= base_url('assets/dist/js/app/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/app/fullcalendar.min.js') ?>"></script>
    <!-- <script src="<?= base_url()?>assets/node_modules/fullcalendar/locales-all.js"></script>
    <script src='<?= base_url()?>assets/node_modules/fullcalendar/locales/id.js'></script> -->
    

<?php if( $this->ion_auth->is_admin() ) : ?>
<div class="row">
    <?php foreach($info_box as $info) : ?>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-<?=$info->box?>">
        <div class="inner">
            <h3><?=$info->total;?></h3>
            <p><?=$info->title;?></p>
        </div>
        <div class="icon">
            <i class="fa fa-<?=$info->icon?>"></i>
        </div>
        <a href="<?=base_url().strtolower($info->url);?>" class="small-box-footer">
            Lihat <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="row" style="padding-top: 5%">
    <div class="col-lg-6 col-xs-12">
        <canvas id="cart1"></canvas>
    </div>
    <div class="col-lg-6 col-xs-12">
        <canvas id="cart2"></canvas>
    </div>
    <!-- <div style="padding-top: 50px;" class="col-lg-11 col-xs-12">
        <canvas id="cart3"></canvas>
    </div> -->
</div>
<!-- Diagram -->
<script type="text/javascript">
	var ctx = document.getElementById("cart1").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
		labels: [<?php foreach($info_box as $info) : ?>"<?=$info->title;?>", <?php endforeach; ?>],
		datasets: [{
			label: 'CBT',
			data:[<?php foreach($info_box as $info) : ?><?=$info->total;?>,<?php endforeach; ?>],
			backgroundColor: [
			'rgba(75, 192, 192, 0.2)',
			'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)'
			]
		}]
		},
	});
</script>
<script type="text/javascript">
	var ctx = document.getElementById("cart2").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'horizontalBar',
		data: {
		labels: [<?php foreach($info_box_geo as $info) : ?>"<?=$info->nama_provinsi;?>", <?php endforeach; ?>],
		datasets: [{
			label: 'Geografi Peserta',
			data:[<?php foreach($info_box_geo as $info) : ?><?=$info->total;?>,<?php endforeach; ?>],
       backgroundColor: [
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      ]
		}]
		},
	});
</script>


<!-- <script type="text/javascript">
  var ctx = document.getElementById("cart3").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
    labels: [<?php foreach($info_box_geo as $info) : ?>"<?=$info->nama_provinsi;?>", <?php endforeach; ?>],
    datasets: [{
      label: 'Geografi Peserta',
      data:[<?php foreach($info_box_geo as $info) : ?><?=$info->total;?>,<?php endforeach; ?>],
      backgroundColor: [
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(103, 12, 15, 0.2)',
      'rgba(93, 133, 155, 0.2)',
      ]
    }]
    },
  });
</script> -->

            <!-- End-Diagram -->
<?php elseif( $this->ion_auth->in_group('dosen') ) : ?>

<div class="row">
    <div class="col-sm-4">
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <div class="info-box" style="padding-left: 10px">
            <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Nama:</span>
              <span class="info-box-number"><?=$dosen->nama_dosen?></span>
              <span class="info-box-text">Email:</span>
              <span  class="info-box-number"><?=$dosen->email?></span>
              <span class="info-box-text">Mata Bimbingan:</span>
              <span  class="info-box-number"><?=$dosen->nama_matkul?></span>
              <span class="info-box-text">Daftar Kelas:</span>
              <span  class="info-box-number">
                <ol class="pl-5">
                    <?php foreach ($kelas as $k) : ?>
                        <li><?=$k->nama_kelas?></li>
                    <?php endforeach;?>
                </ol>
              </span>
            </div>
          </div>
        </div> -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Peserta</h3>
            </div>
            <div class="info-box" style="padding-left: 10px">
            <span class="info-box-icon bg-green"><i class="fa fa-group"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Peserta SKD:</span>
              <span id="total_skd" class="info-box-number"></span>
              <span class="info-box-text">Peserta SKB:</span>
              <span id="total_skb" class="info-box-number"></span>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-8 text-center" >
        <div class="box box-primary">
            <div class="box-header with-border alert alert-info">
                <h3 class="box-title">Jadwal Tryout</h3>
            </div>
            <div class="box-body">
                 <div id="calendar"></div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="btn btn-secondary btn-flat btn-sm" style="background: #A0A0A0"></div><strong>SKD Atau SKB!</strong> Belum Terbit.
        <div class="btn btn-warning btn-flat btn-sm"></div><strong>SKD Atau SKB!</strong> Belum Mulai.
        <div class="btn btn-success btn-flat btn-sm"></div><strong>SKD!</strong> Masuk Waktu.
        <div class="btn btn-info btn-flat btn-sm"></div><strong>SKB!</strong> Masuk Waktu.
        <div class="btn btn-danger btn-flat btn-sm"></div><strong>SKD Atau SKB!</strong> Lewat Waktu.
    </div>
</div>

<script type="text/javascript">
   
    var events = <?php echo json_encode($data) ?>;
    
    var date = new  Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
           
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      editable: true,
      // timeFormat: {
      //       agenda: 'H(:mm)' //h:mm{ - h:mm}'
      //   },
      // time formats
      // titleFormat: {
      //     month: 'MMMM yyyy',
      //     week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
      //     day: 'dddd, MMM d, yyyy'
      // },
      // columnFormat: {
      //     month: 'ddd',
      //     week: 'ddd M/d',
      //     day: 'dddd M/d'
      // },
      axisFormat: 'H(:mm)', //,'h(:mm)tt',

      // locale
        eventDrop: function(event, delta) {
            alert(event.title + ' was moved ' + delta + ' days\n' + '(should probably update your database)');
            console.info(event.id, delta + ' days\n');
        },
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week : 'Minggu',
            day  : 'Hari'
        },
        eventClick: function(calEvent, jsEvent, view) {     
            window.location = "ujian/edit/" + calEvent.id;
             //base_url('dokumen')
            console.info(calEvent.id);
        },
        // loading: function(bool) {
        //     if (bool)
        //         $('#loading').show();
        //     else
        //         $('#loading').hide();
        // },
      events    : events
    })
</script>

<?php else : ?>

<div class="row">
    <div class="col-md-6">
       <!--  <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <div class="info-box" style="padding-left: 10px">
            <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Nama:</span>
              <span class="info-box-number"><?=$mahasiswa->nama?></span>
              <span class="info-box-text">Email:</span>
              <span  class="info-box-number"><?=$mahasiswa->email?></span>
              <span class="info-box-text">Paket:</span>
              <span  class="info-box-number"><?=$mahasiswa->nama_jurusan?></span>
              <span class="info-box-text">Mata Bimbingan:</span>
              <span  class="info-box-number"><?=$mahasiswa->nama_matkul?></span>
            </div>
          </div>
        </div> -->

        <!-- <div class="box box-solid">
            <div class="box-header bg-green">
                <h3 class="box-title">Informasi Akun</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Username</th>
                    <td><?=$mahasiswa->nim?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?=$mahasiswa->nama?></td>
                </tr>
               <tr>
                    <th>Jenis Kelamin</th>
                    <td><?=$mahasiswa->jenis_kelamin === 'L' ? "Laki-laki" : "Perempuan" ;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$mahasiswa->email?></td>
                </tr>
                <tr>
                    <th>Paket</th>
                    <td><?=$mahasiswa->nama_jurusan?></td>
                </tr>
                <tr>
                    <th>Mata Bimbingan</th>
                    <td><?=$mahasiswa->nama_matkul?></td>
                </tr>
            </table>
        </div> -->
    </div>
    <div id="panel" class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
              <h4> Panel Unduh & Tryout </h4>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
              </div>
          </div>
           
            <div class="box-body text-center">
                    
                <?php if( $mahasiswa->id_jurusan == 1 ) : ?>

                       <div class="col-lg-6 col-xs-6">
                           <div class="small-box bg-red" onclick="return keMateri();">
                           <div class="inner">
                               <h3>Unduh</h3>
                               <p>Materi</p>
                           </div>
                           <div class="icon">
                               <i class="fa fa-download"></i>
                           </div>
                           <a href="<?= base_url('dokumen') ?>" class="small-box-footer">
                               <h5>Masuk <i class="fa fa-arrow-circle-right fa-lg"></i></h5>
                           </a>
                           </div>
                       </div>

                       <div class="col-lg-6 col-xs-6">
                           <div class="small-box bg-green" onclick="return keUpgradeTryout();">
                           <div class="inner">
                               <h3>Tryout</h3>
                               <p>List Tryout</p>
                           </div>
                           <div class="icon">
                               <i class="fa fa-pencil"></i>
                           </div>
                           <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20ikut%20Tryout" target="_blank" class="small-box-footer">
                              <h5>Upgrade Untuk Ikut Tryout <i class="fa fa-money fa-lg"></i></h5>
                           </a>
                           </div>
                       </div>

                <?php elseif( $mahasiswa->id_jurusan == 2 ) : ?>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-red" onclick="return keUpgradeMateri();">
                            <div class="inner">
                                <h3>Unduh</h3>
                                <p>Materi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-download"></i>
                            </div>
                            <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20download%20Materi" target="_blank"  class="small-box-footer">
                                <h5>Upgrade Untuk Unduh Materi <i class="fa fa-money fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-green" onclick="return keTryout();">
                            <div class="inner">
                                <h3>Tryout</h3>
                                <p>List Tryout</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <a href="<?= base_url('ujian/list') ?>" class="small-box-footer">
                                <h5>Masuk <i class="fa fa-arrow-circle-right fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>

                <?php elseif( $mahasiswa->id_jurusan == 3 ) : ?>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-red" onclick="return keMateri();">
                            <div class="inner">
                                <h3>Unduh</h3>
                                <p>Materi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-download"></i>
                            </div>
                            <a href="<?= base_url('dokumen') ?>" class="small-box-footer">
                                <h5>Masuk <i class="fa fa-arrow-circle-right fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-green" onclick="return keTryout();">
                            <div class="inner">
                                <h3>Tryout</h3>
                                <p>List Tryout</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <a href="<?= base_url('ujian/list') ?>" class="small-box-footer">
                                <h5>Masuk <i class="fa fa-arrow-circle-right fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>
                <?php elseif( $mahasiswa->id_jurusan == 4 ) : ?>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-red" onclick="return keUpgradeMateri();">
                            <div class="inner">
                                <h3>Unduh</h3>
                                <p>Materi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-download"></i>
                            </div>
                            <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20download%20Materi" target="_blank"  class="small-box-footer">
                                <h5>Upgrade Untuk Unduh Materi <i class="fa fa-money fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-green" onclick="return keTryout();">
                            <div class="inner">
                                <h3>Tryout</h3>
                                <p>List Tryout</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <a href="<?= base_url('ujian/list') ?>" class="small-box-footer">
                                <h5>Masuk <i class="fa fa-arrow-circle-right fa-lg"></i></h5>
                            </a>
                            </div>
                        </div>        
                <?php endif; ?>

                </center>
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
              <h4> Grafik Hasil Tryout & Ranking Nasional </h4>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
              </div>
          </div>
         <div class="box-body">
            <div class="col-md-12">
              <div class="col-md-8">
                <canvas style="background: #ffffff" id="cart2"></canvas>
              </div>
              <div class="col-md-4">
                <canvas style="background: #ffffff" id="cart3"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Diagram -->
        <script type="text/javascript">

          <?php if( $mahasiswa->id_matkul == 1 ) : ?>
            var matkul = 'SKB';
          <?php elseif( $mahasiswa->id_matkul == 2 ) : ?>
            var matkul = 'SKD';
          <?php endif; ?> 

            var ctx = document.getElementById("cart2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: [<?php foreach($info_box_ujian as $info) : ?>"<?=$info->title;?>", <?php endforeach; ?>],
                datasets: [{
                    label: 'Hasil Tryout '+matkul,
                    borderColor: "#3e95cd",
                    fill: false,
                    data:[<?php foreach($info_box_ujian as $info) : ?><?=$info->total;?>,<?php endforeach; ?>]
                }]
                },
            });
        </script> 

        <script type="text/javascript">
            var ctx = document.getElementById("cart3").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                labels: [<?php foreach($info_box_ran as $info) : ?>"<?=$info->nama;?>", <?php endforeach; ?>],
                datasets: [{
                    label: '10 Besar Ranking Nasional '+matkul,
                    borderColor: "#8e5ea2",
                    fill: false,
                    data:[<?php foreach($info_box_ran as $info) : ?><?=$info->nilai_rata;?>,<?php endforeach; ?>],
                     backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(103, 12, 15, 0.2)',
                    'rgba(93, 133, 155, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(103, 12, 15, 0.2)',
                    'rgba(93, 133, 155, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(103, 12, 15, 0.2)',
                    'rgba(93, 133, 155, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(103, 12, 15, 0.2)',
                    'rgba(93, 133, 155, 0.2)',
                    ]
                }]
                },
            });
        </script>
        <!-- End-Diagram -->
    </div>

    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h4> Tahapan belajar yang BENAR di bimbelCPNSonline.id : </h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body" style="font-size:14px;">
          
          <!-- https://t.me/joinchat/Is1JSH4mQxgDdlzG -->

        <?php if( $mahasiswa->id_jurusan == 3 ) : ?> 
          <!-- <p>1. Bergabunglah di group Whatsapp, caranya klik button <a class="btn btn-sm btn-flat btn-info" target="_blank" href="https://chat.whatsapp.com/Cp2VzKEBZ7qBMlOXakGGCr"><i class="fa fa-whatsapp fa-lg"></i> Gabung Grup Whatsapp</a>, kemudian klik Join Group jika belum punya Whatsapp silakan download dulu, Whatsapp juga bisa diinstall di Komputer</p>  -->
          
            <p>1. Bergabunglah di group Whatsapp, caranya klik button <button class="btn btn-sm btn-flat btn-info disabled" target="_blank" href="https://chat.whatsapp.com/H3gHDtZN9OpBAPIFE1DKA7"><i class="fa fa-whatsapp fa-lg"></i> Gabung Grup Whatsapp</button>, kemudian klik Join Group jika belum punya Whatsapp silakan download dulu, Whatsapp juga bisa diinstall di Komputer</p> 
            <p><b>Anda tidak bisa gabung jika bimbingan sedang berlangsung atau belum mulai, silakan hubungi <a href="https://wa.me/6282244795027?text=Saya%20mau%20ikut%20bimbingan%20meskipun%20ketinggalan,%20 Tolong undang ke grup bimbingan" target="_blank" class="small-box-footer"><b>Whatsapp Admin <i class="fa fa-whatsapp fa-lg"></i></b></a></b></p>

         <?php else : ?>
            <p>1. Bergabunglah di group Whatsapp, caranya klik button <button disabled class="btn btn-sm btn-flat btn-info" target="_blank" href="https://chat.whatsapp.com/Cp2VzKEBZ7qBMlOXakGGCr"><i class="fa fa-whatsapp fa-lg"></i> Gabung Grup Whatsapp</button>, kemudian klik Join Group jika belum punya Whatsapp silakan download dulu, Whatsapp juga bisa diinstall di Komputer (<b>Grup Whatsapp Hanya Untuk Paket Bimbel</b>)</p> <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20Bimbel" target="_blank" class="small-box-footer"><h4>Upgrade Ke Paket Bimbel <i class="fa fa-money fa-lg"></i></h4></a>
         <?php endif; ?>
         <p>2. Unduh materi kami siapkan di <a href="#panel">Panel Unduh Materi</a>, setelah download bacalah dan pelajari dengan teliti serta pahami bentuk, pola penyelesaian soal.</p>
         <p>3. Jika Anda sudah Percaya Diri silahkan mengikuti <a href="#panel">Tryout CAT SKD</a>, untuk melatih dan mengukur kemampuan Anda dalam menjawab soal TWK, TIU dan TKP. kami sudah menyediakan 10 Paket soal SKD (100 soal per paket, total 1000 soal) untuk Anda kerjakan.</p>
         <p>4. Ikuti 2 Paket Pemantapan sebagai pengukur kemampuan kamu dalam mengerjakan test (Paket Pemantapan bisa dikerjakan Jika 10 paket soal sudah selesai dikerjakan, total 200 soal)</p>
       </div>
       
     </div> 
    </div>
    


</div>
    

<?php endif; ?>
