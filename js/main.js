
$(document).ready(function(){
    
    (function (factory) {
        if (typeof define === "function" && define.amd) {

            // AMD. Register as an anonymous module.
            define(["../widgets/datepicker"], factory);
        } else {

            // Browser globals
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {

        datepicker.regional.sk = {
            prevText: "Predchádzajúci",
            nextText: "Nasledujúci",
            currentText: 'Teraz',
            closeText: 'Hotovo',
            monthNames: ["Január", "Február", "Marec", "Apríl", "Máj", "Jún",
                "Júl", "August", "September", "Október", "November", "December"
            ],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Máj", "Jún",
                "Júl", "Aug", "Sep", "Okt", "Nov", "Dec"
            ],
            dayNames: ["Nedeľa", "Pondelok", "Utorok", "Streda", "Štvrtok", "Piatok", "Sobota"],
            dayNamesShort: ["Ned", "Pon", "Uto", "Str", "Štv", "Pia", "Sob"],
            dayNamesMin: ["Ne", "Po", "Ut", "St", "Št", "Pia", "So"],
            weekHeader: "Ty",
            dateFormat: "dd.mm.yy",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        datepicker.setDefaults(datepicker.regional.sk);

        return datepicker.regional.sk;

    }));

	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;


	$(".fullscreen").css("height", window_height)
	$(".fitscreen").css("height", fitscreen);

     if(document.getElementById("default-select")){
          $('select').niceSelect();
    };

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });
    $.datepicker.setDefaults($.datepicker.regional['sk']);
     $(function() {
        $("#datepicker").datepicker();
     });

     $(function () {
         $("#eventDate,#eventEnd").datetimepicker({
             dateFormat: 'dd.mm.yy -',
             timeFormat: 'HH:mm',
             yearRange: "-100:+2",
             firstDay: 1,
             regional:{ // Default regional settings
                     currentText: 'Teraz',
                     closeText: 'Hotovo',
             },
             changeYear: true,
             showMillisec: false,
             showMicrosec: false,
             showTimezone: false,
             showTime: false,
             hourText: 'Hodina',
             minuteText: 'Minúta',
         });

         $('.eventFrom,.eventTo').datepicker({
             dateFormat: 'dd.mm.yy',
             yearRange: "-100:+2",
             firstDay: 1,
            regional: { // Default regional settings
                currentText: 'Teraz',
                closeText: 'Hotovo',
            },
             changeYear: true,
             showHours: false,
             showMinutes: false,
             showMillisec: false,
             showMicrosec: false,
             showTimezone: false,
             showTime: false
         });
     });


    $('.play-btn').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });


    //  Counter Js 

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });    


  // Initiate superfish on nav menu
  $('.nav-menu').superfish({
    animation: {
      opacity: 'show'
    },
    speed: 400
  });

  // Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');

    $(document).on('click', '.menu-has-children', function(e) {
      e.stopPropagation();
      $(this).find('i').eq(0).next().toggleClass('menu-item-active');
      $(this).find('ul').eq(0).slideToggle();
      $(this).find('i').eq(0).toggleClass("lnr-chevron-up lnr-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if( ! $('#header').hasClass('header-fixed') ) {
            top_space = top_space;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('lnr-times lnr-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });


    $(document).ready(function() {

    $('html, body').hide();

        if (window.location.hash) {

        setTimeout(function() {

        $('html, body').scrollTop(0).show();

        $('html, body').animate({

        scrollTop: $(window.location.hash).offset().top-129

        }, 1000)

        }, 0);

        }

        else {

        $('html, body').show();

        }

    });
  

  // Header scroll class
  $(window).scroll(function() {
    if (window.location.href.indexOf('clanok') != -1){
      return;
    }
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });


    $('.active-gallery').owlCarousel({
        items:6,
        loop:true,
        dots: true,
        autoplay:true,    
            responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            },
            900: {
                items: 6,
            }

        }
    });


    $('.active-review-carusel').owlCarousel({
        items:1,
        autoplay:true,
        loop:true,
        dots: true
    });

  //  Start Google map 

    // When the window has finished loading create our google map below

  if(document.getElementById("map")){
  
  google.maps.event.addDomListener(window, 'load', init);

  function init() {
      // Basic options for a simple Google Map
      // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
      var mapOptions = {
          // How zoomed in you want the map to start at (always required)
          zoom: 11,

          // The latitude and longitude to center the map (always required)
          center: new google.maps.LatLng(40.6700, -73.9400), // New York

          // How you would like to style the map. 
          // This is where you would paste any style found on Snazzy Maps.
          styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
      };

      // Get the HTML DOM element that will contain your map 
      // We are using a div with id="map" seen below in the <body>
      var mapElement = document.getElementById('map');

      // Create the Google Map using our element and options defined above
      var map = new google.maps.Map(mapElement, mapOptions);

      // Let's also add a marker while we're at it
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(40.6700, -73.9400),
          map: map,
          title: 'Snazzy!'
      });
    }
  }

 });

 if ($('#szvj-load-pdf').length > 0) {
   PDFObject.embed("/assets/szvj.pdf", "#szvj-load-pdf");
 }
  if ($('#sawe-load-pdf').length > 0) {
      PDFObject.embed("/assets/SAWE - Pravidlá.pdf", "#sawe-load-pdf");
  }

  $('.showHideSubMenu').on('click', function () {
    var subMenu = $(this).next('.submenu');
    if ($(subMenu).is(':visible')) {
      $(this).find('i').removeClass('up').addClass('down');
      $(subMenu).hide('50');
    } else {
      $(subMenu).slideDown("slow");
      $(this).find('i').removeClass('down').addClass('up');
    }
  })

 $(document).ready(function () {
    enableMultiSelect();
   $('#ms-list-1').css('display', 'inline-block').css('width', '250px');

 });

 function enableMultiSelect() {
     $('.multiselect').multiselect({
         columns: 1, // how many columns should be use to show options
         search: true, // include option search box

         // search filter options
         searchOptions: {
             delay: 100, // time (in ms) between keystrokes until search happens
             searchText: true, // search within the text
         },

         // plugin texts
         texts: {
             placeholder: 'Vyberte si z možností', // text to use in dummy input
             search: 'Hľadať', // search input placeholder text
             selectedOptions: ' možnosti vybraté', // selected suffix text
             selectAll: 'Vybrať všetky', // select all text
             unselectAll: 'Zrušiť všetky', // unselect all text
             noneSelected: 'Žiadne vybraté' // None selected text
         },

         // general options
         selectAll: true, // add select all option
         minHeight: 200, // minimum height of option overlay
         maxHeight: null, // maximum height of option overlay
         maxWidth: null, // maximum width of option overlay (or selector)
         maxPlaceholderWidth: null, // maximum width of placeholder button
         maxPlaceholderOpts: 10, // maximum number of placeholder options to show until "# selected" shown instead
         showCheckbox: true, // display the checkbox to the user
         optionAttributes: [], // attributes to copy to the checkbox from the option element

     });
 }


 function findGetParameter(parameterName) {
   var result = null,
     tmp = [];
   location.search
     .substr(1)
     .split("&")
     .forEach(function (item) {
       tmp = item.split("=");
       if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
     });
   return result;
 }