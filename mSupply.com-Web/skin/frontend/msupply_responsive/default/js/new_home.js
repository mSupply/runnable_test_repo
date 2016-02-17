 jQuery(document).ready(function() {
	var ua = navigator.userAgent.toLowerCase();
      if(ua.indexOf("safari/") !== -1 &&   ua.indexOf("windows") !== -1){
	  jQuery(".logo-svg").hide();
	  jQuery(".logo-svg1").show();
	}
  jQuery('#carousel-custom').carousel({
    pause: true,
    interval: false
  });
  jQuery(".category-list1").flexymenu({
    speed: 400,
    type: "vertical"
  });
  //Secondary Multi Select start
  jQuery(".dropdown-selection dt a").on('click', function() {
    jQuery(".dropdown-selection dd ul").slideToggle('fast');
  });
  jQuery(".dropdown-selection dd ul li a").on('click', function() {
    jQuery(".dropdown-selection dd ul").hide();
  });
  function getSelectedValue(id) {
    return jQuery("#" + id).find("dt a span.value").html();
  }
  jQuery(document).bind('click', function(e) {
    var clicked = jQuery(e.target);
    if (!clicked.parents().hasClass("dropdown-selection")) jQuery(".dropdown-selection dd ul").hide();
  });
  jQuery('.mutliSelect input[type="checkbox"]').on('click', function() {
    var selectedCount = jQuery(".mutliSelect [type='checkbox']:checked").length;
    var title = jQuery(this).closest('.mutliSelect').find('input[type="checkbox"]').data("val"),
      title = jQuery(this).data("val");
    //var resTitle = title.replace(/\s+/g, '-'); 
    if (jQuery(this).is(':checked')) {
      var html = '<span id="primary_select" title="' + title + '">' + title + '</span>';
      jQuery('.multiSel').append(html);
      jQuery(".hida").hide();
    } else {
      jQuery('span[title="' + title + '"]').remove();
      if (!jQuery(".mutliSelect ul li input").is(':checked')) {
        jQuery('.dropdown-selection dt a .hida').show();
      }
    }
    if (!jQuery('#Customer').is(":checked")) {
      jQuery('span[title="Customer"]').remove();
      if (!jQuery(".mutliSelect ul li input").is(':checked')) {
        jQuery('.dropdown-selection dt a .hida').show();
        jQuery('#secondary_select').val('');
      }
    }
  });
  //Secondary Multi Select end
  jQuery(".fa-minus").hide();
  jQuery('.lazyload').bind('appear', load);
  /*Navigation*/
  jQuery(".know_more_btn").click(function() {
    jQuery(".know_more input[type='text'], .know_more textarea").css("margin-top", "3px");
  });
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
	  jQuery(this).parent().children("ul").children("li:first-child").children("a").css("font-weight", "bold");
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
		jQuery(this).siblings("li:first-child").children("a").css("font-weight", "bold");
      }
    });
    jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseout(function() {
      jQuery(this).children("a").css("color", "#444");
	  jQuery(this).children("a").css("font-weight", "normal");
      jQuery(this).siblings("li:first-child").children("a").css("color", "#BD4931");
	   jQuery(this).siblings("li:first-child").children("a").css("font-weight", "bold");
    });
    jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseover(function() {
       jQuery(this).children("a").css("color", "#BD4931");
	   jQuery(this).children("a").css("font-weight", "bold");
       jQuery(this).siblings().children("a").css("color", "#444");
	   jQuery(this).siblings().children("a").css("font-weight", "normal");
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
  jQuery(".side-bar-filter").each(function() {
    if (jQuery(this).height() >= 300) {
      jQuery(this).css("height", "300px");
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
  jQuery('.lnkScrollUp').click(function() {
    jQuery("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
  jQuery('#myCarousel1, #myCarousel2, #myCarousel3').carousel({
    interval: 100000
  });
  jQuery('#homeSlideShow').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    autoPlay : true,
    autoplayTimeout: 1000,
    smartSpeed: 1000,
    items: 1,
    itemsDesktop: [1000, 1],
    itemsDesktopSmall: [900, 1],
    itemsTablet: [600, 1],
    itemsMobile: false
  });
  var owl = jQuery("#brandSlider");
  owl.owlCarousel({
    navigation: true,
    loop: true,
    items: 9,
    pagination: false,
    navigationText: ['<a class="left carousel-control previous controllers" data-slide="prev"><i class="fa fa-angle-left"></i></a>', '<a class="right carousel-control next controllers"  data-slide="next"><i class="fa fa-angle-right"></i></a>'],
    itemsDesktop: [1000, 9],
    itemsDesktopSmall: [900, 7],
    itemsTablet: [747, 2],	
	scrollPerPage : true,
    itemsMobile: false,
	slideSpeed:2000
  });
  /*Best Sellers sliders*/
  jQuery("#bathSlide,#electricalSlide,#blockSlide,#cementSlide,#plumbingSlide,#wallSlide,#kitchenSlide,#finishSlide,#recentlyViewSlide").owlCarousel({
    navigation: true,
    pagination: false,
    items: 5,
    navigationText: ['<a class="left carousel-control previous controllers"><i class="fa fa-angle-left"></i></a>', '<a class="right carousel-control next controllers" ><i class="fa fa-angle-right"></i></a>'],
    itemsDesktop: [1000, 5],
    itemsDesktopSmall: [900, 5],
    itemsTablet: [747, 3],
	scrollPerPage : true,
    itemsMobile: false,
    slideSpeed: 1000
  });
});
/*Navigation End*/
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
  /* for home page popup keypad of mobile START */
function detectmob() {
  if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
    return true;
  } else {
    return false;
  }
}
if (detectmob()) {
  jQuery('input.hmpopupinput').focus(function() {
    //alert("hghghg");
    jQuery('.homepagepopup .modal').css('position', 'relative');
  });
}
/* for home page popup keypad of mobile END */
/*Checkout Calculation */
function checkTheSelectedPaymentOption(ctrl) {
  jQuery("#p_method_" + ctrl).prop("checked", true);
  var charge = jQuery("#tab_payment" + ctrl).attr('charge');
  var subtot = jQuery("#tab_payment" + ctrl).attr('subtotal');
  var gtot = jQuery("#tab_payment" + ctrl).attr('gtotal');
  var selected_charge = jQuery("#tab_payment" + ctrl).attr('selectedmet');
  //var total_charge = (parseFloat(charge) + parseFloat(subtot)).toFixed(2);
  var total_charge = (Math.floor((parseFloat(charge) + parseFloat(subtot)) * 100) / 100).toFixed(2);
  var gtotal_charge = (parseFloat(charge) + parseFloat(gtot)).toFixed(2);
  var gtotal_charge = (parseFloat(gtotal_charge) - parseFloat(selected_charge)).toFixed(2);
  //alert(gtot+'--'+charge);
  jQuery('#pay_charge').text('₹' + total_charge);
  jQuery('#gtotal').text('₹' + gtotal_charge);
  jQuery('#cheque_total_amount').text('₹' + gtotal_charge);
  if (ctrl == "cashin") {
    var cashmintotal = jQuery("#tab_payment" + ctrl).attr('cashmintotal');
    if (parseInt(gtotal_charge) >= parseInt(cashmintotal)) {
      jQuery("#pan_block").show();
      jQuery("#payment_submit").attr("disable", false);
      jQuery("#payment_submit").bind('click');
      jQuery("#payment_submit").css({
        "opacity": "1"
      });
    } else {
      jQuery("#pan_block").hide();
      jQuery("#payment_submit").attr("disable", true);
      jQuery("#payment_submit").unbind('click');
      jQuery("#payment_submit").css({
        "opacity": "0.3"
      });
    }
  }
}

function loader(ctrl) {
  var dataForm = new VarienForm('co-payment-form', true);
  if (ctrl == "hdfc_standard" || ctrl == "neft" || ctrl == "hdfcdc_standard" || ctrl == "hdfcnb_standard" || ctrl == "cashin" || ctrl == "cashondelivery" || ctrl == "cheque_checkout" || ctrl == "payucheckout_shared") {
    jQuery("#edit_payment,#tick_payment").removeClass("edit_icon_hide");
  }
  if (dataForm.validator.validate()) {
    jQuery('.loader-pay' + ctrl).show();
    //fail pass validation
  }
}  
