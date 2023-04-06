// Сreated by vereschak@gmail.com
// -----------------------------------------
$(document).ready(function() {
  $("label").on("click", function(e) {
    e.preventDefault();
    var $radio = $("#" + $(this).attr("for")),
      name = $radio.attr("name"),
      hasRadio = $radio.attr("type") == "radio";
    if (!hasRadio) return;
    if ($radio.data("is-checked") == true) {
      $radio.prop("checked", false).change();
      $radio.data("is-checked", false);
    } else {
      $radio.data("is-checked", true);
      $radio.prop("checked", true).change();
    }
    $('input[type="radio"][name="' + name + '"]')
      .not("#" + $(this).attr("for"))
      .data("is-checked", false);
  });
});
