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
        	<div class="col-sm-2">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red"><i class="fa fa-trash"></i> Bulk Delete</button>
			</div>

			<div class="col-md-1">
				<label class="pull-left" style="margin-top: 5px" for="filter_by">Filter By:</label>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					
					<select id="filter_by" name="filter_by" class="form-control select2 pull-right">
						<option value="">-- Pilih --</option>
						<option value="1">Mata Bimbingan</option>
						<option value="2">Jenis Soal</option>
						<option value="3">Nama Ujian</option>
					</select>
					<small class="help-block"></small>
				</div>
			</div>
			<div id="box_matkul" class="form-group col-sm-3 text-center">
				<?php ?>
					<select id="matkul_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Matbim</option>
						<?php foreach ($matkul as $m) :?>
							<option value="<?=$m->id_matkul?>"><?=$m->nama_matkul?></option>
						<?php endforeach; ?>
					</select>
				<?php ?>
				<?php if ( $this->ion_auth->in_group('dosen') ) : ?>				
					<!-- <input id="matkul_id" value="<?=$matkul->nama_matkul;?>" type="text" readonly="readonly" class="form-control"> -->
				<?php endif; ?>
			</div>
	

			<div id="box_tipe" class="form-group col-sm-3 text-center">
				
					<select id="tipe_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Jenis Soal</option>
						<?php foreach ($jenis as $m) :?>
							<option value="<?=$m->tipe?>"><?=$m->tipe?></option>
						<?php endforeach; ?>
					</select>
							
					<!-- <input id="id" value="<?=$jenis[1]->tipe;?>" type="text" readonly="readonly" class="form-control"> -->
				
			</div>

			<div id="box_ujian" class="form-group col-sm-4 text-center">
				<div class="col-md-6">
					<select id="ujian_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Ujian</option>
						<?php foreach ($ujian as $m) :?>
							<option value="<?=$m->id_ujian?>"><?=$m->nama_ujian?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-6">
					<!-- <input id="id" value="<?=$jenis[1]->tipe;?>" type="text" readonly="readonly" class="form-control"> -->

					
					<select id="tipeNujian_filter" class="form-control select2 col-md-1" style="width:100% !important">
						<option value="all">Semua Jenis Soal</option>
						<?php foreach ($jenis as $m) :?>
							<option value="<?=$m->tipe?>"><?=$m->tipe?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>


			<div class="col-sm-3 pull-right">
				<div class="pull-right">
					<a href="<?=base_url('soal/add')?>" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-plus"></i> Buat Soal</a>
					<a href="<?= base_url('soal/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
					<button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-maroon"><i class="fa fa-refresh"></i> Reload</button>
				</div>
			</div>
		</div>
    </div>
	<?=form_open('soal/delete', array('id'=>'bulk'))?>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="soal" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				<th width="25" class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th width="25">Pembimbing</th> -->
                <th width="25">Tipe</th>
                <th width="25">Mat Bim</th>
				<th>Soal</th>
				<!-- <th width="25">Tanggal</th> -->
				<th width="25" class="text-center">Aksi</th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
				<th width="25" class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th width="25">Pembimbing</th> -->
                <th width="25">tipe</th>
                <th width="25">Mat Bim</th>
				<th>Soal</th>
				<!-- <th width="25">Tanggal</th> -->
				<th width="25" class="text-center">Aksi</th>
            </tr>
        </tfoot>
        </table>
    </div>
	<?=form_close();?>
</div>

<script src="<?=base_url()?>assets/dist/js/app/soal/data.js"></script>

<?php if ( $this->ion_auth->is_admin() ) : ?>
<!-- <script type="text/javascript">
$(document).ready(function(){
	$('#matkul_filter').on('change', function(){
		let id_matkul = $(this).val();
		let src = '<?=base_url()?>soal/data';
		let url;

		if(id_matkul !== 'all'){
			let src2 = src + '/' + id_matkul;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script> -->
<!-- <script type="text/javascript">
$(document).ready(function(){
	$('#tipe_filter').on('change', function(){
		let id = $(this).val();
		let src = '<?=base_url()?>soal/data';
		let url;

		if(id !== 'all'){
			let src2 = src + '/' + id;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script> -->
<?php endif; ?>
<?php if ( $this->ion_auth->in_group('dosen') ) : ?>

	<script type="text/javascript">
		// alert("dosen");
	</script>

<script type="text/javascript">
$(document).ready(function(){
	alert("dok ready");
	let id_matkul = '<?=$matkul->matkul_id?>';
	let id_dosen = '<?=$matkul->id_dosen?>';
	let src = '<?=base_url()?>soal/data';
	let url = src + '/' + id_matkul + '/' + id_dosen;

	table.ajax.url(url).load();
});
</script>
<?php endif; ?>