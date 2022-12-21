"use strict";
// halaman kelola soal
$("#tableQuestion").DataTable({
  ordering: false,
  lengthChange: false,
  processing: true,
  serverSide: true,
  searching: false,
  // scrollX: true,
  ajax: {
    url: site_url + "kelola-soal/panggil",
    type: "POST",
    data: function (d) {
      d.filter_topic = $("#filterTopic").val();
    },
  },
  language: {
    processing: "hallo",
    emptyTable: "Belum ada Data Soal.",
    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
    zeroRecords: "Data tidak ditemukan",
    infoFiltered: "(tersaring dari _MAX_ total data)",
    paginate: {
      previous: "<i class='fas fa-chevron-left'></i>",
      next: "<i class='fas fa-chevron-right'></i>",
    },
  },
  columnDefs: [{ width: "30%", targets: [2] }],
});
$("#filterTopic").select2();
$("#filterTopic").on("change", function () {
  $("#tableQuestion").DataTable().ajax.reload();
});

// tampil modal
$("#questionModal").on("shown.bs.modal", function (e) {
  var modalType = $(e.relatedTarget).data("modal-type");
  var id =
    modalType == "edit" || modalType == "delete"
      ? $(e.relatedTarget).data("id")
      : "";

  $.ajax({
    url: site_url + "kelola-soal/modal",
    method: "POST",
    data: {
      modal_type: modalType,
      id: id,
    },
    dataType: "json",
    beforeSend: function () {
      $("#questionModal")
        .find(".modal-body")
        .html(
          "<div class='text-center'><i class='fa fa-spinner fa-spin fa-4x'></i></div>"
        );
    },
    success: function (data) {
      //modal tambah dan edit
      if (modalType == "add" || modalType == "edit") {
        $("#questionModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#questionModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#questionModal").find(".form-control").first().focus();

        $("#topic").select2({
          dropdownParent: $("#questionModal").find(".modal-content"),
        });

        // panggil data
        if (modalType == "edit") {
          $("#questionId").val(data.value["id_soal"]);
          $("#topicOld").val(data.value["id_topik"]);
          $("#topic").val(data.value["id_topik"]).change();
          $("#questionText").val(data.value["teks_soal"]);
          $("#choice1").val(data.value["pil_1"]);
          $("#choice2").val(data.value["pil_2"]);
          $("#choice3").val(data.value["pil_3"]);
          $("#choice4").val(data.value["pil_4"]);
          $("#answer").val(data.value["kun_jaw"]);
          $("#points").val(data.value["poin"]);
        }

        // validasi form dan simpan data
        $("#formQuestion").validate({
          messages: {
            topics: {
              required: "Silakan pilih Topik",
            },
            question_text: {
              required: "Silakan masukkan Teks Soal",
            },
            choice_1: {
              required: "Silakan masukkan Pilihan 1",
            },
            choice_2: {
              required: "Silakan masukkan Pilihan 2",
            },
            choice_3: {
              required: "Silakan masukkan Pilihan 3",
            },
            choice_4: {
              required: "Silakan masukkan Pilihan 4",
            },
            answer: {
              required: "Silakan masukkan Kunci Jawaban",
            },
            points: {
              number: "Silakan masukkan nomor yang valid",
              min: "Minimal poin adalah 1",
              required: "Silakan masukkan Poin",
            }
          },
          errorElement: "div",
          errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            if (element.hasClass("select2")) {
              error.insertAfter(element.next());
              $(".select2").on("change.select2", function () {
                $("#formQuestion").validate().form();
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
                  $("#questionModal").modal("hide");
                  if (modalType == "edit") {
                    $("#tableQuestion").DataTable().ajax.reload(null, false);
                  } else {
                    $("#tableQuestion").DataTable().ajax.reload();
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
      } else {
        $("#questionModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#questionModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#questionModal")
          .find(".btnDelete")
          .on("click", function () {
            var button = $(this);
            $.ajax({
              url: site_url + "kelola-soal/hapus",
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
                  $("#questionModal").modal("hide");
                  $("#tableQuestion").DataTable().ajax.reload();
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                } else {
                  $("#questionModal").modal("hide");
                  iziToast.error({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });

                }
              },
            });
          });
      }
    },
  });
});

//keluar form modal
$("#questionModal").on("hidden.bs.modal", function (e) {
  $("#questionModal").find(".modal-body").empty();
  $("#questionModal").find(".modal-title").empty();
});