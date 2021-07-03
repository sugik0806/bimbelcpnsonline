<!-- <style>
body {background-color: grey;}
h1   {color: blue;}
p    {color: black;}
div  {background-color: lightblue;}
</style> -->



<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('soal/save', array('id'=>'formsoal'), array('method'=>'edit', 'id_soal'=>$soal->id_soal));?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <a href="<?=base_url()?>soal/detail/<?=$this->uri->segment(3)?>" class="btn btn-xs btn-flat btn-default">
                        <i class="fa fa-search fa-10x"></i> Detail
                    </a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" >
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="dosen_id" class="control-label">Pembimbing</label>
                                <?php if( $this->ion_auth->is_admin() ) : ?>
                                <select required="required" name="dosen_id" id="dosen_id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Pembimbing</option>
                                    <?php 
                                    $sdm = $soal->dosen_id;
                                    foreach ($dosen as $d) : 
                                        $dm = $d->id_dosen ;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$dm?>"><?=$d->nama_dosen?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('dosen_id')?></small>
                                <?php else : ?>
                                <input type="hidden" name="dosen_id" value="<?=$dosen->id_dosen;?>">
                                <!-- <input type="hidden" name="matkul_id" value="<?=$dosen->matkul_id;?>"> -->
                                <input type="text" readonly="readonly" class="form-control" value="<?=$dosen->nama_dosen; ?>">
                                <?php endif; ?>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="dosen_id" class="control-label">Mata Bimbingan</label>
                                <?php ?>
                                <select required="required" name="matkul_id" id="matkul_id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Mata Bimbingan</option>
                                    <?php 
                                    $sdm = $soal->matkul_id;
                                    foreach ($matkul as $d) : 
                                        $dm = $d->id_matkul;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$d->id_matkul?>"><?=$d->nama_matkul?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <small class="help-block" style="color: #dc3545"><?=form_error('id')?></small> -->
                                
                               <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                                <!-- <input type="hidden" name="matkul_id" value="<?=$dosen->matkul_id;?>">
                                <input type="text" readonly="readonly" class="form-control" value="<?=$dosen->nama_dosen; ?> (<?=$dosen->nama_matkul; ?>)"> -->
                                <?php  ?>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="dosen_id" class="control-label">Jenis Soal</label>
                                <?php ?>
                                <select required="required" name="id" id="id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Jenis Soal</option>
                                    <?php 
                                    $sdm = $soal->tipe;
                                    foreach ($jenis as $d) : 
                                        $dm = $d->id;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$dm?>"><?=$d->tipe?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <small class="help-block" style="color: #dc3545"><?=form_error('id')?></small> -->
                                
                               <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                                <!-- <input type="hidden" name="matkul_id" value="<?=$dosen->matkul_id;?>">
                                <input type="text" readonly="readonly" class="form-control" value="<?=$dosen->nama_dosen; ?> (<?=$dosen->nama_matkul; ?>)"> -->
                                <?php  ?>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="dosen_id" class="control-label">Nama Ujian</label>
                                <?php ?>
                                <select required="required" name="id_ujian" id="id_ujian" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Nama Ujian</option>
                                    <?php 
                                    $sdm = $soal->id_ujian;
                                    foreach ($ujian as $d) : 
                                        $dm = $d->id_ujian;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$d->id_ujian?>"><?=$d->nama_ujian?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('id_ujian')?></small>
                                
                               <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                                <!-- <input type="hidden" name="matkul_id" value="<?=$dosen->matkul_id;?>">
                                <input type="text" readonly="readonly" class="form-control" value="<?=$dosen->nama_dosen; ?> (<?=$dosen->nama_matkul; ?>)"> -->
                                <?php  ?>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="aspek" class="control-label">Aspek</label>
                                <?php ?>
                                <select required="required" name="id_aspek" id="id_aspek" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Aspek</option>
                                    <?php 
                                    $sdm = $soal->id_aspek;
                                    foreach ($aspek as $d) : 
                                        $dm = $d->id_aspek;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$dm?>/<?=$soal->id_soal ?>"><?=$d->nama_aspek?> - <?=$d->tipe?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <small class="help-block" style="color: #dc3545"><?=form_error('id')?></small> -->
                                
                               <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                                <!-- <input type="hidden" name="matkul_id" value="<?=$dosen->matkul_id;?>">
                                <input type="text" readonly="readonly" class="form-control" value="<?=$dosen->nama_dosen; ?> (<?=$dosen->nama_matkul; ?>)"> -->
                                <?php  ?>
                            </div>
                            
                            
                            <div class="col-sm-12">
                                <label for="soal" class="control-label text-center">Soal</label>
                                <div class="row">

                                    <center>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <!-- <h4 class="modal-title" id="myModalLabel">Cara Membuat Pop UP Gambar dengan Bootstrap</h4> -->
                                              </div>
                                              <div class="modal-body">
                                                <center>    
                                                    <?php if(!empty($soal->file)) : ?>
                                                        <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                                    <?php endif;?>
                                                </center>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>   
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </center>

                                    <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                                        <div data-toggle="modal" data-target="#myModal">
                                        <?php if(!empty($soal->file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                        <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="soal" id="soal" class="form-control froala-editor"><?=$soal->soal?></textarea><br>

                                        <textarea rows="6" name="soaltrim" id="soaltrim" class="form-control col-md-12"><?=$soal->soal?></textarea>

                                        
                                        <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                                    </div>
                                    <div class="col-md-12" style="padding-top: 10px">
                                           <!--  <a class="btn btn-info pull-right" onclick="return cekduplikasi(soal);">Cek</a> -->
                                            <a class="btn btn-info pull-right" onclick="return normalkan(soal);">normalkan</a>
                                        </div>
                                </div>
                            </div>
                            
                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <?php
                            $abjad = ['a', 'b', 'c', 'd', 'e']; 
                            foreach ($abjad as $abj) :
                                $ABJ = strtoupper($abj); // Abjad Kapital
                                $file = 'file_'.$abj;
                                $opsi = 'opsi_'.$abj;
                            ?>
                            
                            <div class="col-sm-12">
                                <label for="jawaban_<?= $abj; ?>" class="control-label text-center">Jawaban <?= $ABJ; ?></label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="<?= $file; ?>" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error($file)?></small>
                                        <?php if(!empty($soal->$file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->$file);?>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor test"><?=$soal->$opsi?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach; ?>
                            
                            <div id="kunci" class="form-group col-sm-12">
                                <label for="jawaban" class="control-label">Kunci Jawaban</label>
                                <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                    <option value="" disabled >Pilih Kunci Jawaban</option>
                                    <option <?=$soal->jawaban==="A"?"selected":""?> value="A" selected>A</option>
                                    <option <?=$soal->jawaban==="B"?"selected":""?> value="B">B</option>
                                    <option <?=$soal->jawaban==="C"?"selected":""?> value="C">C</option>
                                    <option <?=$soal->jawaban==="D"?"selected":""?> value="D">D</option>
                                    <option <?=$soal->jawaban==="E"?"selected":""?> value="E">E</option>
                                </select>                
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                            </div>


                            <?php ?>
                            <div id="bobot_soal" class="form-group col-sm-12">
                                <label for="jawaban" class="control-label pull-left">Kunci Jawaban Dan Bobot Nilai</label>
                                <div class="row col-md-12 center-block">
                                    
                                <div class="form-group col-sm-2"></div>
                                    <div class="form-group col-sm-2">
                                        <label for="bobotA" class="control-label">A</label>
                                        <input required="required" value="<?=$bobotA; ?>" type="number" name="bobotA" placeholder="" id="bobotA" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('bobotA')?></small>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="bobotB" class="control-label">B</label>
                                        <input required="required" value="<?=$bobotB; ?>" type="number" name="bobotB" placeholder="" id="bobotB" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('bobotB')?></small>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="bobotC" class="control-label">C</label>
                                        <input required="required" value="<?=$bobotC; ?>" type="number" name="bobotC" placeholder="" id="bobotC" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('bobotC')?></small>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="bobotD" class="control-label">D</label>
                                        <input required="required" value="<?=$bobotD; ?>" type="number" name="bobotD" placeholder="" id="bobotD" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('bobotD')?></small>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="bobotE" class="control-label">E</label>
                                        <input required="required" value="<?=$bobotE; ?>" type="number" name="bobotE" placeholder="" id="bobotE" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('bobotE')?></small>
                                    </div>
                                </div>
                                

                                
                                <!-- <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                    <option value="" disabled selected>Lengkapi Kunci Jawaban</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select> --> 

                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>

                                 <?php ?>
                            </div>

                            <div id="bobot_nilai" class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Bobot Nilai</label>
                                <input required="required" value="<?=$soal->bobot?>" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                            </div>
                            <div class="col-sm-12">
                                <label for="pembahasan" class="control-label text-center">Pembahasan</label>
                                <div class="row">
                                   <!--  <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                                        <?php if(!empty($soal->file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                        <?php endif;?>
                                    </div> -->
                                    <div class="form-group col-sm-12">
                                        <textarea name="pembahasan" id="pembahasan" class="form-control froala-editor"><?=$soal->pembahasan?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('pembahasan')?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                   
                                    <div class="pull-left">
                                        <a id="sebelumnya" class="btn btn-info " onclick="return back(<?=$soal->id_soal?>);"><i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                        <a id="selanjutnya" class="btn btn-info " onclick="return next(<?=$soal->id_soal?>);">Selanjutnya <i class="fa fa-arrow-right"></i></a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                        <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                     
                                      
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>
<script src="<?=base_url()?>assets/dist/js/app/soal/edit.js"></script>
