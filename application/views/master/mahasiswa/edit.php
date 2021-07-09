<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Form <?=$judul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url('mahasiswa')?>" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Batal
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?=form_open('mahasiswa/save', array('id'=>'mahasiswa'), array('method'=>'edit', 'id_mahasiswa'=>$mahasiswa->id_mahasiswa))?>
                    <div class="form-group">
                        <label for="nim">NP</label>
                        <input value="<?=$mahasiswa->nim?>" autofocus="autofocus" onfocus="this.select()" placeholder="NIM" type="text" name="nim" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input value="<?=$mahasiswa->nama?>" placeholder="Nama" type="text" name="nama" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?=$mahasiswa->email?>" placeholder="Email" type="email" name="email" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">whatsapp</label>
                        <input value="<?=$mahasiswa->whatsapp?>" placeholder="whatsapp" type="number" name="whatsapp" class="form-control">
                        <small class="help-block"></small>
                    </div>
                     <label>Provinsi</label>
                     <?php ?>
                     <select name="provinsi" required="required" id="provinsi" class="form-control select2 form-group" style="width:100% !important">
                         <option value="" disabled selected>Pilih Provinsi</option>
                         <?php foreach ($provinsi as $d) : ?>
                             <option  <?=$mahasiswa->id_provinsi === $d->id_provinsi ? "selected" : "" ?>  value="<?=$d->id_provinsi?>"><?=$d->nama_provinsi?></option>
                         <?php endforeach; ?>
                     </select>
                     <small class="help-block" style="color: #dc3545"><?=form_error('provinsi')?></small>
                     
                    <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                    
                     <?php ?>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control select2">
                            <option value="">-- Pilih --</option>
                            <option <?=$mahasiswa->jenis_kelamin === "L" ? "selected" : "" ?> value="L">Laki-laki</option>
                            <option <?=$mahasiswa->jenis_kelamin === "P" ? "selected" : "" ?> value="P">Perempuan</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Paket</label>
                        <select id="jurusan" name="jurusan" class="form-control select2">
                            <option value="" disabled selected>-- Pilih --</option>
                            <?php foreach ($jurusan as $j) : ?>
                            <option <?=$mahasiswa->id_jurusan === $j->id_jurusan ? "selected" : "" ?> value="<?=$j->id_jurusan?>">
                                <?=$j->nama_jurusan?>
                            </option>
                            <?php endforeach ?>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" name="kelas" class="form-control select2">
                            <option value="" disabled selected>-- Pilih --</option>
                            <?php foreach ($kelas as $k) : ?>
                            <option <?=$mahasiswa->id_kelas === $k->id_kelas ? "selected" : "" ?> value="<?=$k->id_kelas?>">
                                <?=$k->nama_kelas?>
                            </option>
                            <?php endforeach ?>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="matkul_id">Mata Bimbingan</label>
                        <select required="required" name="matkul_id" id="matkul_id" class="select2 form-group" style="width:100% !important">
                            <option value="" disabled selected>Pilih Mata Bimbingan</option>
                            <?php 
                            $sdm = $mahasiswa->id_matkul;
                            foreach ($matkul as $d) : 
                                $dm = $d->id_matkul;?>
                                <option <?=$sdm===$dm?"selected":"";?> value="<?=$d->id_matkul?>"><?=$d->nama_matkul?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input value="<?=$mahasiswa->diskon?>" placeholder="Diskon" type="number" name="diskon" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Bayar Upgrade</label>
                        <input value="<?=$mahasiswa->bayar_upgrade?>" placeholder="Bayar Upgrade" type="number" name="bayar_upgrade" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="referal">Kode Referal Marketing / Email sponsor (Jika Ada)</label>
                        <p>
                            <input class="form-control" type="text" id="referal" name="referal" placeholder="Isikan referal" value="<?=$mahasiswa->referal?>"/>
                        </p>
                    </div>

                    
                    <div class="form-group pull-right">
                        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-rotate-left"></i> Reset</button>
                        <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/master/mahasiswa/edit.js"></script>