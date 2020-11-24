$(document).ready(function(){
    console.info(id.value);
    ajaxcsrf();
    kotrol_element();
    load_soal();    
    // tinymce.init({ selector:'textarea', menubar:'', theme: 'modern'});
     // $('#soal, #jawaban_a, #jawaban_b, #jawaban_c, #jawaban_d, #jawaban_e, #pembahasan').summernote({
     //    placeholder: 'Ketik Data ..',
     //    tabsize: 2,
     //    height: 100
     //  });
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

    function next(obj) {
        console.info(obj + 1);
        var no = obj + 1;

         window.location.href = base_url+'soal/edit/'+ no;
    }

    function back(obj) {
        var no = obj - 1;
         window.location.href = base_url+'soal/edit/'+ no;
    }

    function load_soal() {
        $.getJSON(base_url+'soal/getCountSoalAll/', function (data) {
         //var html = '';
         //var klas = 'btn-default';
         //var gambar = '';
         //var total = Number(data.length);
         var max = [];
         var disableawal = false;
         var disableakhir = false;
         //$("#totalsoal").html(data.length);

            for (var i = 0; i < data.length; i++) {
                //var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                var hashes = window.location.pathname;

                var res = hashes.replace("/soal/edit/", "");
                // console.info(res);
                // console.info(hashes); 
                // console.info(window.location); 

                // if (data[i].file != "") {
                //     gambar = '*';
                // }else{
                //     gambar = "";
                // }
                

                if (res == data[i].id_soal) {
                    klas = 'btn-success';
                } else {
                    klas = 'btn-default';
                }

               // max += data[i].id_soal + ',';
                 max.push(data[i].id_soal);
               

                // push.data[i].id_soal()

                

               //  html += '<a class="btn '+klas+' " style="width:50px; height:30px;" onclick="return go('+data[i].id_soal+');">'+data[i].id_soal+' <i class=""></i> '+gambar+'</a>';

               // $("#navigasi").html(html);
            }
            
            var maximal = Math.max.apply(Math, max);
            var minimal = Math.min.apply(Math, max);
             
             if (minimal == Number(res)) {
                 //sudah awal
                 disableawal = true;
                 console.info('sudah awal');
                 document.getElementById("sebelumnya").style.visibility = "hidden";
             }else if (maximal == Number(res)) {
                 //sudah akhir
                 disableakhir = true;
                  console.info('sudah akhir');
                  document.getElementById("selanjutnya").style.visibility = "hidden";
             }else{
                 disableawal = false;
                 disableakhir = false;
             }

        });


    }

 $('#id').on('change', function(){
     let id = $(this).val();
     kotrol_element();
 });

         // Load Kelas By Jurusan
 $('#matkul_id').on('change', function () {
     load_jenis($(this).val());
     load_ujian($(this).val());
     kotrol_element();
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
            //if (data.status) {
                Swal({
                    "title": "Sukses",
                    "text": "Data Berhasil disimpan",
                    "type": "success"
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = base_url+'soal';
                    }
                });
            //} else {
            //     console.log(data.errors);
            //     $.each(errors, function (key, value) {
            //         $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value);
            //         $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
            //         if (value == '') {
            //             $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
            //             $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
            //         }
            //     });
            // }
        }
    });
}); 

