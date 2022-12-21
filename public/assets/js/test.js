"use strict";
// halaman kelola tes
$("#tableTest").DataTable({
  ordering: false,
  lengthChange: false,
  processing: true,
  serverSide: true,
  searching: false,
  // scrollX: true,
  ajax: {
    url: site_url + "kelola-tes/panggil",
    type: "POST",
    data: function (d) {
      d.filter_test_title = $("#filterTestTitle").val();
    },
  },
  language: {
    processing: "hallo",
    emptyTable: "Belum ada Data Tes.",
    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
    zeroRecords: "Data tidak ditemukan",
    infoFiltered: "(tersaring dari _MAX_ total data)",
    paginate: {
      previous: "<i class='fas fa-chevron-left'></i>",
      next: "<i class='fas fa-chevron-right'></i>",
    },
  },
  columnDefs: [{ width: "20%", targets: [2] }],
});
$("#filterTestTitle").on("keyup", function () {
  $("#tableTest").DataTable().ajax.reload();
});

// tampil modal
$("#testModal").on("show.bs.modal", function (e) {
  var modalType = $(e.relatedTarget).data("modal-type");
  if (modalType == "details") {
    $("#testModal").find(".modal-dialog").addClass("modal-lg");
  } else {
    $("#testModal").find(".modal-dialog").removeClass("modal-lg");
  }
});
$("#testModal").on("shown.bs.modal", function (e) {
  var modalType = $(e.relatedTarget).data("modal-type");
  var id =
    modalType == "edit" || modalType == "delete" || modalType == "details"
      ? $(e.relatedTarget).data("id")
      : "";
  var details =
    modalType == "details" ? $(e.relatedTarget).data("details") : "";

  $.ajax({
    url: site_url + "kelola-tes/modal",
    method: "POST",
    data: {
      modal_type: modalType,
      id: id,
      details: details,
    },
    dataType: "json",
    beforeSend: function () {
      $("#testModal")
        .find(".modal-body")
        .html(
          "<div class='text-center'><i class='fa fa-spinner fa-spin fa-4x'></i></div>"
        );
    },
    success: function (data) {
      //modal tambah dan edit
      if (modalType == "add" || modalType == "edit") {
        $("#testModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#testModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#testModal").find(".form-control").first().focus();

        $("#applicants, #topics").select2({
          dropdownParent: $("#testModal").find(".modal-content"),
        });

        // $.each(data.disabled.applicants, function (index, value) {
        //   $("#applicants > option")
        //     .filter(function () {
        //       return $(this).val() == value;
        //     })
        //     .prop("disabled", true);
        // });

        $.each(data.disabled.topics, function (index, value) {
          $("#topics > option")
            .filter(function () {
              return $(this).val() == value;
            })
            .prop("disabled", true);
        });

        // panggil data
        if (modalType == "edit") {
          // $.each(data.value["id_pelamar"].split(","), function (index, value) {
          //   $("#applicants > option")
          //     .filter(function () {
          //       return $(this).val() == value;
          //     })
          //     .prop("disabled", false);
          // });

          $("#testId").val(data.value["id_tes"]);
          $("#testTitle").val(data.value["judul_tes"]);
          $("#testDesc").val(data.value["deskripsi_tes"]);
          $("#applicants").val(data.value["id_pelamar"].split(",")).change();
          $("#topics").val(data.value["id_topik"].split(",")).change();
          $("#minPassGrade").val(data.value["nilai_min_lulus"]);
          $("#testDuration").val(data.value["durasi_tes"]);
        }

        // validasi form dan simpan data
        $("#formTest").validate({
          rules: {
            test_duration: { step: false },
            min_pass_grade: { step: false },
          },
          messages: {
            test_title: {
              required: "Silakan masukkan Judul Tes",
            },
            test_desc: {
              required: "Silakan masukkan Deskripsi Tes",
            },
            "applicants[]": {
              required: "Silakan masukkan Daftar Pelamar",
            },
            "topics[]": {
              required: "Silakan masukkan Topik Tes",
            },
            min_pass_grade: {
              number: "Silakan masukkan nomor yang valid",
              required: "Silakan masukkan Minimal Nilai Lulus",
              min: "Minimal nilai 1",
              max: "Maksimal nilai 100%",
            },
            test_duration: {
              required: "Silakan masukkan Durasi Tes",
              min: "Durasi tidak boleh 0",
            },
          },
          errorElement: "div",
          errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            if (element.hasClass("select2")) {
              error.insertAfter(element.next());
              $(".select2").on("change.select2", function () {
                $("#formTest").validate().form();
              });
            } else {
              error.insertAfter(element);
            }
          },
          highlight: function (element, errorClass, validClass) {
            if ($(element).hasClass("select2")) {
              $(element)
                .next()
                .find(".select2-selection")
                .css("border-color", "#dc3545");
            } else {
              $(element).css("border-color", "#dc3545");
            }
          },
          unhighlight: function (element, errorClass, validClass) {
            if ($(element).hasClass("select2")) {
              $(element)
                .next()
                .find(".select2-selection")
                .css("border-color", "");
            } else {
              $(element).css("border-color", "");
            }
          },
          submitHandler: function (form) {
            var button = $(form).find("button[type='submit']");
            $.ajax({
              url: form.action,
              method: form.method,
              data: $(form).serialize(),
              dataType: "json",
              beforeSend: function () {
                button.html("Simpan... <i class='fa fa-spinner fa-spin'></i>");
                button.prop("disabled", true);
              },
              success: function (data) {
                if (data.save) {
                  $("#testModal").modal("hide");
                  if (modalType == "edit") {
                    $("#tableTest").DataTable().ajax.reload(null, false);
                  } else {
                    $("#tableTest").DataTable().ajax.reload();
                  }
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                }
              },
            });
          },
        });
      } else if (modalType == "delete") {
        $("#testModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#testModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#testModal")
          .find(".btnDelete")
          .on("click", function () {
            var button = $(this);
            $.ajax({
              url: site_url + "kelola-tes/hapus",
              method: "POST",
              data: {
                id: id,
              },
              dataType: "json",
              beforeSend: function () {
                button.html("Hapus... <i class='fa fa-spinner fa-spin'></i>");
                button.prop("disabled", true);
              },
              success: function (data) {
                if (data.delete) {
                  $("#testModal").modal("hide");
                  $("#tableTest").DataTable().ajax.reload();
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                }
              },
            });
          });
      } else {
        $("#testModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#testModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
      }
    },
  });
});

//keluar form modal
$("#testModal").on("hidden.bs.modal", function (e) {
  $("#testModal").find(".modal-body").empty();
  $("#testModal").find(".modal-title").empty();
});
