// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
    $('.bxslider').bxSlider({
      mode: 'fade',
      pager: false,
      auto: true,
      controls: false
    });  
    $('.bxslider_carrousel').bxSlider({
      minSlides: 3,
      maxSlides: 6,
      slideWidth: 145,
      slideMargin: 10,
      pager : false
    });      
}());

// Place any jQuery/helper plugins in here.
