var table;

  $(document).ready(function(){
    $("#tgl_awal").change(function(){
      reload_ajax();
    }); 
    $("#tgl_akhir").change(function(){
      reload_ajax();
    }); 

    $("#rekening").change(function(){
      reload_ajax();
    });
  });

$(document).ready(function() {
  ajaxcsrf();

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });

   $("#tgl_awal").val( moment().format('YYYY-MM-01') );
   $("#tgl_akhir").val( moment().format('YYYY-MM-DD') );

  table = $("#pengeluaran").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#pengeluaran_filter input")
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
        exportOptions: { columns: [1] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1] }
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
        },  
      url: base_url + "pengeluaran/data",
      type: "POST"
      //data: csrf
    },
    columns: [
      {
        data: "id_pengeluaran",
        orderable: false,
        searchable: false
      },
      {
        data: "tanggal_pengeluaran"
      },
      {
        data: "nama_pengeluaran"
      },
      {
        data: "nominal"
      },
      {
        data: "bulk_select",
        orderable: false,
        searchable: false
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

  table
    .buttons()
    .container()
    .appendTo("#pengeluaran_wrapper .col-md-6:eq(0)");

  $("#myModal").on("shown.modal.bs", function() {
    $(':input[name="banyak"]').select();
  });

  $("#select_all").on("click", function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true;
      });
    } else {
      $(".check").each(function() {
        this.checked = false;
      });
    }
  });

  $("#pengeluaran tbody").on("click", "tr .check", function() {
    var check = $("#pengeluaran tbody tr .check").length;
    var checked = $("#pengeluaran tbody tr .check:checked").length;
    if (check === checked) {
      $("#select_all").prop("checked", true);
    } else {
      $("#select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
    if ($(this).attr("action") == base_url + "pengeluaran/delete") {
      e.preventDefault();
      e.stopImmediatePropagation();

      $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        type: "POST",
        success: function(respon) {
          if (respon.status) {
            Swal({
              title: "Berhasil",
              text: respon.total + " data berhasil dihapus",
              type: "success"
            });
          } else {
            Swal({
              title: "Gagal",
              text: "Tidak ada data yang dipilih",
              type: "error"
            });
          }
          reload_ajax();
        },
        error: function() {
          Swal({
            title: "Gagal",
            text: "Ada data yang sedang digunakan",
            type: "error"
          });
        }
      });
    }
  });
});

function bulk_delete() {
  if ($("#pengeluaran tbody tr .check:checked").length == 0) {
    Swal({
      title: "Gagal",
      text: "Tidak ada data yang dipilih",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "pengeluaran/delete");
    Swal({
      title: "Anda yakin?",
      text: "Data akan dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Hapus!"
    }).then(result => {
      if (result.value) {
        $("#bulk").submit();
      }
    });
  }
}

function bulk_edit() {
  if ($("#pengeluaran tbody tr .check:checked").length == 0) {
    Swal({
      title: "Gagal",
      text: "Tidak ada data yang dipilih",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "pengeluaran/edit");
    $("#bulk").submit();
  }
}
