$(document).ready(function () {
 
  $(function () {
    $(".toggle-password").click(function () {
      var fieldId = $(this).closest(".input-group").find("input").attr("id");
      var fieldType = $("#" + fieldId).attr("type");

      $("#" + fieldId).attr(
        "type",
        fieldType === "password" ? "text" : "password"
      );
      $(this).find("i").toggleClass("fa-eye fa-eye-slash");
    });
  });


});
