<?=form_open_multipart('dokumen/save', array('id'=>'formdokumen'), array('method'=>'edit', 'id_dokumen'=>$data->id_dokumen));?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Form <?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>dokumen" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Batal
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">

                <div class="form-group">
                    <label for="matkul">Mata Bimbingan</label>
                    <select name="matkul" id="matkul" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected>Pilih Mata Bimbingan</option>
                        <?php foreach ($matkul as $row) : ?>
                            <option <?=$data->id_matkul===$row->id_matkul?"selected":""?> value="<?=$row->id_matkul?>"><?=$row->nama_matkul?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block"></small>
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected>Pilih jenis</option>
                        <?php foreach ($jenis as $row) : ?>
                            
                            <option <?=$data->id_jenis===$row->id?"selected":""?> value="<?=$row->id?>"><?=$row->tipe?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block"></small>
                </div>

                <div class="form-group">
                    <label for="nama_dokumen">Nama Dokumen</label>
                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="<?=$data->nama_dokumen?>" placeholder="Nama Dokumen">
                    <small class="help-block" style="color: #dc3545"><?=form_error('nama_dokumen')?></small>
                </div>

                <label for="soal" class="control-label">File Dokumen</label>
                    <div class="form-group">
                        
                        <input value="<?=$data->file_dokumen?>" type="file" id="file_dokumen" name="file_dokumen" class="form-control">

                        <small class="help-block" style="color: #dc3545"><?=form_error('file_dokumen')?></small>
                    </div>

                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-flat btn-default">
                        <i class="fa fa-rotate-left"></i> Reset
                    </button>
                    <button type="submit" id="submit" class="btn btn-flat bg-purple">
                        <i class="fa fa-pencil"></i> Update
                    </button>
                </div>

                <?php if(!empty($data->file_dokumen)) : ?>
                        <a target="blank" href='<?=base_url()."uploads/dokumen/".$data->file_dokumen?>' class="btn btn-sm btn-flat btn-primary">
                        <i class="fa fa-download"></i> Download
                    </a>
               
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>
<?=form_close();?>

<script src="<?=base_url()?>assets/dist/js/app/master/dokumen/edit.js"></script>