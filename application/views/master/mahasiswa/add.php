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
                <?=form_open('mahasiswa/save', array('id'=>'mahasiswa'), array('method'=>'add'))?>
                    <div class="form-group">
                        <label for="nim">NP</label>
                        <input autofocus="autofocus" onfocus="this.select()" placeholder="di isi email" type="text" name="nim" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input placeholder="Nama" type="text" name="nama" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input placeholder="Email" type="email" name="email" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">whatsapp</label>
                        <input placeholder="whatsapp" type="number" name="whatsapp" class="form-control">
                        <small class="help-block"></small>
                    </div>
                     <label>Provinsi</label>
                     <?php ?>
                     <select name="provinsi" required="required" id="provinsi" class="form-control select2 form-group" style="width:100% !important">
                         <option value="" disabled selected>Pilih Provinsi</option>
                         <?php foreach ($provinsi as $d) : ?>
                             <option value="<?=$d->id_provinsi?>"><?=$d->nama_provinsi?></option>
                         <?php endforeach; ?>
                     </select>
                     <small class="help-block" style="color: #dc3545"><?=form_error('provinsi')?></small>
                     
                    <!--  <input type="hidden" name="id" value="<?=$jenis->id;?>"> -->
                    
                     <?php ?>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control select2">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Paket</label>
                        <select id="jurusan" name="jurusan" class="form-control select2">
                            <option value="" disabled selected>-- Pilih --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" name="kelas" class="form-control select2">
                            <option value="">-- Pilih --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <label>Mata Bimbingan</label>
                    <?php ?>
                    <select name="matkul_id" required="required" id="matkul_id" class="select2 form-group" style="width:100% !important">
                        <option value="" disabled selected>Pilih Mata Bimbingan</option>
                        <?php foreach ($matkul as $d) : ?>
                            <option value="<?=$d->id_matkul?>"><?=$d->nama_matkul?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block" style="color: #dc3545"><?=form_error('matkul_id')?></small>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input value="0" placeholder="Diskon" type="number" name="diskon" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <label for="referal">Kode Referal Marketing / Email sponsor (Jika Ada)</label>
                    <p>
                        <input class="form-control" type="text" id="referal" name="referal" placeholder="Isikan referal" value="<?=set_value('referal')?>"/>
                    </p>
                    <small class="help-block" style="color: #dc3545"><?=form_error('referal')?></small>
                    <div class="form-group pull-right">
                        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-rotate-left"></i> Reset</button>
                        <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/master/mahasiswa/add.js"></script>