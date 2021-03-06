var table;

$(document).ready(function(){
  $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD'
  });

   $("#tgl_awal").val( moment().format('YYYY-MM-01') );
   $("#tgl_akhir").val( moment().format('YYYY-MM-DD') );

  $("#tgl_awal").change(function(){
    reload_ajax();
  }); 
  $("#tgl_akhir").change(function(){
    reload_ajax();
  }); 

  $("#penerima_fee").change(function(){
    reload_ajax();
  });
});

$(document).ready(function() {
  ajaxcsrf();

  table = $("#pendapatan").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#pendapatan_filter input")
        .off(".DT")
        .on("keyup.DT", function(e) {
          api.search(this.value).draw();
        });
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "copy",
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
      },
      {
        extend: "print",
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      "data": function ( data ) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
                data.penerima_fee = $('#penerima_fee').val();
      },  
      url: base_url + "laporan/fee",
      type: "POST"
    },
    columns: [
      {
        data: "id_mahasiswa",
        orderable: false,
        searchable: false
      },
      { data: "nama" },
      { data: "nama_kelas" },
      { data: "net" },
      { data: "angka_unik" },
      { data: "diskon" },
      { data: "fee" },
      { data: "penerima_fee" },
      {
        orderable: false,
        searchable: false
      }
    ],
    columnDefs: [
      {
        targets: 8,
        data: "id_mahasiswa",
        render: function(data, type, row, meta) {
          return `
                    <div class="text-center">
                        <a target="_blank" class="btn btn-xs bg-maroon" href="${base_url}laporan/cetak_detail/${data}" >
                            <i class="fa fa-search"></i> Lihat Detail
                        </a>
                    </div>
                    `;
        }
      }
    ],
    order: [[1, "asc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(0)", row).html(index);
    }
  });
});

table
  .buttons()
  .container()
  .appendTo("#pendapatan_wrapper .col-md-6:eq(0)");


  function cetak() {
    var e = document.getElementById("penerima_fee");
    var penerima_fee = e.value;

    $.ajax({
        url: base_url + 'laporan/encrypt',
        type: 'POST',
        data: {
            tgl_awal: $('#tgl_awal').val(),
            tgl_akhir : $('#tgl_akhir').val(),
            penerima_fee : penerima_fee
        },
        cache: false,
        success: function (data) {

          console.info(data.penerima_fee);
          let tgl_awal = $('#tgl_awal').val();
          let tgl_akhir = $('#tgl_akhir').val();
          let src = base_url + "laporan/cetak_fee";
          let url;

          // if(tgl_awal && tgl_akhir){
          //   window.open(src + '/' + tgl_awal + '/' + tgl_akhir);
          // }


          if(tgl_awal && tgl_akhir){
            window.open(src + '/' + tgl_awal + '/' + tgl_akhir + '/' + data.penerima_fee);
          }else{
            document.getElementById("pesan").innerHTML = "Isi Tanggal !";
          }
            
            
        }
    });
  }


  function loadModal() {
    var e = document.getElementById("penerima_fee");
    var penerima_fee = e.value;

    $.ajax({
        url: base_url + 'laporan/fee',
        type: 'POST',
        data: {
            tgl_awal: $('#tgl_awal').val(),
            tgl_akhir : $('#tgl_akhir').val(),
            penerima_fee : penerima_fee
        },
        cache: false,
        success: function (data) {


          var datalength = 5;
          var count = data.length;
          
          var html="";
          html += '<table class="table table-bordered" >';
          for(var count=0; count < datalength; count++){
              html += '<tr>';
              html += '<td>'+data.id_mahasiswa+'</td>'; 
              html += '<td>'+data.fee+'</td>';  
              html += '<td>'+data.penerima_fee+'</td>';  
              html += '</tr>';
          }
          html += '</table>';    


          // var html="";
          // html += '<table class="w-100 table table-striped table-bordered table-hover" >';
          // for (var i = 0; i < data.length; i++) {
          //     html += '<tr>';
          //     html += '<td>'+data[i].id_mahasiswa+'</td>'; 
          //     html += '<td>'+data[i].fee+'</td>';  
          //     html += '<td>'+data[i].penerima_fee+'</td>';  
          //     html += '</tr>';
          // }
          // html += '</table>';     
          $('#test').html(html);
        }
    });
  }
