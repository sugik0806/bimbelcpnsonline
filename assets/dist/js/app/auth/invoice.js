
$(document).ready(function () {

    

    ajaxcsrf();

    $('form#formkonfirmasi input, form#formkonfirmasi select').on('change', function () {
        $(this).closest('.form-group').removeClass('has-error has-success');
        $(this).nextAll('.help-block').eq(0).text('');
    });

    // $('[name="gender"]').on('change', function () {
    //     $(this).parent().nextAll('.help-block').eq(0).text('');
    // });

    $('form#formkonfirmasi').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Wait...');



        $.ajax({
            url: $(this).attr('action'),
            //data: $(this).serialize(),
            type: 'POST',
            data:new FormData(this), //this is formData
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function (data) {
                
                btn.removeAttr('disabled').text('Simpan');
                if (data.status == true) {
                    Swal({
                        "title": "Sukses",
                        "text": data.msg,
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            //window.location.href = base_url+'login';
                            window.location.href = base_url+'invoice/konfirmasi/'+ data.token;
                        }
                    });
                } else {
                    if (data.status == false) {
                        Swal({
                            "title": "Gagal",
                            "text": data.msg,
                            "type": "warning"
                        }).then((result) => {
                            if (result.value) {
                               
                            }
                        });
                    }
                    // $.each(data.msg, function (key, value) {
                    //     $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value);
                    //     $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    //     if (value == '') {
                    //         $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                    //         $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                    //     }
                    // });
                }
            }
        });
    });
});
