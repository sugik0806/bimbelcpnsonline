<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <!-- <?=form_open('laporan/data', array('id'=>'formPendapatan'), array('method'=>'add'));?> -->
        <div class="row">
            <div class="col-sm-3">
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>

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
                <div class="form-group col-md-5">
                    <select id="rekening" name="rekening" class="select2 pull-left">
                        <option value="0">-- Rekening --</option>
                        <option value="0143252019">0143252019</option>
                        <option value="9000025229858">9000025229858</option>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group col-md-5">
                    <select id="status_transfer" name="status_transfer" class="select2 pull-left">
                        <option value="all">-- Semua --</option>
                        <option value="0">Belum Transfer</option>
                        <option value="1">Sudah Transfer</option>
                    </select>
                    <small class="help-block"></small>
                </div>

                
                 <!-- <a type="button" href="<?=base_url()?>laporan/data" class="btn btn-success btn-flat btn-sm pull-left"><i class="fa fa-print"></i> Cari</a> -->
                    
                    <button class="btn btn-success btn-flat btn-sm pull-right" onclick="cetak()"><i class="fa fa-print"></i> Print</button>
                <!-- <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak/document.getElementById('tgl_awal')" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a> -->
            </div>
        </div>
        <!-- <?=form_close();?> -->
    </div>

    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="pendapatan" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Rekening</th>
                <th>Pendapatan</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Nama Kelas</th>
                <th>Rekening</th>
                <th>Pendapatan</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/laporan/laporan_pendapatan.js"></script>
