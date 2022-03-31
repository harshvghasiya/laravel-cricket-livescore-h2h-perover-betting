$(function ($) {
    "use strict";
  
    jQuery(document).ready(function () {
      /* niceSelect */
      $("select").niceSelect();
  
      // counter Up
      if (document.querySelector('.counter') !== null) {
        $('.counter').counterUp({
          delay: 10,
          time: 2000
        });
      }
  
      // features-carousel
      $(".features-carousel").not('.slick-initialized').slick({
        infinite: true,
        autoplay: false,
        focusOnSelect: false,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
          var slideNumber = (i + 1),
            totalSlides = slider.slideCount;
          return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 460,
            settings: {
              slidesToShow: 1,
            }
          }
        ]
      });
  
      // testimonails-carousel
      $(".testimonails-carousel").not('.slick-initialized').slick({
        infinite: true,
        autoplay: false,
        centerMode: true,
        focusOnSelect: false,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
          var slideNumber = (i + 1),
            totalSlides = slider.slideCount;
          return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        },
        responsive: [
          {
            breakpoint: 1250,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 676,
            settings: {
              slidesToShow: 1,
              centerMode: false,
            }
          }
        ]
      });
  
      // sidebar-carousel
      $(".sidebar-carousel").not('.slick-initialized').slick({
        infinite: true,
        autoplay: false,
        centerMode: false,
        focusOnSelect: false,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev pull-left'></button>",
        nextArrow: "<button type='button' class='slick-next pull-right'></button>",
        dots: false,
        dotsClass: 'section-dots',
        customPaging: function (slider, i) {
          var slideNumber = (i + 1),
            totalSlides = slider.slideCount;
          return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
        }
      });
  
      /* Magnific Popup */
      if (document.querySelector('.popupvideo') !== null) {
        $('.popupvideo').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false,
        });
      }
  
      /* Countdown js */
      if (document.querySelector('.countdown') !== null) {
        $('.countdown').downCount({
          date: '12/31/2022 11:59:59',
          offset: +10
        });
      }
  
      /* Datepicker js */
      $("#dateSelect").datepicker();
      $("#closing-date").datepicker();
      $("#finish-date").datepicker();
      
      /* Wow js */
      new WOW().init();
  
    });
  });