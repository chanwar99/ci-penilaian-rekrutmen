"use strict";
// halaman login
$("#formTestLogin").validate({
  messages: {
    test_code: {
      required: "Silakan masukkan Kode Tes",
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
        button.html("Login Tes... <i class='fa fa-spinner fa-spin'></i>");
        button.prop("disabled", true);
      },
      success: function (data) {
        if (data.success) {
          location.href = data.url;
        } else {
          // alert(data.message);
          button.html("Login");
          button.prop("disabled", false);
          iziToast.error({
            title: data.message,
            position: "bottomCenter",
            progressBar: false,
            timeout: 2000,
          });
        }
      },
    });
  },
});
