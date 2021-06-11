<div class="row">
	<!-- <div class="col-sm-3">
        <div class="alert bg-green">
            <h4>Kelas<i class="pull-right fa fa-building-o"></i></h4>
            <span class="d-block"> <?=$mhs->nama_kelas?></span>                
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert bg-blue">
            <h4>Paket<i class="pull-right fa fa-graduation-cap"></i></h4>
            <span class="d-block"> <?=$mhs->nama_jurusan?></span>                
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert bg-yellow">
            <h4>Tanggal<i class="pull-right fa fa-calendar"></i></h4>
            <span class="d-block"> <?=strftime('%A, %d %B %Y')?></span>                
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert bg-red">
            <h4>Jam<i class="pull-right fa fa-clock-o"></i></h4>
            <span class="d-block"> <span class="live-clock"><?=date('H:i:s')?></span></span>                
        </div>
    </div> -->


    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-refresh"></i> Reload</button>
                    </div>
                </div>
            </div> -->
            <!-- <div class="table-responsive px-4 pb-3" style="border: 0">
                <table id="ujian" class="w-100 table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tryout</th>
                        <th>Mata Bimbingan</th>
						<th>Pembimbing</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu (Durasi)</th>
                        <th>Terlambat</th>
                        <th class="text-center">Aksi</th>
                    </tr>        
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tryout</th>
                        <th>Mata Bimbingan</th>
						<th>Pembimbing</th>
                        <th>Jumlah Soal</th>
                        <th>Waktu (Durasi)</th>
                        <th>Terlambat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </tfoot>
                </table>
                <a href="<?=base_url('dashboard')?>" class="btn btn-flat btn-sm bg-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div> -->


            <div class="row">
                 <div class="col-md-12" style="padding-top: 5px">
                    <!-- <?php $list ?> -->

                     <?php foreach($list as $ls) : ?>
                     
                      <div class="col-md-6">
                      <div class="info-box" style="background: #f0fcfd">
                        <span class="info-box-icon" style="background: #d0f4f9"><img src="<?=base_url()?>assets/dist/img/b.png" width="100%" alt="" srcset=""></span>
                        <div class="info-box-content">
                          <span class="info-box-number"><?=$ls->nama_ujian?></span>
                          <span class="info-box-text">Soal <?=$ls->jumlah_soal?></span>
                          <span class="info-box-text"><?=$ls->menit?></span>

                          <?php foreach($listHasil as $lsh) : ?>
                              <?php if( $ls->ada > 0 && ($ls->id_ujian == $lsh->id_ujian)) : ?>
                                  <span class="info-box-text text-right">TWK: <?=$lsh->twk?></span>
                                  <span class="info-box-text text-right">TIU: <?=$lsh->tiu?></span>
                                  <span class="info-box-text text-right">TKP: <?=$lsh->tkp?></span>

                                  <span class="info-box-number text-right">Nilai Kamu: <?=$lsh->nilai?></span>
                                   <span class="info-box-text text-right"><?=$lsh->nilai*100/500?>% Berpeluang Lolos SKD</span>

                                  <div class="progress">
                                    <div class="progress-bar bg-red" style="width: <?=number_format($lsh->nilai*100/500)?>%"></div>
                                  </div>
                            
                              <?php endif; ?>

                              <?php if( $ls->sedangujian > 0 && ($ls->id_ujian == $lsh->id_ujian)) : ?>
                                <span class="info-box-text">
                                  <a href="<?=base_url('ujian/token/'.$ls->id_ujian)?>">
                                          <i class="fa fa-check-square-o"></i> Tryout Berlangsung
                                      </a>
                                </span>
                              <?php endif; ?>
                              
                          <?php endforeach; ?>

                          <span class="progress-description text-right">
                                <?php if( $ls->ada > 0) : ?>
                                        <a class="btn btn-success" href="<?=base_url('hasilujian/cetak/'.$ls->id_ujian)?>" target="_blank">
                                            <i class="fa fa-print"></i> 
                                        </a>
                                        <a class="btn btn-info" href="<?=base_url('ujian/token/'.$ls->id_ujian.'/review')?>">
                                            <i class="fa fa-check"></i> Tinjauan
                                        </a>

<!-- <?=$lsh->tgl_selesai ?>  -->
<!--  <?=$tgl_selesaimin7 ?>  -->
                                    
                                        <?php if( $ls->bisareset > 0) : ?>
                                        <button class="btn btn-warning" onclick="return keReset(<?=$ls->id_ujian?>);">
                                            <i class="fa fa-pencil"></i> Ulangi
                                        </button>

                                        <?php endif; ?>

                                <?php elseif( $ls->sedangujian > 0 ) : ?>
                                
                                  <a class="btn btn-warning" href="<?=base_url('ujian/token/'.$ls->id_ujian)?>">
                                          <i class="fa fa-check-square-o"></i> Lanjutkan Tryout
                                      </a>
                                  
                                <?php else : ?>
                                    <a class="btn btn-success" href="<?=base_url('ujian/token/'.$ls->id_ujian)?>">
                                        <i class="fa fa-pencil"></i> Ikut Tryout
                                    </a>
                                <?php endif; ?>
                          </span>
                        </div>
                      </div>
                       </div>
                     <?php endforeach; ?>
                 </div>

                 <?php if( $mhs->id_kelas != 4) : ?>
                 <div class="col-md-12">
                   <b><p style="margin: 10px;">#Paket Pemantapan Akan Tampil Setelah Kamu Menyelesaikan 10 Paket Soal dan Pendaftaran CPNS sudah dibuka.</p></b>
                 </div>

                 <?php elseif( $mhs->id_kelas == 4) : ?>
                 
                 <div class="col-md-12" >
                   <a style="margin: 10px;" class="btn btn-warning pull-right" href="https://wa.me/6282244795027?text=Saya%20mau%20Upgrade%20Paket%20untuk%20tambah%20Tryout" target="_blank" >
                        <i class="fa fa-money fa-lg"></i> Upgrade Untuk Tambah Paket Soal Tryout

                    </a>
                 </div>

                 <?php endif; ?>
            </div>
           
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/ujian/list.js"></script>