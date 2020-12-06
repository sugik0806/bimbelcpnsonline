<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Master <?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-4">
            
            <?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('dosen')) : ?>
 

                <a href="<?= base_url('dokumen/add') ?>" class="btn btn-sm bg-purple btn-flat"><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="<?= base_url('dokumen/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-sm bg-purple btn-flat"><i class="fa fa-refresh"></i> Reload</button>
                <div class="pull-right">
                    <button onclick="bulk_delete()" class="btn btn-sm btn-danger btn-flat" type="button"><i class="fa fa-trash"></i> Delete</button>
                </div>
            <?php else : ?>    
                <button type="button" onclick="reload_ajax()" class="btn btn-sm bg-purple btn-flat"><i class="fa fa-refresh"></i> Reload</button>
            <?php endif; ?>

        </div>
        <?= form_open('dokumen/delete', array('id' => 'bulk')) ?>
        <table id="dokumen" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                   <!--  <th>Mata Bimbingan</th> -->
                    <th>Jenis</th>
                    <th>Nama Dokumen</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">
                        <input type="checkbox" class="select_all">
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <!-- <th>Mata Bimbingan</th> -->
                    <th>Jenis</th>
                    <th>Nama Dokumen</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">
                        <input type="checkbox" class="select_all">
                    </th>
                </tr>
            </tfoot>
        </table>
        <a href="<?=base_url('dashboard')?>" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        <?= form_close() ?>
    </div>
</div>

<script src="<?= base_url() ?>assets/dist/js/app/master/dokumen/data.js"></script>