jQuery(function ($) {
  'use strict';

  // Nav Scroll
  $(window).scroll(function (event) {
    Scroll();
  });

  $('.navbar-collapse ul li a').on('click', function () {
    $('html, body').animate({
      scrollTop: $(this.hash).offset().top - 5
    }, 1000);
    return false;
  });

  $('#client-slider .owl-carousel').owlCarousel({
    loop: true,
    margin: 50,
    autoplay: true,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    autoplaySpeed: 5000,
    autoplayHoverPause: false,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      600: {
        items: 3,
        nav: false
      },
      1000: {
        items: 3,
        nav: true,
      }
    }
  });


  $('#client-slider .owl-prev').innerHTML = '<i class="fas fa-4x fa-caret-left"></i>';
  $('#client-slider .owl-next').innerHTML = '<i class="fas fa-4x fa-caret-right"></i>';


    //Init the carousel


  // $("#brands").find('.owl-carousel').owlCarousel({
  //   loop: true,
  //   margin: 30,
  //   dots: true,
  //   loop: true,
  //   center: true,
  //   autoplay: true,
  //   smartSpeed: 1000,
  //   responsive: {
  //     300: {
  //       items: 2,
  //       nav: false
  //     },
  //     600: {
  //       items: 4,
  //       nav: false
  //     },
  //     1000: {
  //       items: 5,
  //       nav: true,
  //     }
  //   }
  // });


  $('.owl-galleeries').owlCarousel({
    items: 1,
    loop:true,
    margin:0,
    nav:true,
  })

  // Vendor carousel
  $('.vendor-carousel').owlCarousel({
    loop: true,
    margin: 30,
    dots: true,
    loop: true,
    center: true,
    autoplay: true,
    smartSpeed: 1000,
    responsive: {
      0: {
        items: 2
      },
      576: {
        items: 3
      },
      768: {
        items: 4
      },
      992: {
        items: 5
      },
      1200: {
        items: 6
      }
    }
  });

  $('[data-toggle="tooltip"]').tooltip();

  function Scroll() {
    var contentTop = [];
    var contentBottom = [];
    var winTop = $(window).scrollTop();
    var rangeTop = 200;
    var rangeBottom = 500;
    $('.navbar-collapse').find('.scroll a').each(function () {
      // contentTop.push($($(this).attr('href')).offset().top);
      // contentBottom.push($($(this).attr('href')).offset().top + $($(this).attr('href')).height());
    })
    $.each(contentTop, function (i) {
      if (winTop > contentTop[i] - rangeTop) {
        $('.navbar-collapse li.scroll')
          .removeClass('active')
          .eq(i).addClass('active');
      }
    })
  };

  $('#tohash').on('click', function () {
    $('html, body').animate({
      scrollTop: $(this.hash).offset().top - 5
    }, 1000);
    return false;
  });

  //Slider
  $(document).ready(function () {
    var time = 7; // time in seconds

    var $progressBar,
      $bar,
      $elem,
      isPause,
      tick,
      percentTime;

    //Init the carousel
    $("#main-slider").find('.owl-carousel').owlCarousel({
      slideSpeed: 500,
      paginationSpeed: 500,
      singleItem: true,
      navigation: true,
      navigationText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>"
      ],
      afterInit: progressBar,
      afterMove: moved,
      startDragging: pauseOnDragging,
      //autoHeight : true,
      transitionStyle: "fade" //fadeUp fade goDown backSlide

    });

    $("#brands").find('.owl-carousel').owlCarousel({
      loop: true,
      margin: 30,
      autoplay: true,
      smartSpeed: 1000,
      navigation: true,
      navigationText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>"
      ],
    });


    function progressBar(elem) {
      $elem = elem;
      buildProgressBar();
      start();
    }

    //create 
    function buildProgressBar() {
      $progressBar = $("<div>", {
        id: "progressBar"
      });
      $bar = $("<div>", {
        id: "bar"
      });
      $progressBar.append($bar).appendTo($elem);
    }

    function start() {
      percentTime = 0;
      isPause = false;
      tick = setInterval(interval, 10);
    };

    function interval() {
      if (isPause === false) {
        percentTime += 1 / time;
        $bar.css({
          width: percentTime + "%"
        });
        if (percentTime >= 100) {
          $elem.trigger('owl.next')
        }
      }
    }

    //pause while dragging 
    function pauseOnDragging() {
      isPause = true;
    }

    //moved callback
    function moved() {
      //clear interval
      clearTimeout(tick);
      //start again
      start();
    }
  });

  //Initiat WOW JS
  new WOW().init();
  //smoothScroll
  smoothScroll.init();

  // portfolio filter
  $(window).load(function () {
    'use strict';
    var $portfolio_selectors = $('.portfolio-filter >li>a');
    var $portfolio = $('.portfolio-items');
    $portfolio.isotope({
      itemSelector: '.portfolio-item',
      layoutMode: 'fitRows'
    });

    $portfolio_selectors.on('click', function () {
      $portfolio_selectors.removeClass('active');
      $(this).addClass('active');
      var selector = $(this).attr('data-filter');
      $portfolio.isotope({
        filter: selector
      });
      return false;
    });
  });

  $(document).ready(function () {
    //Animated Progress
    $('.progress-bar').bind('inview', function (event, visible, visiblePartX, visiblePartY) {
      if (visible) {
        $(this).css('width', $(this).data('width') + '%');
        $(this).unbind('inview');
      }
    });

    //Animated Number
    $.fn.animateNumbers = function (stop, commas, duration, ease) {
      return this.each(function () {
        var $this = $(this);
        var start = parseInt($this.text().replace(/,/g, ""));
        commas = (commas === undefined) ? true : commas;
        $({
          value: start
        }).animate({
          value: stop
        }, {
          duration: duration == undefined ? 1000 : duration,
          easing: ease == undefined ? "swing" : ease,
          step: function () {
            $this.text(Math.floor(this.value));
            if (commas) {
              $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }
          },
          complete: function () {
            if (parseInt($this.text()) !== stop) {
              $this.text(stop);
              if (commas) {
                $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
              }
            }
          }
        });
      });
    };

    $('.business-stats').bind('inview', function (event, visible, visiblePartX, visiblePartY) {
      var $this = $(this);
      if (visible) {
        $this.animateNumbers($this.data('digit'), false, $this.data('duration'));
        $this.unbind('inview');
      }
    });
  });

  /* -------- Isotope Filtering -------- */
  $(document).ready(function () {
    var $container = $('#isotope-gallery-container');
    var $filter = $('.filter');
    $(window).load(function () {
      // Initialize Isotope
      $container.isotope({
        itemSelector: '.gallery-item-wrapper'
      });
      $('.filter a').click(function () {
        var selector = $(this).attr('data-filter');
        $container.isotope({
          filter: selector
        });
        return false;
      });
      $filter.find('a').click(function () {
        var selector = $(this).attr('data-filter');
        $filter.find('a').parent().removeClass('active');
        $(this).parent().addClass('active');
      });
    });
    $(window).smartresize(function () {
      $container.isotope('reLayout');
    });
    // End Isotope Filtering


    /* -------- Gallery Popup -------- */

    // $('.gallery-zoom').magnificPopup({
    //   type: 'image'
    //   // other options
    // });
  });
  // End Gallery Popup

  //Pretty Photo
  $("a[rel^='prettyPhoto']").prettyPhoto({
    social_tools: false
  });

  $(".owl-interior").owlCarousel({    
    items:1,
    margin: 10,
    autoplay:true,
    loop: true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true
        }
    }
  });
  
  var dotcount = 1;
  
  jQuery('.owl-interior .owl-page').each(function() {
    jQuery( this ).addClass( 'dotnumber' + dotcount);
    jQuery( this ).attr('data-info', dotcount);
    dotcount = dotcount + 1;
  });
  
  var slidecount = 1;
  
  jQuery('.owl-interior .owl-item').not('.cloned').each(function() {
    jQuery( this ).addClass( 'slidenumber' + slidecount);
    slidecount = slidecount + 1;
  });
  
  jQuery('.owl-interior .owl-page').each(function() {	
    var grab = jQuery(this).data('info');		
    var slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
    jQuery(this).css("background-image", "url("+slidegrab+")");  	
  });
  
  var amount = $('.owl-interior .owl-page').length;
  var gotowidth = 100/amount;			
  jQuery('.owl-interior .owl-page').css("height", gotowidth+"%");

});