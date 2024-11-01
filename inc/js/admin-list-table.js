(function($) {

$(document).ready(function() {

$(".shortcode-input-row").on("click", function () {
   $(this).select();
});
$(".dfu-notice-quit").on("click", function () {
   $(this).parent('div').fadeOut();
});


});

})(jQuery);