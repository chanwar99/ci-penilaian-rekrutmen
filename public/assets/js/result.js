"use strict";
// halaman kelola soal
$("#tableResult").DataTable({
  ordering: false,
  lengthChange: false,
  processing: true,
  serverSide: true,
  searching: false,
  // scrollX: true,
  ajax: {
    url: site_url + "hasil/panggil",
    type: "POST",
    data: function (d) {
      d.filter_test = $("#filterTest").val();
    },
  },
  language: {
    emptyTable: "Belum ada Data Hasil.",
    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
    zeroRecords: "Data tidak ditemukan",
    infoFiltered: "(tersaring dari _MAX_ total data)",
    paginate: {
      previous: "<i class='fas fa-chevron-left'></i>",
      next: "<i class='fas fa-chevron-right'></i>",
    },
  },
});
$("#filterTest").select2();
$("#filterTest").on("change", function () {
  $("#tableResult").DataTable().ajax.reload();
});
