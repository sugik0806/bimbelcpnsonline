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
            <div class="col-sm-6">
                <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>
            </div>
            <div class="col-sm-6">
                <a type="button" target="_blank" href="<?=base_url()?>laporan/cetak_fee" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-print"></i> print</a>
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