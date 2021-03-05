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
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>

                 <label class="pull-right">Periode</label>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input name="tgl_awal" type="text" class="datetimepicker form-control" placeholder="Tanggal Awal">
                    <small class="help-block"></small>
                </div>
            </div>    
            <div class="col-md-3">    
                <div class="form-group">
                    <input name="tgl_akhir" type="text" class="datetimepicker form-control" placeholder="Tanggal Akhir">
                    <small class="help-block"></small>
                </div>
            </div>
            <div class="col-sm-3">
                <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a>
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