$(function ($) {
  $.fn.responsivenav = function (args) {
    // Default settings
    var defaults = {
      responsive: true,
      width: 768, // Responsive width
      button: $(this).attr("id") + "-button", // Menu button id
      animation: {
        // Menu animation
        effect: "slide", // Accepts 'slide' or 'fade'
        show: 150,
        hide: 100,
      },
      selected: "selected", // Selected class
      arrow: "downarrow", // Dropdown arrow class
    };
    var settings = $.extend(defaults, args);

    // Initialize the menu and the button
    init($(this).attr("id"), settings.button);

    function init(menuid, buttonid) {
      setupMenu(menuid, buttonid);
      // Add a handler function for the resize and orientationchange event
      $(window).bind("resize orientationchange", function () {
        resizeMenu(menuid, buttonid);
      });
      // Trigger initial resize
      resizeMenu(menuid, buttonid);
    }

    function setupMenu(menuid, buttonid) {
      var $mainmenu = $("#" + menuid + ">ul");

      var $headers = $mainmenu.find("ul").parent();
      // Add dropdown arrows
      $headers.each(function (i) {
        var $curobj = $(this);
        $curobj
          .children("a:eq(0)")
          .append('<span class="' + settings.arrow + '"></span>');
      });

      if (settings.responsive) {
        // Menu button click event
        // Displays top-level menu items
        $("#" + buttonid).click(function (e) {
          e.preventDefault();

          if (isSelected($("#" + buttonid))) {
            // Close menu
            collapseChildren("#" + menuid);
            animateHide($("#" + menuid), $("#" + buttonid));
          } else {
            // Open menu
            animateShow($("#" + menuid), $("#" + buttonid));
          }
        });
      }
    }

    function resizeMenu(menuid, buttonid) {
      var $ww = document.body.clientWidth;

      // Add mobile class to elements for CSS use
      // instead of relying on media-query support
      if ($ww > settings.width || !settings.responsive) {
        $("#" + menuid).removeClass("mobile");
        $("#" + buttonid).removeClass("mobile");
      } else {
        $("#" + menuid).addClass("mobile");
        $("#" + buttonid).addClass("mobile");
      }

      var $headers = $("#" + menuid + ">ul")
        .find("ul")
        .parent();

      $headers.each(function (i) {
        var $curobj = $(this);
        var $link = $curobj.children("a:eq(0)");
        var $subul = $curobj.find("ul:eq(0)");

        // Unbind events
        $curobj.unbind("mouseenter mouseleave");
        $link.unbind("click");
        animateHide($curobj.children("ul:eq(0)"));

        if ($ww > settings.width || !settings.responsive) {
          // Full menu
          $curobj.hover(
            function (e) {
              var $targetul = $(this).children("ul:eq(0)");

              var $dims = {
                w: this.offsetWidth,
                h: this.offsetHeight,
                subulw: $subul.outerWidth(),
                subulh: $subul.outerHeight(),
              };
              var $istopheader =
                $curobj.parents("ul").length == 1 ? true : false;
              $subul.css(
                $istopheader
                  ? {}
                  : {
                      top: 0,
                    }
              );
              var $offsets = {
                left: $(this).offset().left,
                top: $(this).offset().top,
              };
              var $menuleft = $istopheader ? 0 : $dims.w;
              $menuleft =
                $offsets.left + $menuleft + $dims.subulw > $(window).width()
                  ? $istopheader
                    ? -$dims.subulw + $dims.w
                    : -$dims.w
                  : $menuleft;
              $targetul.css({
                left: $menuleft + "px",
                width: $dims.subulw + "px",
              });

              animateShow($targetul);
            },
            function (e) {
              var $targetul = $(this).children("ul:eq(0)");
              animateHide($targetul);
            }
          );
        } else {
          // Compact menu
          $link.click(function (e) {
            e.preventDefault();

            var $targetul = $curobj.children("ul:eq(0)");
            if (isSelected($curobj)) {
              collapseChildren($targetul);
              animateHide($targetul);
            } else {
              //collapseSiblings($curobj);
              animateShow($targetul);
            }
          });
        }
      });

      collapseChildren("#" + menuid);

      if (settings.responsive && isSelected($("#" + buttonid))) {
        //collapseChildren('#'+menuid);
        $("#" + menuid).hide();
        $("#" + menuid).removeAttr("style");
        $("#" + buttonid).removeClass(settings.selected);
      }
    }

    function collapseChildren(elementid) {
      // Closes all submenus of the specified element
      var $headers = $(elementid).find("ul");
      $headers.each(function (i) {
        if (isSelected($(this).parent())) {
          animateHide($(this));
        }
      });
    }

    function collapseSiblings(element) {
      var $siblings = element.siblings("li");
      $siblings.each(function (i) {
        collapseChildren($(this));
      });
    }

    function isSelected(element) {
      return element.hasClass(settings.selected);
    }

    function animateShow(menu, button) {
      if (!button) {
        var button = menu.parent();
      }

      button.addClass(settings.selected);

      if (settings.animation.effect == "fade") {
        menu.fadeIn(settings.animation.show);
      } else if (settings.animation.effect == "slide") {
        menu.slideDown(settings.animation.show);
      } else {
        menu.show();
        menu.removeClass("hide");
      }
    }

    function animateHide(menu, button) {
      if (!button) {
        var button = menu.parent();
      }

      if (settings.animation.effect == "fade") {
        menu.fadeOut(settings.animation.hide, function () {
          menu.removeAttr("style");
          button.removeClass(settings.selected);
        });
      } else if (settings.animation.effect == "slide") {
        menu.slideUp(settings.animation.hide, function () {
          menu.removeAttr("style");
          button.removeClass(settings.selected);
        });
      } else {
        menu.hide();
        menu.addClass("hide");
        menu.removeAttr("style");
        button.removeClass(settings.selected);
      }
    }
  };
});
$(function ($) {
  $("#primary-nav").responsivenav();
  $("#top-nav").responsivenav({
    responsive: false,
  });
});

