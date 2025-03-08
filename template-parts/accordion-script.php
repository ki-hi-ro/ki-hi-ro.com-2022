<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  jQuery(document).ready(function ($) {
    $(".accordion-header").click(function () {
      var content = $(this).next(".accordion-content");
      var icon = $(this).find(".icon");

      if (content.is(":visible")) {
        content.slideUp();
        icon.text("+");
      } else {
        $(".accordion-content").slideUp();
        $(".accordion-header .icon").text("+");

        content.slideDown();
        icon.text("×");
      }
    });
  });
</script>