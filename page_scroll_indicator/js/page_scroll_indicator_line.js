 (function($) {
      Drupal.behaviors.psijs = {
        attach: function (context, settings) {
        var $color = drupalSettings.page_scroll_indicator.colour;
      $('body').append('<div class="bar-long"></div>');
      var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
      $('.bar-long').css('width', scrollPercent + '%');
      $('.bar-long').css('background-color', $color);
      $('.bar-long').css('box-shadow', '0 0 8px ' + $color);
      $(window).scroll(function () {
        var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
        $('.bar-long').css('width', scrollPercent + '%');
      });
        }

      };

})(jQuery);
