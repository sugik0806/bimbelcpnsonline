<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Form <?=$judul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8"> 
                <div class="my-2">
                    <div class="form-horizontal form-inline">
                        <a href="<?=base_url('pengeluaran')?>" class="btn btn-default btn-xs">
                            <i class="fa fa-arrow-left"></i> Batal
                        </a>
                        <div class="pull-right">
                            <span> Jumlah : </span><label for=""><?=count($pengeluaran)?></label>
                        </div>
                    </div>
                </div>
                <?=form_open('pengeluaran/save', array('id'=>'pengeluaran'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                            <th># No</th>
                            <th>Tanggal</th>
                            <th>Nama Pengeluaran</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($pengeluaran as $j) : ?>
                        <tr>
                            <td><?=$no?></td>
                            <td>
                                <div class="form-group">
                                    <?=form_hidden('id_pengeluaran['.$no.']', $j->tanggal_pengeluaran)?>
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$j->tanggal_pengeluaran?>" type="text" name="tanggal[<?=$no?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?=form_hidden('id_pengeluaran['.$no.']', $j->id_pengeluaran)?>
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$j->nama_pengeluaran?>" type="text" name="nama_pengeluaran[<?=$no?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?=form_hidden('nominal['.$no.']', $j->nominal)?>
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$j->nominal?>" type="text" name="nominal[<?=$no?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        $no++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/laporan/pengeluaran/edit.js"></script>