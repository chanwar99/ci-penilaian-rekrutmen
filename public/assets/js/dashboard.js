"use strict";

testCall($(".test-item.active").data("id"));
passTestCall($(".test-item.active").data("id"));
$("#testDropdown").text($(".test-item.active").text());
$("#passTestDropdown").text($(".pass-test-item.active").text());
$(".test-item").on("click", function () {
  $(".test-item").removeClass("active");
  $(this).addClass("active");
  $("#testDropdown").text($(".test-item.active").text());
  var id = $(this).data("id");
  testCall(id);
});
$(".pass-test-item").on("click", function () {
  $(".pass-test-item").removeClass("active");
  $(this).addClass("active");
  $("#passTestDropdown").text($(".pass-test-item.active").text());
  var id = $(this).data("id");
  passTestCall(id);
});

function testCall(id) {
  $.ajax({
    url: site_url + "/panggil-tes",
    method: "POST",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      if (data.applicant_count) {
        $("#testCard").hide().fadeIn();
        $("#testCard").find(".card-body").text(data.applicant_count);
        $("#inActive").text(data.status_count.in_active);
        $("#active").text(data.status_count.active);
        $("#start").text(data.status_count.start);
        $("#finish").text(data.status_count.finish);
      }
    },
  });
}

function passTestCall(id) {
  $.ajax({
    url: site_url + "/panggil-lulus-tes",
    method: "POST",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data.list) {
        $("#passTestCard").hide().fadeIn();
        $("#list").html(data.list);
      }
    },
  });
}
