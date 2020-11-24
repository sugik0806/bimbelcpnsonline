$(document).ready(function () {
    ajaxcsrf();
    kotrol_element();

// tinymce.init({ selector:'textarea', menubar:'', theme: 'modern'});
    
});

function load_jenis(id) {
    $('#id').find('option').not(':first').remove();

    $.getJSON(base_url+'soal/load_jenis/' + id, function (data) {
        var option = [];
        for (let i = 0; i < data.length; i++) {
            option.push({
                id: data[i].id,
                text: data[i].tipe
            });
        }
        $('#id').select2({
            data: option
        })
    });
}

function load_ujian(id) {
    $('#id_ujian').find('option').not(':first').remove();

    $.getJSON(base_url+'soal/load_ujian/' + id, function (data) {
        var option = [];
        for (let i = 0; i < data.length; i++) {
            option.push({
                id: data[i].id_ujian,
                text: data[i].nama_ujian
            });
        }
        $('#id_ujian').select2({
            data: option
        });
    });
}

function load_soal(id) {
    $.getJSON(base_url+'soal/getSoalByMatkulId/' + matkul_id.value +'/'+ id_ujian.value, function (data) {
     $("#totalsoal").html(Number(data.total_twk) + Number(data.total_tiu) + Number(data.total_tkp));
     $("#totaltwk").html(data.total_twk);
     $("#totaltiu").html(data.total_tiu);
     $("#totaltkp").html(data.total_tkp);

    });

    $("#file_soal").val("");
    $("#soal").val("");
    $("#file_a").val("");
    $("#file_b").val("");
    $("#file_c").val("");
    $("#file_d").val("");
    $("#file_e").val("");
    $("#jawaban_a").html("");
    $("#jawaban_b").html("");
    $("#jawaban_c").html("");
    $("#jawaban_d").html("");
    $("#jawaban_e").html("");
}

function kotrol_element() {
    var bobot_soal = document.getElementById("bobot_soal");
    var kunci = document.getElementById("kunci");
    var bobot_nilai = document.getElementById("bobot_nilai");
    if (matkul_id.value == 2 && id.value == 3){
      bobot_soal.style.display = "block";
      kunci.style.display = "none";
      bobot_nilai.style.display = "none";
    } else {
      bobot_soal.style.display = "none";
      kunci.style.display = "block";
      bobot_nilai.style.display = "block";
    }
}

    function cekduplikasi(soal){
        var trim = trimo(soal.value); 

        //console.info(soal.value);
        //var result = soal.value.replace(/<[^>]*>?/gm, '');

        //text = text.replace(/([?]*)$/g, '')
        

        $.ajax({
            url: base_url + 'soal/cekduplikasi/',
            type: 'POST',
            data: {
                nama: trim
            },
            cache: false,
            success: function (data) {

                console.info(data);
                var count = data.length;
                //$('#countduplikat').html(count);
                var html = '';
                var i;
                
                for(i=0; i<data.length; i++){

                    html += `<div class="alert with-border"><span class="badge bg-blue">`+data[i].id_soal+`</span> `+data[i].soal+`</div><hr>`;
                }


                $('#id_duplikasi').html(html);
                $('#totalduplikasi').html(count);
                
                
            }
        });

        normalkan(soal);

    }

    function normalkan(soal){
        var trim = trimo(soal.value);
         //var element = document.getElementById("soal");
          // element.classList.remove("froala-editor");
            // $("textarea").removeClass("form-control");
            // $("#soal").removeClass("froala-editor");
            // $('#soal').val(trim);
            $('#soaltrim').val(trim);
    }

    function trimo(s){
        string = s;
        string = string.replace(/<\/?[^>]+(>|$)/g, "");
        //string = string.replace(/^s+|s+$/g,"");
        
        string = string.replace(/\&ldquo;/g, '"');
        string = string.replace(/\&quot;/g, '"');
        string = string.replace(/\&nbsp;/g, '');
        while(string.indexOf("  ")>0){
            string = string.split("  ").join(" ");
        }
        return string;
    }


$('#id').on('change', function(){
    // let id = $(this).val();
    kotrol_element();
});

    // Load Kelas By Jurusan
$('#matkul_id').on('change', function () {
    load_jenis($(this).val());
    load_ujian($(this).val());
    kotrol_element();
    $("#id_ujian").val("");
});

$('#id_ujian').on('change', function () {
         load_soal($(this).val());
});

   

$('form#formsoal').on('submit', function (e) {
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
            if (data.status) {
                Swal({
                    "title": "Sukses",
                    "text": "Data Berhasil disimpan",
                    "type": "success"
                }).then((result) => {
                    if (result.value) {
                        load_soal();
                        //window.location.href = base_url+'soal/data';
                       
                    }
                });
            } else {
                console.log(data.errors);
                $.each(errors, function (key, value) {
                    $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value);
                    $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                    if (value == '') {
                        $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                        $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                    }
                });
            }
        }
    });
});

