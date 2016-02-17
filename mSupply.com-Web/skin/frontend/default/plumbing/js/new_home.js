jQuery(document).ready(function() {
    jQuery('.lazyload').bind('appear', load);
    /*Navigation*/
    jQuery(".category-list1").flexymenu({
        speed: 400,
        type: "vertical"
    });
	
	/*Menu Related JS*/
	jQuery(".category-list li a.main-nav,.category-list1 li a.main-nav1").mouseout(function() {
    jQuery(this).children().children("img").trigger("onmouseout");
  })
  if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
    jQuery(".category-list > li.showhide span.icon").click(function() {
      jQuery(".category-list li:not('.showhide'),.coming-soon li,.google-block").toggleClass("show")
    });
  }
 

  function isTouchDevice() {
    return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
  }
  if (isTouchDevice() === true) {
    if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
      jQuery(".subNavLevel1").children().children().append("<i class='fa fa-angle-right mobile-dropdown'></i>")
      jQuery(".search-block").hide();
      jQuery(".search-icon").click(function() {
        var effect = 'slide';
        var duration = 1000;
        var options = {
          direction: 'up'
        };
        jQuery('.search-block').toggle(options, effect, duration);
      });
      jQuery("#showhide1").click(function() {
        var effect = 'slide';
        var duration = 100;
        jQuery('#menuBLock').toggle(effect, duration);
        jQuery('body').toggleClass("body_scroll");
        jQuery(".subNavLevel1").hide();
        jQuery(".fa-minus").hide();
        jQuery(".fa-plus").show();
      });
      jQuery('.category-list li a.main-nav,.category-list1 li  a.main-nav1').click(function() {
        jQuery(this).find(".fa-minus, .fa-plus").toggle();
        if (jQuery(this).parent().siblings().children().children(".fa-minus").is(":visible") == true) {
          jQuery(this).parent().siblings().children().children(".fa-minus").hide();
          jQuery(this).parent().siblings().children().children(".fa-plus").show();
        }
        jQuery(this).children().children("img").trigger("onmouseover");
        jQuery(this).parent().children("ul").children("li").children("a").css("background", "#f9f9f9");
        jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
      });
      jQuery(".category-list li ul li a,.category-list1 li ul li a").mouseover(function() {
        var el = jQuery(this);
        var link = el.attr('href');
        window.location = link;
        jQuery(this).parent().parent().parent().children().children().children("img").trigger("onmouseover");
      });
    } else {
      jQuery('.showhide1').on('click', function() {
        jQuery(".category-list1 li,.category-list1").toggleClass("show");
      });
      jQuery('.category-list li a.main-nav,.category-list1 li  a.main-nav1').on('click touchend', function() {
        jQuery(this).children().children("img").trigger("onmouseover");
        jQuery(this).parent().children("ul").children("li").children("a").css("color", "#444");
        jQuery(this).parent().children("ul").children("li:first-child").children("a").css("color", "#BD4931");
        jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
        jQuery(".category-list1 li.mainNav,.category-list1").addClass("show");
      });
      jQuery(".category-list li ul,.category-list1 li ul").mouseover(function() {
        jQuery(this).parent().children().children().children().trigger("onmouseover");
      });
      jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").hover(function() {
        jQuery(this).children("a").css("color", "#BD4931");
        jQuery(this).siblings().children("a").css("color", "#444");
        jQuery(this).siblings("li:first-child").children(".brand-list").hide()
      });
    }
  } else {
	jQuery("#menuBLock").mouseover(function() {
		jQuery("#showhide1").addClass("selected-area");
	  });
	  jQuery("#menuBLock").mouseout(function() {
		jQuery("#showhide1").removeClass("selected-area");
	});
    jQuery(".category-list li a.main-nav,.category-list1 li a.main-nav1").mouseover(function() {
      jQuery(this).children().children("img").trigger("onmouseover");
      jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
      jQuery(this).parent().children("ul").children("li").children("a").css("color", "#444");
      jQuery(this).parent().children("ul").children("li:first-child").children("a").css("color", "#BD4931");
    });
    jQuery(".category-list1").mouseout(function() {
      jQuery(".category-list1 li,.category-list1").removeClass("show")
    });
    jQuery(".category-list1,.subNavLevel1,.subNavLevel2,#showhide1").mouseover(function() {
      jQuery(".category-list1 li.mainNav,.category-list1").addClass("show");
    });
    jQuery(".category-list li ul,.category-list1 li ul").mouseover(function() {
      jQuery(this).parent().children().children().children().trigger("onmouseover");
      jQuery(this).children("li:first-child").children("ul").show();
      /*if(jQuery(this).children("li:first-child").children("a").css("background-color") == 	"rgb(246, 246, 246)"	){
				jQuery(this).children("li:first-child").children("a").css("background", "#fff");
			}*/
    });
    jQuery(".brand-list").mouseout(function() {
      if (jQuery(".category-list li ul").children("li:first-child").children("ul").css("display") == "block") {
        jQuery(this).siblings("li:first-child").children("a").css("color", "#BD4931");
      }
    });
    jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseout(function() {
      jQuery(this).children("a").css("color", "#444");
      jQuery(this).siblings("li:first-child").children("a").css("color", "#BD4931");
    });
    jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseover(function() {
      jQuery(this).children("a").css("color", "#BD4931");
      jQuery(this).siblings().children("a").css("color", "#444");
    });
  }
  jQuery(".category-list li ul,.category-list1 li ul").mouseout(function() {
    jQuery(this).parent().children().children().children().trigger("onmouseout");
  });
  jQuery("#mainLogo a").mouseenter(function() {
    jQuery(".category-list1 li,.category-list1").removeClass("show")
  });
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 100) {
      if (jQuery(window).width() >= 768) {
        jQuery(".cms-index-index  #inner_scroll_menu").css("visibility", "visible");
      }
      jQuery('.lnkScrollUp').fadeIn();
    } else {
      jQuery('.lnkScrollUp').fadeOut();
      if (jQuery(window).width() >= 768) {
        jQuery(".cms-index-index  #inner_scroll_menu").css("visibility", "hidden");
      }
    }
  });
	
	
	
	
    if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 47) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 47) + '...');
                }
            });
        });
    } else if (jQuery(window).width() <= 1050) {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 40) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 40) + '...');
                }
            });
        });
    } else {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 54) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 52) + '...');
                }
            });
        });
    }
    
    
});
/*Navigation End*/
/*Sub Section*/
jQuery(function() {
    var jQueryupper = jQuery('#upper');
    jQuery('#images').refineSlide({
        transition: 'fade',
        onInit: function() {
            var slider = this.slider,
                jQuerytriggers = jQuery('.translist').find('> li > a');
            jQuerytriggers.parent().find('a[href="#_' + this.slider.settings['transition'] + '"]').addClass('active');
            jQuerytriggers.on('click', function(e) {
                e.preventDefault();
                if (!jQuery(this).find('.unsupported').length) {
                    jQuerytriggers.removeClass('active');
                    jQuery(this).addClass('active');
                    slider.settings['transition'] = jQuery(this).attr('href').replace('#_', '');
                }
            });

            function support(result, bobble) {
                var phrase = '';
                if (!result) {
                    phrase = ' not';
                    jQueryupper.find('div.bobble-' + bobble).addClass('unsupported');
                    jQueryupper.find('div.bobble-js.bobble-css.unsupported').removeClass('bobble-css unsupported').text('JS');
                }
            }
            support(this.slider.cssTransforms3d, '3d');
            support(this.slider.cssTransitions, 'css');
        }
    });
    jQuery(".btn-toggle").click(function() {
        jQuery(this).parent().next().collapse('toggle');
    });
});

