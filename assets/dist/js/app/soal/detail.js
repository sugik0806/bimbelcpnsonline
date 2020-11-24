$(document).ready(function () {
    ajaxcsrf();
   
    load_soal();
});

function next(obj) {
    console.info(obj + 1);
    var no = obj + 1;
     window.location.href = base_url+'soal/detail/'+ no;
}

function back(obj) {
    var no = obj - 1;
     window.location.href = base_url+'soal/detail/'+ no;
}

function go(obj) {
    var no = obj;
     window.location.href = base_url+'soal/detail/'+ no;
}

function load_soal() {
    $.getJSON(base_url+'soal/getCountSoalAll/', function (data) {
     var html = '';
     var klas = 'btn-default';
     var gambar = '';
     var total = Number(data.length);
     var max = [];
     var disableawal = false;
     var disableakhir = false;
     $("#totalsoal").html(data.length);

        for (var i = 0; i < data.length; i++) {
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            //var url = base_url+'/soal/detail/';
            var res = hashes[0].substring(49, 100); // akan berbeda hasil jika di live
            //console.info(data[i].file);

            if (data[i].file != "") {
                gambar = '*';
            }else{
                gambar = "";
            }
            

            if (res == data[i].id_soal) {
                klas = 'btn-success';
            } else {
                klas = 'btn-default';
            }

           // max += data[i].id_soal + ',';
             max.push(data[i].id_soal);
           

            // push.data[i].id_soal()

            

            html += '<a class="btn '+klas+' " style="width:50px; height:30px;" onclick="return go('+data[i].id_soal+');">'+data[i].id_soal+' <i class=""></i> '+gambar+'</a>';

           $("#navigasi").html(html);
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
