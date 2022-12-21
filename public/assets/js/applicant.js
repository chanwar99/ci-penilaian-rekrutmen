"use strict";
// halaman kelola pelamar
$("#tableApplicant").DataTable({
  ordering: false,
  lengthChange: false,
  processing: true,
  serverSide: true,
  searching: false,
  // scrollX: true,
  ajax: {
    url: site_url + "kelola-pelamar/panggil",
    type: "POST",
    data: function (d) {
      d.filter_applicant_name = $("#filterApplicantName").val();
    },
  },
  language: {
    processing: "hallo",
    emptyTable: "Belum ada Data Pelamar.",
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
$("#filterApplicantName").on("keyup", function () {
  $("#tableApplicant").DataTable().ajax.reload();
});

// tampil modal
$("#applicantModal").on("shown.bs.modal", function (e) {
  var modalType = $(e.relatedTarget).data("modal-type");
  var id =
    modalType == "edit" || modalType == "delete"
      ? $(e.relatedTarget).data("id")
      : "";

  $.ajax({
    url: site_url + "kelola-pelamar/modal",
    method: "POST",
    data: {
      modal_type: modalType,
      id: id,
    },
    dataType: "json",
    beforeSend: function () {
      $("#applicantModal")
        .find(".modal-body")
        .html(
          "<div class='text-center'><i class='fa fa-spinner fa-spin fa-4x'></i></div>"
        );
    },
    success: function (data) {
      //modal tambah dan edit
      if (modalType == "add" || modalType == "edit") {
        $("#applicantModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#applicantModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#applicantModal").find(".form-control").first().focus();

        // panggil data
        if (modalType == "edit") {
          $("#applicantId").val(data.value["id_pelamar"]);
          $("#applicantName").val(data.value["nama_pelamar"]);
          $("#gender").val(data.value["jenis_kelamin"]);
          $("#placeBirth").val(data.value["tempat_lahir"]);
          $("#dateBirth").val(data.value["tanggal_lahir"]);
          $("#gender").val(data.value["jenis_kelamin"]);
          $("#email").val(data.value["alamat_email"]);
        }

        // validasi form dan simpan data
        $("#formApplicant").validate({
          messages: {
            applicant_name: {
              required: "Silakan masukkan Nama Pelamar",
            },
            gender: {
              required: "Silakan pilih Jenis Kelamin",
            },
            place_birth: {
              required: "Silakan masukkan Tempat Lahir",
            },
            date_birth: {
              required: "Silakan masukkan Tanggal Lahir",
            },
            email: {
              required: "Silakan masukkan Email",
              email: "Format email tidak valid",
            },
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
                  $("#applicantModal").modal("hide");
                  if (modalType == "edit") {
                    $("#tableApplicant").DataTable().ajax.reload(null, false);
                  } else {
                    $("#tableApplicant").DataTable().ajax.reload();
                  }
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                } else {
                  iziToast.error({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                  button.html("Simpan");
                  button.prop("disabled", false);
                }
              },
            });
          },
        });
      } else {
        $("#applicantModal")
          .find(".modal-body")
          .hide()
          .html(data.html)
          .fadeIn("slow");
        $("#applicantModal")
          .find(".modal-title")
          .hide()
          .html(data.title)
          .fadeIn("slow");
        $("#applicantModal")
          .find(".btnDelete")
          .on("click", function () {
            var button = $(this);
            $.ajax({
              url: site_url + "kelola-pelamar/hapus",
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
                  $("#applicantModal").modal("hide");
                  $("#tableApplicant").DataTable().ajax.reload();
                  iziToast.success({
                    title: data.message,
                    position: "topRight",
                    progressBar: false,
                    timeout: 2000,
                  });
                } else {
                  $("#applicantModal").modal("hide");
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
$("#applicantModal").on("hidden.bs.modal", function (e) {
  $("#applicantModal").find(".modal-body").empty();
  $("#applicantModal").find(".modal-title").empty();
});
