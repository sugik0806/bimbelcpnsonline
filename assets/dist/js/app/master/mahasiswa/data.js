var table;

  $(document).ready(function(){
    $('#filter_by').on('change', function(){
      let id = $(this).val();
      let src = base_url + "mahasiswa/data";
      let url;

      if(id !== 'all'){
        let src2 = src + '/' + id;
        url = $(this).prop('checked') === true ? src : src2;
      }else{
        url = src;
      }
      table.ajax.url(url).load();
    });
  });

$(document).ready(function() {
  ajaxcsrf();

  table = $("#mahasiswa").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#mahasiswa_filter input")
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
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "mahasiswa/data",
      type: "POST"
      //data: csrf
    },
    columns: [
      {
        data: "id_mahasiswa",
        orderable: false,
        searchable: false
      },
      { data: "whatsapp" },
      { data: "nama" },
      { data: "email" },
      { data: "token" },
      { data: "nama_jurusan" }
    ],
    columnDefs: [
      {
        searchable: false,
        targets: 6,
        data: {
          id_mahasiswa: "id_mahasiswa",
          ada: "ada"
        },
        render: function(data, type, row, meta) {
          let btn;
          if (data.ada > 0) {
            btn = `<button data-id="${data.id_mahasiswa}" type="button" class="btn btn-xs btn-success btn-aktif">
                <i class="fa fa-check"></i>
              </button>`;
          } else {
            btn = `<button data-id="${data.id_mahasiswa}" type="button" class="btn btn-xs btn-primary btn-aktif">
								<i class="fa fa-user-plus"></i>
							</button>`;
          }
          return `<div class="text-center">
									<a class="btn btn-xs btn-warning" href="${base_url}mahasiswa/edit/${data.id_mahasiswa}">
										<i class="fa fa-pencil"></i>
									</a>
									${btn}
								</div>`;
        }
      },
      {
        targets: 7,
        data: "id_mahasiswa",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
        }
      },
      {
        targets: 1,
        data: "whatsapp",
        render: function(data, type, row, meta) {


         //if(!preg_match('/[^+0-9]/',trim($data))){
             // cek apakah no hp karakter 1-3 adalah +62
             if(data.substring(0, 2)=='62'){
                 var hp = data;
             }
             else if(data.substring(0, 3)=='+62'){
                 var hp = data;
             }
             // cek apakah no hp karakter 1 adalah 0
             else if(data.substring(0, 1)=='0'){
                 var temp = data.replace(data.substring(0, 1), "");
                 var hp = '62'+temp;

             }

          return `<div class="text-center">
                  <a target="_blank" class="btn btn-xs btn-success" href="http://wa.me/${hp}">
                    Kirim <i class="fa fa-whatsapp"></i>
                  </a>
                  <p>${hp}</p>
                  </div>`;
        }
      },
      {
        targets: 4,
        data: "token",
        render: function(data, type, row, meta) {

          return `<div class="text-center">
                  <a target="_blank" class="btn btn-xs btn-info" href="${base_url}invoice/konfirmasi/${data}">
                    Lihat Bukti <i class="fa fa-book"></i>
                  </a>
                  <p>${data}</p>
                  </div>`;
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

  table
    .buttons()
    .container()
    .appendTo("#mahasiswa_wrapper .col-md-6:eq(0)");

  $(".select_all").on("click", function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true;
        $(".select_all").prop("checked", true);
      });
    } else {
      $(".check").each(function() {
        this.checked = false;
        $(".select_all").prop("checked", false);
      });
    }
  });

  $("#mahasiswa tbody").on("click", "tr .check", function() {
    var check = $("#mahasiswa tbody tr .check").length;
    var checked = $("#mahasiswa tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
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
  });

  $("#mahasiswa").on("click", ".btn-aktif", function() {
    let id = $(this).data("id");

    $.ajax({
      url: base_url + "mahasiswa/create_user",
      data: "id=" + id,
      type: "GET",
      success: function(response) {
        if (response.status == true) {
          var title = response.status ? "Berhasil" : "Gagal";
          var type = response.status ? "success" : "error";
          Swal({
            title: title,
            text: response.msg,
            type: type
          });
        }
        if (response.status == false) {
          $.ajax({
                url: base_url + "mahasiswa/reset_password_ins",
                data: "id=" + id,
                type: "GET",
                success: function(response) {
                  if (response.msg) {
                    var title = response.status ? "Berhasil" : "Gagal";
                    var type = response.status ? "success" : "error";
                    Swal({
                      title: title,
                      text: response.msg,
                      type: type
                    });
                  }
                  reload_ajax();
                }
              });
        }
        reload_ajax();
      }
    });
  });
});

function bulk_delete() {
  if ($("#mahasiswa tbody tr .check:checked").length == 0) {
    Swal({
      title: "Gagal",
      text: "Tidak ada data yang dipilih",
      type: "error"
    });
  } else {
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
