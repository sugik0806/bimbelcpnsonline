			</section>
			<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<!-- To the right -->
				<!-- <div class="pull-right hidden-xs">
					Redivice by <a target="_blank" href=""><b>Bimbel CPNS Online</b></a> | Computer Based Test v3
				</div> -->
				<!-- Default to the left -->
				<strong>Copyright &copy; 2020 <a href="https://bimbelcpnsonline.id" target="blank"><b>Bimbel CPNS Online</b></a> </strong> All rights reserved

				<a target="_blank" href="<?= base_url() ?>uploads/panduan-peserta.pdf" class="btn btn-xs btn-primary pull-right">
                  <i class="fa fa-download"></i> Unduh Panduaan Peserta
                </a>
			</footer>

			</div>

			<!-- Required JS -->
			<script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/jquery.dataTables.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

			<!-- Datatables Buttons -->
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/JSZip-2.5.0/jszip.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/pdfmake-0.1.36/pdfmake.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/pdfmake-0.1.36/vfs_fonts.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.html5.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.print.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/plugins/Buttons-1.5.6/js/buttons.colVis.min.js"></script>

			<script src="<?= base_url() ?>assets/bower_components/pace/pace.min.js"></script>
			<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

			<!-- Textarea editor -->
			<script src="<?= base_url() ?>assets/bower_components/codemirror/lib/codemirror.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/codemirror/mode/xml.min.js"></script>
			<script src="<?= base_url() ?>assets/bower_components/froala_editor/js/froala_editor.pkgd.min.js"></script>
			<!-- TinyMCE TextEditor -->
			<!-- <script src="<?= base_url() ?>assets/bower_components/tinymce/js/tinymce/tinymce.min.js"></script> -->
			<!-- <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->

  			<!-- <script src="<?=base_url()?>assets/plugins/summernote-0.8.18-dist/summernote.min.js"></script> -->

  			<!-- <script src="https://cdn.tiny.cloud/1/vukw2jnqljxly7zpan5yipei7xps7etce89uvsfit2liyrvy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

			<!-- App JS -->
			<script src="<?= base_url() ?>assets/dist/js/app/dashboard.js"></script>

			<!-- Custom JS -->
			<script type="text/javascript">
				$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
					return {
						"iStart": oSettings._iDisplayStart,
						"iEnd": oSettings.fnDisplayEnd(),
						"iLength": oSettings._iDisplayLength,
						"iTotal": oSettings.fnRecordsTotal(),
						"iFilteredTotal": oSettings.fnRecordsDisplay(),
						"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
						"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
					};
				};

				function ajaxcsrf() {
					var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
					var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
					var csrf = {};
					csrf[csrfname] = csrfhash;
					$.ajaxSetup({
						"data": csrf
					});
				}

				function reload_ajax() {
					table.ajax.reload(null, false);
				}
			</script>

			
			</body>

			</html>