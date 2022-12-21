"use strict";

$("#navigationTab").find("li").first().find(".nav-link").tab("show");
var i,
  items = $("#navigationTab .nav-link");
$("#btnNext").click(function () {
  for (i = 0; i < items.length; i++) {
    if ($(items[i]).hasClass("active") == true) {
      break;
    }
  }
  if (i < items.length - 1) {
    // for tab
    // $(items[i]).removeClass("active");
    $(".tab-pane").removeClass("active show");
    $(items[i + 1]).tab("show");
    // for pane
  }
  showHideButtons();
});

$("#btnPrev").click(function () {
  for (i = 0; i < items.length; i++) {
    if ($(items[i]).hasClass("active") == true) {
      break;
    }
  }
  if (i != 0) {
    // for tab
    $(".tab-pane").removeClass("active show");
    $(items[i - 1]).click();
  }
  showHideButtons();
});
showHideButtons();

$("#questionNumber")
  .find("h4")
  .html("Soal 1 dari " + items.length);
$("#navigationTab .nav-link").on("shown.bs.tab", function (e) {
  var no = $(e.target).html();
  $("#questionNumber")
    .find("h4")
    .html("Soal " + no + " dari " + items.length);
  showHideButtons();
});

function showHideButtons() {
  for (i = 0; i < items.length; i++) {
    if ($(items[i]).hasClass("active") == true) {
      break;
    }
  }

  if (i == 0) {
    $("#btnPrev").hide();
  } else {
    $("#btnPrev").show();
  }

  if (i == items.length - 1) {
    $("#btnNext").hide();
    $("#btnNext").next().show();
  } else {
    $("#btnNext").show();
    $("#btnNext").next().hide();
  }
}

$(".btnChoice").on("click", function (e) {
  e.preventDefault();
  $(this).parent().find(".btnChoice").removeClass("active");
  $(this).addClass("active");
  $(this).find("input[type='radio']").prop("checked", true);
  // localStorage[$(this).find("input[type='radio']").attr("name")] = $(this)
  //   .find("input[type='radio']")
  //   .val();
  $(".nav-link.active").parent().css("box-shadow", "inset 0 2px 0 0 #6777ef");
});

var seconds = $("#countdown").data("seconds");
var endTime = false;
$("#countdown").timeTo(seconds, function () {
  endTime = true;
  $(this).timeTo("stop");
  $("#formTestSubmit").submit();
});
window.onbeforeunload = function (e) {
  e.preventDefault();
  e.returnValue = "";
};

$("#formTestSubmit").validate({
  submitHandler: function (form) {
    window.onbeforeunload = null;
    var button = $(form).find("button[type='submit']");
    function finish() {
      $.ajax({
        url: form.action,
        method: form.method,
        data: $(form).serialize(),
        dataType: "json",
        beforeSend: function () {
          button.html("Selesai... <i class='fa fa-spinner fa-spin'></i>");
          button.prop("disabled", true);
        },
        success: function (data) {
          if (data.success) {
            location.href = data.url;
          }
        },
      });
    }
    var msg = endTime
      ? "Waktu habis!<br>Tes terpaksa selesai!"
      : "Yakin tes selesai?";
    swal(msg, {
      buttons: endTime ? false : ["Tidak", "Ya"],
      timer: endTime ? 2000 : false,
      closeOnClickOutside: false,
    }).then(function (confirm) {
      if (endTime) {
        finish();
      } else {
        if (confirm) {
          $("#countdown").timeTo("stop");
          finish();
        }
      }
    });
  },
});
