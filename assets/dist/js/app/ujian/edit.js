$(document).ready(function () {
    $('#tgl_mulai').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        date: tgl_mulai
    })//.on('dp.change', function(e){ 
        // var formatedValue = e.date.format(e.date._f);
        // console.log(formatedValue);

        // var waktu = document.getElementById("waktu");
        //  var tgl_mulai = document.getElementById("tgl_mulai");
        //  var tgl_selesai = document.getElementById("tgl_selesai");


        //  var someDate = new Date();
        //  console.info(someDate);
        //  //2020-08-24 08:38:34
        //  //Tue Aug 25 2020 16:49:46 GMT+0700 (Waktu Indonesia Barat)
        //   var numberOfDaysToAdd = 6;
        //   someDate.setDate(someDate.getDate() + numberOfDaysToAdd); 

          

        //  var dd = tgl_mulai.getDate();
        //  var mm = someDate.getMonth();
        //  var y = someDate.getFullYear();
        //  var h = someDate.getHours() + 1;
        //  var m = someDate.getMinutes()+ 30;
        //  var s = someDate.getSeconds();

        //   var someFormattedDate = y + '-'+ mm + '-'+ dd + ' ' + h + ':'+ m + ':' + s;
        //   console.info(someFormattedDate);
        //   console.info(tgl_selesai.value);

    //})
    ;
    $('#tgl_selesai').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        date: terlambat
    });

  

    $("#waktu").on("change",function (){ 


        
        //Mon Aug 31 2020 16:48:44 GMT+0700 (Waktu Indonesia Barat)

        // var actualDate = new Date(tgl_mulai);
        // var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate());
        // console.info(newDate);


     });



//    $('#tgl_mulai').on('dp.change', function(e){ 
//     var formatedValue = e.date.format(e.date._f);
//     console.log(formatedValue);
// })


    


    $('#formujian input, #formujian select').on('change', function () {
        $(this).closest('.form-group').eq(0).removeClass('has-error');
        $(this).nextAll('.help-block').eq(0).text('');
    });

    $('#formujian').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function (data) {
                console.log(data);
                if (data.status) {
                    Swal({
                        "title": "Berhasil",
                        "type": "success",
                        "text": "Data berhasil disimpan"
                    }).then(result => {
                        window.location.href = base_url+"ujian/master";
                    });
                } else {
                    if (data.errors) {
                        $.each(data.errors, function (key, val) {
                            $('[name="' + key + '"]').closest('.form-group').eq(0).addClass('has-error');
                            $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(val);
                            if (val === '') {
                                $('[name="' + key + '"]').closest('.form-group').eq(0).removeClass('has-error');
                                $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                            }
                        });
                    }
                }
            }
        });
    });
});