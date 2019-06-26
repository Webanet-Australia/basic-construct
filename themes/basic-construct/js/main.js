//TODO: Hard coded logo (+ lgoo sm) path
jQuery(document).ready(function($) {
  $(window).scroll(function() {
    if ($(document).scrollTop() > 100) {
      $('#mainNav').height(20);
      $('.bc-logo').attr('src', '/wp-content/themes/vingaro/img/logo-sm.png');
    } else {
      $('#mainNav').height(80);
      $('.bc-logo').attr('src', '/wp-content/uploads/2018/08/logo.jpg');
    }
  });
});
