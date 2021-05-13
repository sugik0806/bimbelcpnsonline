var table;

$(document).ready(function() {
  ajaxcsrf();
  kotrol_element();
  table = $("#soal").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#soal_filter input")
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
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "print",
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [2, 3, 4, 5] }
      }
    ],
    oLanguage: {
      sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "soal/data",
      type: "POST"
    },
    columns: [
      {
        data: "id_soal",
        orderable: false,
        searchable: false
      },
      {
        data: "id_soal",
        orderable: false,
        searchable: false
      },
      // { data: "nama_dosen" },
      { data: "tipe" },
      { data: "nama_matkul" },
      { data: "soal" },
      { data: "nama_aspek" },
      // { data: "created_on" }
    ],
    columnDefs: [
      {
        targets: 0,
        data: "id_soal",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
        }
      },
      {
        targets: 6,
        data: "id_soal",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                                <a href="${base_url}soal/detail/${data}" class="btn btn-xs btn-default">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <a href="${base_url}soal/edit/${data}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>`;
        }
      }
    ],
    order: [[6, "desc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(1)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo("#soal_wrapper .col-md-6:eq(0)");

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

  // <script type="text/javascript">
  $(document).ready(function(){
    $('#tipe_filter').on('change', function(){
      let tipe = $(this).val();
      let src = base_url + "soal/data";
      let url;

      if(tipe !== 'all'){
        let src2 = src + '/' + tipe;
        url = $(this).prop('checked') === true ? src : src2;
      }else{
        url = src;
      }
      table.ajax.url(url).load();

    });
  });

  $(document).ready(function(){
    $('#matkul_filter').on('change', function(){
      let id = $(this).val();
      let src = base_url + "soal/data";
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

  $(document).ready(function(){
    $('#ujian_filter').on('change', function(){
      let id = $(this).val();
      let src = base_url + "soal/databyujian";
      let url;

      if(id !== 'all'){
        let src2 = src + '/' + id + '/' + 'all';
        url = $(this).prop('checked') === true ? src : src2;
      }else{
        url = src = src + '/' + 'all' + '/' + 'all';
      }
      table.ajax.url(url).load();
      $("#tipeNujian_filter").val("");
      //$("#tipeNujian_filter option.value").remove();
    });
  });

  $('#tipeNujian_filter').on('change', function(){
      let id = $(this).val();
      let src = base_url + "soal/databyujian";
      let url;

      if(id !== 'all'){
        let src2 = src + '/' + ujian_filter.value + '/' + id;
        url = $(this).prop('checked') === true ? src : src2;
      }else{
        url = src = src + '/' + ujian_filter.value + '/' + 'all';
      }
      table.ajax.url(url).load();
    });


  
  // </script>

  $('#filter_by').on('change', function(){
      // let id = $(this).val();
      kotrol_element();
  });

  function kotrol_element() {
      var box_matkul = document.getElementById("box_matkul");
      var box_tipe = document.getElementById("box_tipe");
      var box_ujian = document.getElementById("box_ujian");

      if (filter_by.value == 1){
        box_matkul.style.display = "block";
        box_tipe.style.display = "none";
        box_ujian.style.display = "none";
      } else if (filter_by.value == 2) {
        box_matkul.style.display = "none";
        box_tipe.style.display = "block";
        box_ujian.style.display = "none";
      }else if (filter_by.value == 3) {
        box_matkul.style.display = "none";
        box_tipe.style.display = "none";
        box_ujian.style.display = "block";
      }else{
        box_matkul.style.display = "none";
        box_tipe.style.display = "none";
        box_ujian.style.display = "none";
      }
  }

  $("#soal tbody").on("click", "tr .check", function() {
    var check = $("#soal tbody tr .check").length;
    var checked = $("#soal tbody tr .check:checked").length;
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
});

function bulk_delete() {
  if ($("#soal tbody tr .check:checked").length == 0) {
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
