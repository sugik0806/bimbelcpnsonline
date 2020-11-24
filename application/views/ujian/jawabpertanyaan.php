 <div class="row">
    <div class="col-md-12">

        <div class="col-md-12">
            <div class="form-group">
                <select id="filter_by" name="filter_by" class="form-control select2 pull-right">
                    <option selected value="">-- Filter By --</option>
                    <option value="1">Sudah Terjawab</option>
                    <option value="2">Belum Terjawab</option>
                </select>
                <small class="help-block"></small>
                
            </div>

        </div>

        <div id="id_per"></div>
        

        <!-- Footer -->
<footer class="page-footer font-small blue col-md-12">
    <div class="input-group">
        Total Data :
        <span class="badge" id="count"></span>
    </div>
</footer>
<!-- Footer -->

        <!-- <?php  $no = 1; ?>
        <?php foreach($list as $i) : ?>

        <div>
            <<div class="col-md-4">
                <div class="box box-success collapsed-box direct-chat direct-chat-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?=$i->nama_ujian?></h3>
                        <div class="box-tools pull-right">
                            <span data-toggle="tooltip" title="" class="badge bg-green"><?=$i->id_soal?></span>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            
                            <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12 alert">
                            <div class="text-justify">
                             <?=$i->soal?>
                            </div><hr>


                             <?php if( $i->file ) : ?>
                                <img style="margin-bottom: 25px" class="rounded mx-auto d-block img-fluid" src="<?=$i->fileimage?>">
                             <?php endif; ?>
                        </div>

                            <div class="col-md-12" style="margin-top: -40px">
                                <div class="col-md-6 text-center">

                                    <div class="text-justify badge">
                                     Kunci Jawaban : <?=$i->jawaban_benar?>
                                    </div></br>

                                 <?php if( $i->file_a ) : ?>
                                    <img class="rounded mx-auto d-block img-fluid" src="<?=$i->fileimagejwb?>">
                                <?php endif; ?>

                                <?=$i->opsi?>

                                </div>

                                <div class="col-md-6 text-center">
                                    <div class="text-center badge">
                                         Jawaban Peserta : <?=$i->jawabanmhs?>
                                     </div></br>

                                 <?php if( $i->file_a ) : ?>
                                    <img class="rounded mx-auto d-block img-fluid" src="<?=$i->fileimagemhs?>">
                                <?php endif; ?>

                                    <?=$i->opsimhs?>
                                </div>
                            </div>

                            <div class="direct-chat-messages">
                               <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left"><?=$i->nama?></span>
                                        <span class="direct-chat-timestamp pull-right"><?=$i->created_date?></span>
                                    </div>
                                    <img class="direct-chat-img" src="<?= base_url('assets/dist/img/b.png') ?>" alt="message user image">
                                    <div class="direct-chat-text">
                                        <?=$i->pertanyaan?>
                                    </div>
                               </div>

                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Anda</span>
                                        <span class="direct-chat-timestamp pull-left"><?=$i->answer_date?></span>
                                    </div>
                                    <img class="direct-chat-img" src="<?= base_url('assets/dist/img/b.png') ?>" alt="message user image">
                                    <div class="direct-chat-text">
                                        <?=$i->jawaban_pertanyaan?>
                                    </div>
                                </div>
                            </div>

                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                  <li>
                                    <a href="#">
                                      <img class="contacts-list-img" src="<?= base_url('assets/dist/img/b.png') ?>" alt="Contact Avatar">
                                      <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                          Count Dracula
                                          <small class="contacts-list-date pull-right">2/28/2015</small>
                                          </span>
                                          <span class="contacts-list-msg">How have you been? I was...</span>
                                     </div>
                                    </a>
                                </li>
                                </ul>
                            </div>
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                            <textarea rows="1" id="message_<?=$no?>" name="message_<?=$no?>" placeholder="Tulis Jawaban" class="form-control"></textarea>

                            <span class="input-group-btn">
                              <button type="button" onclick="return kirim(<?=$i->id_pertanyaan?>, <?=$no?>);" class="btn btn-success btn-flat">Jawab</button>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <?php $no++; ?>
        <?php endforeach; ?> -->
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/ujian/jawabpertanyaan.js"></script>     