function load() {
    var element = jQuery(this);
    var comment = element.contents().filter(function() {
        return this.nodeType === 8;
    }).get(0);
    var newElement = jQuery(comment && comment.data);
    element.replaceWith(newElement);
    newElement.fadeOut(0, function() {
        newElement.fadeIn(1000);
    });
}
jQuery(function() {
    var jQueryels = jQuery('div.quote'),
        i = 0,
        len = jQueryels.length;
    jQueryels.slice(1).hide();
    setInterval(function() {
        jQueryels.eq(i).fadeOut(function() {
            i = (i + 1) % len
            jQueryels.eq(i).fadeIn();
        })
    }, 10000)
});
jQuery(function() {
    var jQueryels = jQuery('div.quote1'),
        i = 0,
        len = jQueryels.length;
    jQueryels.slice(1).hide();
    setInterval(function() {
        jQueryels.eq(i).fadeOut(function() {
            i = (i + 1) % len
            jQueryels.eq(i).fadeIn();
        })
    }, 10000)
});

function center(number) {
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for (var i in sync2visible) {
        if (num === sync2visible[i]) {
            var found = true;
        }
    }
    if (found === false) {
        if (num > sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", num - sync2visible.length + 2)
        } else {
            if (num - 1 === -1) {
                num = 0;
            }
            sync2.trigger("owl.goTo", num);
        }
    } else if (num === sync2visible[sync2visible.length - 1]) {
        sync2.trigger("owl.goTo", sync2visible[1])
    } else if (num === sync2visible[0]) {
        sync2.trigger("owl.goTo", num - 1)
    }
}

function syncPosition(el) {
        var current = this.currentItem;
        jQuery("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
        if (jQuery("#sync2").data("owlCarousel") !== undefined) {
            center(current)
        }
    }
