(function($) {
    "use strict";
    $('.button').click(function(){
        $('.button').toggleClass('active');
        $('.title').toggleClass('active');
        $('nav').toggleClass('active');
      });
      $('.ntshka-card2-post-module').hover(function() {
        $(this).find('.ntshka-card2-description').stop().animate({
          height: "toggle",
          opacity: "toggle"
        }, 300);
      });
})(jQuery);
