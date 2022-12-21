"use strict";

$("#formTestStart").validate({
  submitHandler: function (form) {
    var button = $(form).find("button[type='submit']");
    button.html("Mulai Tes... <i class='fa fa-spinner fa-spin'></i>");
    button.prop("disabled", true);
    form.sumbit();
  },
});
