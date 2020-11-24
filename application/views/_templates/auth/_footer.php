<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
        });
    });

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