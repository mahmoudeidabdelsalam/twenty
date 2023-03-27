/**
 * Theme's main JS.
 *  
 * @license https://opensource.org/licenses/MIT MIT
 * @author Vee W.
 */


// jQuery on DOM is ready. ------------------------------------------------------------------------------------------------
jQuery(document).ready(function($) {
    // mark no-js class as js because JS is working.
    $('html').removeClass('no-js').addClass('js');


    $('.products-carousel').owlCarousel({
      items: 3,
      loop:true,
      margin:10,
      nav:true,
      navText: ["<div class='nav-button owl-prev'><i class='fa fa-arrow-left'></i></div>", "<div class='nav-button owl-next'><i class='fa fa-arrow-right'></i></div>"],
      responsiveClass:true,
      center: true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:2
        },
        1000:{
          items:3
        }
      }
    })

    $('[data-toggle="tab"]').on('shown.bs.tab', function () {
      initialize_owl($('.about-carousel'));
    });

    $('[data-toggle="tab"]').on('shown.bs.tab', function () {
      initialize_product($('.products-carousel'));
    });

    function initialize_owl(el) {
      el.owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:3
          },
          1000:{
            items:5
          }
        }
      })
    }

    function initialize_product(el) {
      el.owlCarousel({
        items: 3,
        loop:true,
        margin:10,
        nav:true,
        navText: ["<div class='nav-button owl-prev'><i class='fa fa-arrow-left'></i></div>", "<div class='nav-button owl-next'><i class='fa fa-arrow-right'></i></div>"],
        responsiveClass:true,
        center: true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:2
          },
          1000:{
            items:3
          }
        }
      })
    }

});
