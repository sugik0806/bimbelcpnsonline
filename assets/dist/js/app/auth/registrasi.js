function load_jurusan() {
    console.log("jurusan");
    $('#jurusan').find('option').not(':first').remove();

    $.getJSON(base_url+'jurusan/load_jurusan', function (data) {
        var option = [];
        for (let i = 0; i < data.length; i++) {
            option.push({
                id: data[i].id_jurusan,
                text: data[i].nama_jurusan
            });
        }
        $('#jurusan').select2({
            data: option
        })

        console.log(data);
    });


}

function load_kelas(id) {
    $('#kelas').find('option').not(':first').remove();

    $.getJSON(base_url+'kelas/kelas_by_jurusan/' + id, function (data) {
        var option = [];
        for (let i = 0; i < data.length; i++) {
            option.push({
                id: data[i].id_kelas,
                text: data[i].nama_kelas
            });
        }
        $('#kelas').select2({
            data: option
        });
    });
}

$(document).ready(function () {

    

    ajaxcsrf();

    // $('#logout').on('click', function(e){
    //     e.preventDefault();

    //     Swal({
    //         title: "Logout",
    //         text: "Anda yakin ingin logout?",
    //         type: "question",
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Logout!'
    //     }).then((result) => {
    //         if(result.value){
    //             location.href=base_url+"login";
    //         }
    //     });
    // });

    // Load Jurusan
    //load_jurusan();

    // Load Kelas By Jurusan
    // $('#gender').on('change', function () {
    //     load_jurusan($(this).val());
    // });

    $('form#registrasi input, form#registrasi select').on('change', function () {
        $(this).closest('.form-group').removeClass('has-error has-success');
        $(this).nextAll('.help-block').eq(0).text('');
    });

    $('[name="gender"]').on('change', function () {
        $(this).parent().nextAll('.help-block').eq(0).text('');
    });

    $('form#registrasi').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Wait...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function (data) {
                
                btn.removeAttr('disabled').text('Simpan');
                if (data.status == true) {
                    Swal({
                        "title": "Sukses",
                        "text": data.msg,
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'login';
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
