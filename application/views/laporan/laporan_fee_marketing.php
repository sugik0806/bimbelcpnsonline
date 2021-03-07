<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-3">
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm">
                    <i class="fa fa-refresh"></i> Reload</button>
                    <label class="pull-right">Periode</label>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input id="tgl_awal" name="tgl_awal" type="text" class="datetimepicker form-control" placeholder="Tanggal Awal">
                    <small class="help-block"></small>
                </div>
            </div>    
            <div class="col-md-2">    
                <div class="form-group">
                    <input id="tgl_akhir" name="tgl_akhir" type="text" class="datetimepicker form-control" placeholder="Tanggal Akhir">
                    <small class="help-block"></small>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group col-md-8">
                    
                    <!-- <select id="penerima_fee" name="penerima_fee" class="form-control select2 pull-left">
                        <option value="0">- Penerima Fee -</option>
                        <option value="arw04032021">arw04032021</option>
                        <option value="90000252298">90000252298</option>
                    </select> -->
                    <?php ?>
                        <select id="penerima_fee" class="form-control select2" style="width:100% !important">
                            <option value="0">-- Pilih Penerima Fee --</option>
                            <?php foreach ($referal as $m) :?>
                                <option value="<?=$m->referal?>"><?=$m->nama_marketing?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php ?>
                    <small class="help-block"></small>
                </div>
                 <button class="btn btn-success btn-flat btn-sm pull-right" onclick="cetak()"><i class="fa fa-print"></i> Print</button>
                <!-- <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak_fee" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a> -->
            </div>
        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="pendapatan" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Harga</th>
                <th>Angka Unik</th>
                <th>Diskon</th>
                <th>Fee</th>
                <th>Penerima Fee</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Harga</th>
                <th>Angka Unik</th>
                <th>Diskon</th>
                <th>Fee</th>
                <th>Penerima Fee</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/laporan/laporan_fee_marketing.js"></script>