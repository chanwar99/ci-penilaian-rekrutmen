"use strict";
// halaman login
$("#formLogin").validate({
  messages: {
    email_or_username: {
      required: "Silakan masukkan Email atau Nama User",
    },
    password: {
      required: "Silakan masukkan Kata Sandi",
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
        button.html("Login... <i class='fa fa-spinner fa-spin'></i>");
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
