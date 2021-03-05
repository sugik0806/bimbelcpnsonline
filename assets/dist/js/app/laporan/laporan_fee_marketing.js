var table;

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
