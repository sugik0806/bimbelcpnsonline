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

<?php else : ?>

<div class="row">
    <div class="col-sm-6">
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
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Pemberitahuan</h3>
            </div>
            <div class="box-body text-center">
                <!-- <p>Klik masuk Tryout untuk mengikuti Tryout</p>
                <center> -->
                    
                <?php if( $mahasiswa->id_jurusan == 1 ) : ?>
                       <!-- hanya download materi -->
                       <!-- <a href="<?= base_url('dokumen') ?>" class="btn btn-sm btn-flat bg-green"><i class="fa fa-download"></i> Unduh Materi</a> -->
                       <div class="col-lg-6 col-xs-6">
                           <div class="small-box bg-red">
                           <div class="inner">
                               <h4>Unduh</h4>
                               <p>Materi</p>
                           </div>
                           <div class="icon">
                               <i class="fa fa-download"></i>
                           </div>
                           <a href="<?= base_url('dokumen') ?>" class="small-box-footer">
                               Masuk <i class="fa fa-arrow-circle-right"></i>
                           </a>
                           </div>
                       </div>

                       <div class="col-lg-6 col-xs-6">
                           <div class="small-box bg-green">
                           <div class="inner">
                               <h4>Tryout</h4>
                               <p>List Tryout</p>
                           </div>
                           <div class="icon">
                               <i class="fa fa-pencil"></i>
                           </div>
                           <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20ikut%20Tryout" target="_blank" class="small-box-footer">
                               Upgrade Untuk Ikut Tryout <i class="fa fa-arrow-circle-right"></i>
                           </a>
                           </div>
                       </div>

                <?php elseif( $mahasiswa->id_jurusan == 2 ) : ?>
                        <!-- hanya Tryout -->
                        <!-- <a href="<?= base_url('ujian/list') ?>" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-book"></i> Masuk Tryout</a> -->
                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-red">
                            <div class="inner">
                                <h4>Unduh</h4>
                                <p>Materi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-download"></i>
                            </div>
                            <a href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20download%20Materi" target="_blank"  class="small-box-footer">
                                Upgrade Untuk Download Materi <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-green">
                            <div class="inner">
                                <h4>Tryout</h4>
                                <p>List Tryout</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <a href="<?= base_url('ujian/list') ?>" class="small-box-footer">
                                Masuk <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                <?php elseif( $mahasiswa->id_jurusan == 3 ) : ?>
                        <!-- <a href="<?= base_url('dokumen') ?>" class="btn btn-sm btn-flat bg-green"><i class="fa fa-download"></i> Unduh Materi</a>
                        <a href="<?= base_url('ujian/list') ?>" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-book"></i> Masuk Tryout</a> -->
                        

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-red">
                            <div class="inner">
                                <h4>Unduh</h4>
                                <p>Materi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-download"></i>
                            </div>
                            <a href="<?= base_url('dokumen') ?>" class="small-box-footer">
                                Masuk <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-6">
                            <div class="small-box bg-green">
                            <div class="inner">
                                <h4>Tryout</h4>
                                <p>List Tryout</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <a href="<?= base_url('ujian/list') ?>" class="small-box-footer">
                                Masuk <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </div>
                        </div>
                <?php endif; ?>
                <!-- print_r($data['mahasiswa']->id_jurusan); -->
                
                    

                     

                <!-- <a href="http://blogbugabagi.blogspot.com" target="_blank" rel="noopener noreferrer">
                    <img src="<?= base_url('assets/dist/img/b.png') ?>" width="30%" alt="" srcset="">
                </a> -->
                </center>
            </div>
        </div>
    </div>

</div>
    
<div class="col-sm-12">
    <div class="row">
      
        <div class="col-sm-12">
          <div class="col-sm-6">
            <canvas style="background: #ffffff" id="cart2"></canvas>
          </div>
          <div class="col-sm-6">
            <canvas style="background: #ffffff" id="cart3"></canvas>
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

<?php endif; ?>

<div class="col-md-12" style="margin-top: 15px">
  <center>
    <a class="btn btn-info" target="_blank" href="https://t.me/joinchat/Is1JSH4mQxgDdlzG">Gabung Grup Telegram</a>
  </center>
</div>


<script type="text/javascript">
   
    var events = <?php echo json_encode($data) ?>;
    console.info(<?php echo json_encode($data) ?>);
    
    var date = new  Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    console.info(d,m,y);    
           
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

<!-- <script src="<?=base_url()?>assets/dist/js/app/dashboard.js"></script> -->