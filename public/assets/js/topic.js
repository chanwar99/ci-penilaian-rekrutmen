"use strict";
// halaman kelola topik
$("#tableTopic").DataTable({
  ordering: false,
  lengthChange: false,
  processing: true,
  serverSide: true,
  searching: false,
  // scrollX: true,
  ajax: {
    url: site_url + "kelola-topik/panggil",
    type: "POST",
    data: function (d) {
      d.filter_topic_title = $("#filterTopicTitle").val();
    },
  },
  language: {
    processing: "hallo",
    emptyTable: "Belum ada Data Topik.",
    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
    zeroRecords: "Data tidak ditemukan",
    infoFiltered: "(tersaring dari _MAX_ total data)",
    paginate: {
      previous: "<i class='fas fa-chevron-left'></i>",
      next: "<i class='fas fa-chevron-right'></i>",
    },
  },
  // columnDefs: [{ width: "50%", targets: [2] }],
});
$("#filterTopicTitle").on("keyup", function () {
  $("#tableTopic").DataTable().ajax.reload();
});

// tampil modal
$("#topicModal").on("shown.bs.modal", function (e) {
  var modalType = $(e.relatedTarget).data("modal-type");
  var id =
    modalType == "edit" || modalType == "delete"
      ? $(e.relatedTarget).data("id")
      : "";

  $.ajax({
    url: site_url + "kelola-topik/modal",
    method: "POST",
    data: {
      modal_type: modalType,
      id: id,
    },
    dataType: "json",
    beforeSend: function () {
      $("#topicModal")
        .find(".modal-body")
        .html(
          "<div class='text-center'><i class='fa fa-spinner fa-spin fa-4x'></i></div>"
        );
    },
    success: function (data) {
      //modal tambah dan edit
      if (modalType == "add" || modalType == "edit") {
        $("#topicModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#topicModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#topicModal").find(".form-control").first().focus();

        // panggil data
        if (modalType == "edit") {
          $("#topicId").val(data.value["id_topik"]);
          $("#topicTitle").val(data.value["judul_topik"]);
        }

        // validasi form dan simpan data
        $("#formTopic").validate({
          messages: {
            topic_title: {
              required: "Silakan masukkan Judul Topik",
            }
          },
          errorElement: "div",
          errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).css("border-color", "#dc3545");
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).css("border-color", "");
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
                  $("#topicModal").modal("hide");
                  if (modalType == "edit") {
                    $("#tableTopic").DataTable().ajax.reload(null, false);
                  } else {
                    $("#tableTopic").DataTable().ajax.reload();
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
        $("#topicModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#topicModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#topicModal")
          .find(".btnDelete")
          .on("click", function () {
            var button = $(this);
            $.ajax({
              url: site_url + "kelola-topik/hapus",
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
                  $("#topicModal").modal("hide");
                  $("#tableTopic").DataTable().ajax.reload();
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                } else {
                  $("#topicModal").modal("hide");
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
$("#topicModal").on("hidden.bs.modal", function (e) {
  $("#topicModal").find(".modal-body").empty();
  $("#topicModal").find(".modal-title").empty();
});