$("#primary-nav-button").click(function () {
  $(".header-mobile").toggleClass("show-menu");
});




$(".click-search").click(function(){
  $(".nav-click-search").toggleClass("active");
});
// ?jquery mobile
(function($) {
  var $main_nav = $('#main-nav');
  var $toggle = $('.toggle');

  var defaultData = {
    maxWidth: false,
    customToggle: $toggle,
    // navTitle: 'All Categories',
    levelTitles: true,
    pushContent: '#container'
  };

  // add new items to original nav
  $main_nav.find('li.add').children('a').on('click', function() {
    var $this = $(this);
    var $li = $this.parent();
    var items = eval('(' + $this.attr('data-add') + ')');

    $li.before('<li class="new"><a>'+items[0]+'</a></li>');

    items.shift();

    if (!items.length) {
      $li.remove();
    }
    else {
      $this.attr('data-add', JSON.stringify(items));
    }

    Nav.update(true);
  });

  // call our plugin
  var Nav = $main_nav.hcOffcanvasNav(defaultData);

  // demo settings update

  const update = (settings) => {
    if (Nav.isOpen()) {
      Nav.on('close.once', function() {
        Nav.update(settings);
        Nav.open();
      });

      Nav.close();
    }
    else {
      Nav.update(settings);
    }
  };

  $('.actions').find('a').on('click', function(e) {
    e.preventDefault();

    var $this = $(this).addClass('active');
    var $siblings = $this.parent().siblings().children('a').removeClass('active');
    var settings = eval('(' + $this.data('demo') + ')');

    update(settings);
  });

  $('.actions').find('input').on('change', function() {
    var $this = $(this);
    var settings = eval('(' + $this.data('demo') + ')');

    if ($this.is(':checked')) {
      update(settings);
    }
    else {
      var removeData = {};
      $.each(settings, function(index, value) {
        removeData[index] = false;
      });

      update(removeData);
    }
  });
})(jQuery);



$(".click-cart").click(function () {
  $(".nav-cart-sum").slideToggle();
});
/*js home slider banner*/
$(".slider-home").owlCarousel({
  loop: true,
  margin: 0,
  dots: false,
  nav: true,
  autoplay: true,
  autoplayTimeout: 5000,
  autoplaySpeed: 1500,

  navText: [
    '<i class="fa fa-chevron-left"></i>',
    '<i class="fa fa-chevron-right"></i>',
  ],
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 1,
    },
    1000: {
      items: 1,
    },
  },
});

$("a.btn-support").click(function (e) {
  e.stopPropagation();
  $(".support-content").slideToggle();
});
$(".support-content").click(function (e) {
  e.stopPropagation();
});
$(document).click(function () {
  $(".support-content").slideUp();
});

$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() != 0) {
      $("#scrollUp").fadeIn();
    } else {
      $("#scrollUp").fadeOut();
    }
  });
  $("#scrollUp").click(function () {
    $("body,html").animate({ scrollTop: 0 }, 800);
  });
});
$(".slider-product").owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  navText: [
    '<i class="fa fa-chevron-left"></i>',
    '<i class="fa fa-chevron-right"></i>',
  ],
  items: 5,
  responsive: {
    0: {
      items: 2,
      margin: 10,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 5,
    },
  },
});



$('.read-more').click(function() {
  $(this).prev().slideToggle();
  if (($(this).text()) == "Xem thêm") {
      $(this).text("Thu gọn");
  } else {
      $(this).text("Xem thêm");
  }
});




$(document).ready(function () {
  $("ul.tabs li").click(function () {
    var tab_id = $(this).attr("data-tab");

    $("ul.tabs li").removeClass("current");
    $(".tab-content").removeClass("current");

    $(this).addClass("current");
    $("#" + tab_id).addClass("current");
  });
});

$(".slider-raleted-product").owlCarousel({
  loop: true,
  margin: 20,
  nav: true,
  dots: false,
  navText: [
    '<i class="fa fa-chevron-left"></i>',
    '<i class="fa fa-chevron-right"></i>',
  ],
  responsive: {
    0: {
      items: 2,
      margin: 10,
    },
    600: {
      items: 3,
      margin: 10,
    },
    1000: {
      items: 4,
    },
  },
});


$('.slider-new').owlCarousel({
  loop:true,
  margin:30,
  navText: [
    '<i class="fa fa-chevron-left"></i>',
    '<i class="fa fa-chevron-right"></i>',
  ],
  nav:true,
  dots:false,
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
});

$(".top-header").sticky({topSpacing:0});





// Quick & dirty toggle to demonstrate modal toggle behavior
$('.modal-toggle').on('click', function(e) {
  e.preventDefault();
  $('.modal').toggleClass('is-visible');
});

$('.slider-partner-2').owlCarousel({
  loop:false,
  margin:20,
  nav:true,
  navText: [
    '<i class="fa fa-chevron-left"></i>',
    '<i class="fa fa-chevron-right"></i>',
  ],
  responsive:{
      0:{
          items:2,
          margin:10,
      },
      600:{
          items:3
      },
      1000:{
          items:6
      }
  }
});


// Start marquee
$('.marquee_text').marquee({
  direction: 'left',
  duration: 50000,
  gap: 50,
  delayBeforeStart: 0,
  duplicated: true,
  startVisible: true
});
