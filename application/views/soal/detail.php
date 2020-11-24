<div class="box">
    <div class="box-header with-header">
        <h3 class="box-title">Detail Soal</h3>
        <div class="pull-right">
            <a href="<?=base_url()?>soal" class="btn btn-xs btn-flat btn-default">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a href="<?=base_url()?>soal/edit/<?=$this->uri->segment(3)?>" class="btn btn-xs btn-flat btn-warning">
                <i class="fa fa-edit"></i> Edit
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <h3 class="text-left">Soal</h3>
                <h4 class="text-justify"><?=$soal->soal?></h4><hr>
                <?php if(!empty($soal->file)): ?>
                    <div class="w-50">

                        <!-- <img src="<?=base_url()?>uploads/bank_soal/<?=$soal->file?>" alt="" width="100%" height="400px"> -->
                        <?= tampil_media('uploads/bank_soal/'.$soal->file); ?>
                    </div>
                <?php endif; ?>
                
                <hr class="my-4">
                <h3 class="text-left">Jawaban</h3>
                
                <?php 
                    $abjad = ['a', 'b', 'c', 'd', 'e'];
                    $benar = "<i class='fa fa-check-circle text-purple'></i>";
                
                    foreach ($abjad as $abj) :
                    
                            $ABJ = strtoupper($abj);
                            $opsi = 'opsi_'.$abj;
                            $file = 'file_'.$abj;


                        ?>

                        <?php $pecaho = explode(',', $soal->jawaban);?>
                        <?php if(!empty($pecaho[1])): ?>
                            <?php
                                foreach ($pecaho as $key) {
                                    $pecah2 = explode(':', $key);
                                    if ($pecah2[1] ==5) {
                                        if ($pecah2[0] == $ABJ) {
                                             echo($benar);
                                        }
                                       
                                    }
                                }
                            ?>
                        <?php endif; ?>
                    
                        <div class="row">
                          <div class="col-md-1 text-right"><?=$soal->jawaban===$ABJ?$benar:""?></div>
                          <div class="col-md-1 text-right"><?=$ABJ?></div>
                          <div class="col-md-6 text-left">
                              <?=$soal->$opsi?>
                              <?php if(!empty($soal->$file)): ?>
                              <div class="w-50">
                                  <?= tampil_media('uploads/bank_soal/'.$soal->$file); ?>
                              </div>
                              <?php endif;?>
                             
                          </div>
                          
                        </div>
                        
                        
                        
                
                    <?php endforeach;?>

                <?php $pecah = explode(',', $soal->jawaban);?>
                <?php if(!empty($pecah[1])): ?>

                    <hr class="my-4">
                    <h3 class="text-left">Jawaban Benar</h3>
                    
                    <?php
                        foreach ($pecah as $key) {
                            $pecah2 = explode(':', $key);
                            $pecahan = $key;
                            echo("<h4>Jawaban $pecah2[0] </h4>");
                            echo("Bernilai : $pecah2[1] </br>");
                        }
                    ?>
                <?php endif; ?>

                <hr>
                <h4><?=$soal->pembahasan?></h4>
                
                <hr class="my-4">
                <strong>Dibuat pada :</strong> <?=strftime("%A, %d %B %Y", date($soal->created_on))?>
                <br>
                <strong>Terkahir diupdate :</strong> <?=strftime("%A, %d %B %Y", date($soal->updated_on))?>
            <hr></div>
            <div class="col-sm-3 col-sm-offset-5 pull-left">
                <a id="sebelumnya" class="btn btn-info" onclick="return back(<?=$soal->id_soal?>);"><i class="fa fa-arrow-left"></i> Sebelumnya</a>
                <a id="selanjutnya" class="btn btn-info pull-right" onclick="return next(<?=$soal->id_soal?>);">Selanjutnya <i class="fa fa-arrow-right"></i></a>
            </div>

            
        </div><hr>
        

            <div class="box box-default ">
              <div class="box-header with-border">
                <h3 class="box-title">Navigasi Soal</h3>
                <div class="box-tools pull-right">
                    
                  <span name="totalsoal" id="totalsoal" title="Total Soal" class="badge bg-yellow"></span>
                  <span data-toggle="tooltip" title="Id Soal" class="badge bg-red"><?=$soal->id_soal?></span>
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!-- In box-tools add this button if you intend to use the contacts pane -->
                  <!-- <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button> -->
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <div id="navigasi" name="navigasi"></div>
                 

                </div><!--/.direct-chat-messages-->

                
              <div class="box-footer">
              
              </div><!-- /.box-footer-->
            </div><!--/.direct-chat -->
           
        </div>

    
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/soal/detail.js"></script>

