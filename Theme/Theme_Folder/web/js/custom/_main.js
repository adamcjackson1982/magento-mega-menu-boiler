define([
    "jquery",
  ],
  function($, readmore) {
    "use strict";
      var yourtheme = {
        init: function() {
          this.menu();
          this.mobileMenu();
        },


        menu: function() {
          $(".mega-menu .list-group li").hover(
            function () {
              $(this).addClass("open");
            },
            function () {
              $(this).removeClass("open");
            }
          );
        },
          
        mobileMenu: function() {
          var mobileQuery = window.matchMedia('(max-width: 768px)');
          // menu toggling
          $('.js-menu-toggle').on('click', function(e){
            $('body').addClass('menu-open');
            if (mobileQuery.matches){
                //e.preventDefault();
                $('.js-mega-navigation').addClass('is-open');
            }
          });
          // close
          $('.js-close-menu').on('click', function(e){
              $('body').removeClass('menu-open');
              if (mobileQuery.matches){
                  e.preventDefault();
                  $('.js-mobile-menu__sub-menu').removeClass('is-open');
                  $('.js-mega-navigation').removeClass('is-open');
              }
          });
          // menu toggling

        $('.js-mobile-menu__parent-link').on('click', function(e){
          if (mobileQuery.matches){
              //e.preventDefault();
              var title = $(this).data('title'); 
              $(this).find('.js-add-title').text(title);
              $(this).addClass('open')
              $(this).find('.js-mobile-menu__sub-menu').first().addClass('is-open');
          }
      });

      if($(window).width() > 768) {

          $(document).mousemove(function (e) {

              if ($(e.target).closest('.js-mobile-menu__parent-link.top').length) {
                  $('body').addClass('mega-nav-active');
              }
              else {
                  $('body').removeClass('mega-nav-active');
              }
          });

      }

      $('.js-mobile-menu__sub-menu').on('click', function(e){
          if (mobileQuery.matches){
              e.stopPropagation();
          }
      });

      $('.js-mobile-menu__back-link').on('click', function(e){
          if (mobileQuery.matches){
              e.preventDefault();
              $('.js-mobile-menu__parent-link').removeClass('open')
              $(this).parent('.js-mobile-menu__sub-menu').removeClass('is-open');
          }
        });

        },

      }
      $(document).ready(function() {
          yourtheme.init();
    });
  });