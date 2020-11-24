<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('soal/save', array('id'=>'formsoal'), array('method'=>'add'));?>
        <div class="box">
            <div class="box-header with-border">
               <!--  <h3 class="box-title"><?=$subjudul?></h3> -->
                    <label>TWK: </label>
                    <h3 class="box-title"><span class="badge bg-green"><span id="totaltwk"></span> </span></h3>

                    <label>TIU: </label>
                    <h3 class="box-title"><span class="badge bg-green"><span id="totaltiu"></span> </span></h3>

                    <label>TKP: </label>
                    <h3 class="box-title"><span class="badge bg-green"><span id="totaltkp"></span> </span></h3>

                    <label>Total Soal: </label>
                    <h3 class="box-title"><span class="badge bg-blue"><span id="totalsoal"></span> </span></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
           <!--  <div class="alert alert-info">
              <input type="text=" name="totalujian" id="totalujian">
            </div> -->


            
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group col-sm-6">
                            <label>Pembimbing</label>
                            <?php if( $this->ion_auth->is_admin() ) : ?>
                            <select name="dosen_id" required="required" id="dosen_id" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Pilih Pembimbing</option>
                                <?php foreach ($dosen as $d) : ?>
                                    <option value="<?=$d->id_dosen?>:<?=$d->matkul_id?>"><?=$d->nama_dosen?></option>
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
                       <label>Mata Bimbingan</label>
                       <?php ?>
                       <select name="matkul_id" required="required" id="matkul_id" class="select2 form-group" style="width:100% !important">
                           <option value="" disabled selected>Pilih Mata Bimbingan</option>
                           <?php foreach ($matkul as $d) : ?>
                               <option value="<?=$d->id_matkul?>"><?=$d->nama_matkul?></option>
                           <?php endforeach; ?>
                       </select>
                       <small class="help-block" style="color: #dc3545"><?=form_error('matkul_id')?></small>
                       
                      <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                      
                       <?php ?>
                   </div>

                    <small class="help-block"></small>

                        <div class="form-group col-sm-6">
                            <label>Jenis Soal</label>
                            <?php ?>
                            <select name="id" required="required" id="id" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Pilih Jenis Soal</option>
                                <?php foreach ($jenis as $d) : ?>
                                    <option value="<?=$d->id?>"><?=$d->tipe?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="help-block" style="color: #dc3545"><?=form_error('id')?></small>
                            
                           <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                           
                            <?php ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Nama Ujian</label>
                            <?php ?>
                            <select name="id_ujian" required="required" id="id_ujian" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Pilih Nama Ujian</option>
                                <?php foreach ($ujian as $d) : ?>
                                    <option value="<?=$d->id_ujian?>"><?=$d->nama_ujian?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="help-block" style="color: #dc3545"><?=form_error('id_ujian')?></small>
                            
                           <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                           
                            <?php ?>
                            <hr class="my-4">
                        </div>


                       <!--  <?=$jenis->tipe;?> -->
                        
                        <div class="col-sm-12">
                            <label for="soal" class="control-label">Soal</label>
                            <div class="form-group">
                                <input type="file" name="file_soal" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                            </div>
                            <div class="form-group">
                                <textarea onclick="return normalkan(soal);" name="soal" id="soal" class="form-control froala-editor"><?=set_value('soal')?></textarea><br>

                                <textarea rows="5" name="soaltrim" id="soaltrim" class="form-control"><?=set_value('soaltrim')?></textarea>

                                <div class="col-md-12" style="padding-top: 10px">
                                    <span class="badge bg-red" id="totalduplikasi"></span><a class="btn btn-info pull-right" onclick="return cekduplikasi(soal);">Cek</a>
                                    <!-- <a class="btn btn-info pull-right" onclick="return normalkan(soal);">normalkan</a> -->
                                </div>
                                
                                <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                            </div>

                            <div class="" style="padding-top: 50px" id="id_duplikasi"></div><hr>
                        </div>




                        
                        <!-- 
                            Membuat perulangan A-E 
                        -->
                        <?php
                        $abjad = ['a', 'b', 'c', 'd', 'e']; 
                        foreach ($abjad as $abj) :
                            $ABJ = strtoupper($abj); // Abjad Kapital
                        ?>

                        <div class="col-sm-12">
                            <label for="file">Jawaban <?= $ABJ; ?></label>
                            <div class="form-group">
                                <input type="file" name="file_<?= $abj; ?>" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_'.$abj)?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor"><?=set_value('jawaban_a')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                            </div>
                        </div>

                        <?php endforeach; ?>

                        <div  id="kunci" class="form-group col-sm-12">
                            <label for="jawaban" class="control-label">Kunci Jawaban</label>
                            <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                <option value="" disabled >Pilih Kunci Jawaban</option>
                                <option value="A" selected>A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>                
                            <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                        </div>

                         <?php  ?> 
                        <div id="bobot_soal" class="form-group col-sm-12">
                            <label for="jawaban" class="control-label pull-left">Kunci Jawaban Dan Bobot Nilai</label>
                            <div class="row col-md-12 center-block">
                                
                            <div class="form-group col-sm-2"></div>
                                <div class="form-group col-sm-2">
                                    <label for="bobotA" class="control-label">A</label>
                                    <input required="required" value="0" type="number" name="bobotA" placeholder="" id="bobotA" class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('bobotA')?></small>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label for="bobotB" class="control-label">B</label>
                                    <input required="required" value="0" type="number" name="bobotB" placeholder="" id="bobotB" class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('bobotB')?></small>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label for="bobotC" class="control-label">C</label>
                                    <input required="required" value="0" type="number" name="bobotC" placeholder="" id="bobotC" class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('bobotC')?></small>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label for="bobotD" class="control-label">D</label>
                                    <input required="required" value="0" type="number" name="bobotD" placeholder="" id="bobotD" class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('bobotD')?></small>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label for="bobotE" class="control-label">E</label>
                                    <input required="required" value="0" type="number" name="bobotE" placeholder="" id="bobotE" class="form-control">
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

                             <?php  ?>
                        </div>
                        <div id="bobot_nilai" class="form-group col-sm-12">
                            <label for="bobot" class="control-label">Bobot Nilai</label>
                            <input required="required" value="5" type="number" name="bobot" placeholder="Bobot Nilai" id="bobot" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                        </div>

                        <div class="col-sm-12">
                            <label for="pembahasan" class="control-label">Pembahasan</label>
                            <!-- <div class="form-group">
                                <input type="file" name="file_soal" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                            </div> -->
                            <div class="form-group">
                                <textarea name="pembahasan" id="pembahasan" class="form-control froala-editor"><?=set_value('pembahasan')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('pembahasan')?></small>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <button type="reset" class="btn btn-flat btn-default">
                                <i class="fa fa-rotate-left"></i> Reset
                            </button>
                            <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>
<script src="<?=base_url()?>assets/dist/js/app/soal/add.js"></script>