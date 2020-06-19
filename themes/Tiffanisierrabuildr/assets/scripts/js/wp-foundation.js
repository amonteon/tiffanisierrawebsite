/*
These functions make sure WordPress
and Foundation play nice together.
*/
//(function($){})(jQuery);

var window = jQuery(window);
jQuery(document).ready(function($) {
	initOffCanvasSwitcher();	
	//calculateWidthofOffcanvasNav();
	initPreloaderScreen();
	initNavigation();
	//wrapNavElements();
	//initNavigationImgs();
	//initToggleProcedurePane();
	//initAdjustNavHeight();
	//initParallax();
	initJsEssentials();
	initCurtainOffCanvas();
//	initDebugin();
	initMobileExpandr();
	//initGalleries();
	//initTwentyTwenty();
	initGravityFormsStyles();
	openSpecialsBar();
	initBrowserExposure();
	backToTop();
	initSwiper();
	calculateHeightofNav();
});
var Foundation;
var Swiper;
// used to console log screen breakpoint changes while developing themes

jQuery(window).on('resize load', function(){
    initSwiperDestroy();        
});

var mySwiper = undefined;
function initSwiperDestroy() {
    var screenWidth = jQuery(window).width();   
            
    if((screenWidth <= 639 && mySwiper === undefined) ) {            
        jQuery('.swiper-container').each(function(){
            mySwiper = new Swiper(this, {            
                direction: 'horizontal',
				updateOnWindowResize: true,
				spaceBetween: 20,
				slidesPerView: 'auto',
				centeredSlides: true,
				grabCursor: true,
				roundLengths: true,
				scrollbar: {
				    el: '.swiper-scrollbar',
				    draggable: true,
				    hide: false,   
				    snapOnRelease: true,
				},
            })
        });            
    } else if (screenWidth >= 639 && mySwiper !== undefined && mySwiper !== null) {  
	    jQuery('.swiper-container').each(function(){          
			this.swiper.destroy();
			mySwiper = undefined;
		});   	   
    }   
 
      
}   

function initSwiper(){    
	jQuery('.hp-images-slider').each(function(){
           var logosSwiper = new Swiper(this, {            
                direction: 'horizontal',
				updateOnWindowResize: true,
				spaceBetween: 10,
				slidesPerView: 1.5,
				centeredSlides: true,
				grabCursor: true,
				roundLengths: true,
				initialSlide: 2,
				loop: false,

            })
		});  
		jQuery('.fp-image-card-slider').each(function(){
			var logosSwiper = new Swiper(this, {            
				 direction: 'horizontal',
				 updateOnWindowResize: true,
				 spaceBetween: 10,
				 slidesPerView: 2,
				 centeredSlides: true,
				 grabCursor: true,
				 roundLengths: true,
				 initialSlide: 1,
				 loop: false,
			 })
		 });   
        
    var screenWidth = jQuery(window).width();     
    jQuery('.mobile-swiper-container').each(function(){
        var swiperMobileNav = new Swiper(this, {            
            direction: 'horizontal',
			updateOnWindowResize: true,
			slidesPerView: 1.6,
			grabCursor: true,
			observer: true,
			spaceBetween: 10,
			scrollbar: {
			    el: '.mobile-swiper-scrollbar',
			    draggable: true,
			    hide: false,   
			    snapOnRelease: true,
			}, 
        })
    });

} 

function initDebugin() {
	var currentBreakpoint = Foundation.MediaQuery.current;
	//console.log('the current breakpoint is ' + currentBreakpoint);
	jQuery(window).resize(function() {
		var currentBreakpoint = Foundation.MediaQuery.current;
		
		if(currentBreakpoint == 'small' || currentBreakpoint == 'smedium'){
			//jQuery('.specialtySlide').addClass('fadeIn').removeClass('fadeOut');
		}
	});
}
function backToTop(){
	mybutton = document.getElementById("myBtn");

	// When the user scrolls down 400px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};
}	
function scrollFunction() {
	if(mybutton == true){
		if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}
}
function topFunction() {
  jQuery('html, body').animate({scrollTop:0}, '900');
  //document.documentElement.animate({scrollTop:0}, '300');
}

function initGravityFormsStyles() {	
	
	initGformValidationJs();	
		
	jQuery(document).on('gform_post_render', function(){	  	
	   	jQuery('.gform_wrapper input, .gform_wrapper textarea').each(function( index ) {
		  var theFields = jQuery(this).val();
		   	if(theFields){	 
			   	jQuery(this).closest('.ginput_container').addClass('typing validated');
			   	jQuery(this).closest('.ginput_container').siblings('.gfield_label').addClass('highlight');
		   	}
		   	initGformValidationJs();		  
		})   	
	});	
}

function initGformValidationJs() {
		
	jQuery('.gform_wrapper input, .gform_wrapper textarea').focus(function() {
		jQuery(this).closest('.ginput_container').addClass('typing');
		jQuery(this).closest('.ginput_container').siblings('label.gfield_label').addClass('highlight');
		//jQuery(this).closest('.gfield_description.validation_message').css("display","none");
	})
	
	//When the user clicks out of a field
	jQuery('.gform_wrapper .gfield, .gform_wrapper input, .gform_wrapper textarea, .gform_wrapper select').blur(function() {
		//The typing class is removed
		var textValue= jQuery(this).val();
		
		if(textValue != "") {
			jQuery(this).closest('.ginput_container').addClass('validated');
			jQuery(this).closest('.ginput_container').siblings('label.gfield_label').addClass('validated');	
			jQuery(this).closest('.ginput_container').siblings('label.gfield_label').removeClass('highlight');	
			jQuery(this).closest('.ginput_container').siblings('.gfield_description').addClass('validated');	
			jQuery(this).addClass('validated');				 
		 }  else {
			jQuery(this).closest('.ginput_container').removeClass('typing');
			jQuery(this).closest('.ginput_container').removeClass('validated');	
			jQuery(this).closest('.ginput_container').siblings('label.gfield_label').removeClass('highlight');
			
		 }				
	})	

}


var currentTransition = "",
currentPosition = "";

function initOffCanvasSwitcher() {

	jQuery(window).on("load",function(e){
		var newSize = Foundation.MediaQuery.current;		
		setOffcanvasPosition(newSize);		
	});	
		
	jQuery(window).on('changed.zf.mediaquery', function(event, newSize, oldSize) {
		// newSize is the name of the now-current breakpoint, oldSize is the previous breakpoint		 
		setOffcanvasPosition(newSize);		  
	});
	
	function setOffcanvasPosition(newSize) {		
		var mobileOffcanvas = jQuery('#off-canvas').data("mobile").split(" "),
		tabletOffcanvas = jQuery('#off-canvas').data("tablet").split(" "),
		offCanvas = jQuery('#off-canvas');
				
		if(newSize == 'xmedium' || newSize == 'medium'){		
			offCanvas.removeClass("position-"+mobileOffcanvas[0]).addClass("position-"+tabletOffcanvas[0]);
			offCanvas.removeClass("is-transition-"+mobileOffcanvas[1]).attr("data-transition", tabletOffcanvas[1]).addClass("is-transition-"+tabletOffcanvas[1]);			
			currentPosition = tabletOffcanvas[0];	
			currentTransition = tabletOffcanvas[1];					
		} 
		
		if(newSize == 'smedium' || newSize == 'small' || newSize == 'xsmall'){		
			offCanvas.removeClass("position-"+tabletOffcanvas[0]).addClass("position-"+mobileOffcanvas[0]);	
			offCanvas.removeClass("is-transition-"+tabletOffcanvas[1]).attr("data-transition", mobileOffcanvas[1]).addClass("is-transition-"+mobileOffcanvas[1]);			
			currentPosition	 = mobileOffcanvas[0];
			currentTransition = mobileOffcanvas[1];					
		}  
	}
		
	// ADDS class name to the body tag to disable scrolling when the offcanvas menu is open and adding transition and positioning class names
	jQuery('#off-canvas-phone').on('opened.zf.offCanvas', function () {
	    jQuery("body").addClass('offCanvasOpen');
	    var navFixedState = Foundation.MediaQuery.is('xmedium down'),		
		hasIsAnchored = jQuery('.sticky-wrapper-navigation').hasClass('is-anchored');
		
        if(navFixedState && hasIsAnchored ){ jQuery('.sticky-wrapper-navigation').removeClass('is-anchored').addClass('is-stuck');} 
	});
	jQuery('#off-canvas').on('opened.zf.offCanvas', function () {
        jQuery("body").addClass('offCanvasOpen');
		var navFixedState = Foundation.MediaQuery.is('xmedium down'),		
		hasIsAnchored = jQuery('.sticky-wrapper-navigation').hasClass('is-anchored');
		
        if(navFixedState && hasIsAnchored ){ jQuery('.sticky-wrapper-navigation').removeClass('is-anchored').addClass('is-stuck');}    
	
		jQuery(".hamburger").addClass("is-active");             
        jQuery('.off-canvas-content').removeClass('is-opened is-open-left has-position-left has-transition-push has-transition-overlap').addClass('is-opened is-open-'+currentPosition+' has-position-'+currentPosition+' has-transition-'+currentTransition);   		
    });
   
    jQuery('#off-canvas').on('close.zf.offCanvas', function () {
	    // Look for .hamburger
		jQuery(".hamburger").removeClass("is-active");
        jQuery("body").removeClass('offCanvasOpen');
        jQuery('.off-canvas-content').removeClass('is-opened is-open-'+currentPosition+' has-position-'+currentPosition);  
    });
    jQuery('#off-canvas-phone').on('close.zf.offCanvas', function () {
	    jQuery("body").removeClass('offCanvasOpen');
	    
	});
}

function calculateHeightofNav(){ 
	jQuery(window).on('load event click', function() {  	    	
	    var navHeight = jQuery('.sticky-nav-data-container').height(); 
	    Foundation.SmoothScroll.defaults.offset = navHeight;

	    jQuery('#off-canvas').css({
				'top': navHeight, 
		});
		jQuery('.phone-offcanvas').css({
				'top': navHeight, 
		});
	});  

}

function initTwentyTwenty(){
	jQuery(window).on('load', function() { 
	  jQuery("#twentytwenty-container").twentytwenty({ default_offset_pct:0.5 });
	});
}

function openSpecialsBar() {
    if ( localStorage.getItem('seen') != (new Date()).getDate()) {
        setTimeout(showpanel, 3000);
    }
}

function showpanel() {
   //// jQuery('#hello-bar').foundation('open');
    jQuery('#hello-bar').css('display', 'flex');
    jQuery('html').addClass('hello-bar-open');
    jQuery('#hello-bar').on('closed.zf.reveal', function () {
        jQuery('html').removeClass('hello-bar-open');
        jQuery('#hello-bar').css('display', 'none');
      });
    localStorage.setItem('seen', (new Date()).getDate());
}

function initGalleries(){
	jQuery('.imgGalItem').click(function(event) {
			
		var selector = jQuery(this),
			link = selector.attr('data-link'),
			rel  = selector.attr('rel'),
			height = selector.attr('height'),
			width = selector.attr('width'),
			counts = selector.attr('data-groups'),			
			newContent = '<a href="'+link+'" rel="galSlideCell'+rel+'" data-fancybox="group'+counts+'" data-caption="*Individual Results May Vary"><img src="'+link+'" height="+height+" width="+width+"></a>',
			containerHeight = jQuery(".galSlideCell"+rel+" .main-gal-img a").height();		
		
		jQuery(".photoGallery"+rel).removeClass("is-active");
		selector.addClass("is-active");		
			
		jQuery(".galSlideCell"+rel+" .main-gal-img").stop().css({'opacity':'0' , 'height':containerHeight+'px'}).html(function () {				
		 		return newContent;
		    }).animate({
		        opacity: 1
		    },500);	
		    
		setTimeout(function(){jQuery(".galSlideCell"+rel+" .main-gal-img").css('height','auto'); }, 500); 		
		event.preventDefault();	
		return false;
	});	

	jQuery('select#mobile-sorting').on('change', function() {
	  window.location.replace(this.value);
	});
	
}


$funcMobile = true;
$funcDesk = true;

function initMobileExpandr() {
	var expandTar = jQuery('.mobileExpand'),
		ehmax = '',
		expandTarBtn = '<a class="expandBtn"><span class="showMe">Click to Expand <i class="rotateMe none fal fa-arrow-circle-down" aria-hidden="true"></i></span><span class="hideMe">Click to Collapse <i class="rotateMe none fal fa-arrow-circle-up" aria-hidden="true"></i></span></a>';
	
	expandTar.wrapInner('<div class="expandrContent grid-x"></div>');
	expandTar.prepend(expandTarBtn);

	jQuery('.expandrContent').each( function(){
		ehmax = jQuery(this).parent().data('eh-max');
		jQuery(this).find('.expandrContent').css('max-height', ehmax);		
		jQuery(this).css('max-height', ehmax );
	});
	
	jQuery('.expandBtn').on('click', function(){
		jQuery(this).find('.rotateMe').toggleClass('none down');
		jQuery(this).find('span').toggleClass('showMe hideMe');
		jQuery(this).parent().find('.expandrContent').toggleClass('expanded');
		jQuery(this).toggleClass('expanded');	
	});
	

		
}

function initCurtainOffCanvas() {
	jQuery('[data-curtain-menu-button]').click(function(){
		jQuery('body').toggleClass('curtain-menu-open');
	})
}

function initParallax(){	
    jQuery(window).on('load scroll', function () {
		var scrolled =  jQuery(this).scrollTop(),
			xpos = 50,
			ypos = 50,
			bgsize = 'cover',
			scrollBottom = jQuery(this).scrollTop() + jQuery(this).height();      	
    	
    	jQuery('.tagline').each(function(){  
	    	var selectors = jQuery(this);
	    	var theBottom = selectors.position().top + selectors.outerHeight(true);	
	    	if(scrolled <= theBottom) {
	    		jQuery('.tagline').css({
	        		'transform': 'translate3d(0, ' + -(scrolled * 0.25) + 'px, 0)', 
					'opacity': 1 - scrolled / 400 // fade out at 400px from top
	    		}); 
	    	}    	  
     	});
        	
        /* Uses the default class name 'banner-parallax' on the frontpage banner, use data-speed="0.2"(20% scroll rate use decimals)  */                
        jQuery('.banner-parallax').each(function(){ 
	        	var speed = jQuery(this).attr('data-speed');
	        	var position = jQuery(this);
	        	var bottom = position.position().top + position.outerHeight(true);	  		        	
	        
	        	if(scrolled <= bottom) {	
	        		jQuery(this).css('transform', 'translate3d(0, ' + (scrolled  * speed) + 'px, 0)');
	        	}        	     	
        });
        
      
       	/* Use the class name 'parallax', use data-speed="0.2"(20% scroll rate use decimals)  */
	   	jQuery('.parallax').each(function(){ 
        	var speed = jQuery(this).attr('data-speed'),
        		xposval = jQuery(this).attr('data-xpos'),
        		yposval = jQuery(this).attr('data-ypos'),
        		bgsizeval = jQuery(this).attr('data-bg-size'),
        		parent = jQuery(this).parent(),
        		position = parent.position(),
        		bottom = parent.position().top + parent.outerHeight(true);
			if (xposval) {
	        	xpos = xposval;
        	}
        	if (yposval){
	        	ypos = yposval;
        	} 
        	if (bgsizeval){
	        	bgsize = bgsizeval;
        	}
        	if(!speed){ speed = 0.15; }
			if(scrolled <= bottom && scrollBottom > position.top ) {        		        	
        		jQuery(this).css({
	        		'background-position': xpos + '% calc(' + ypos +'% + ' + ((scrolled  - position.top ) * speed) + 'px)',
	        		'background-size': bgsize
	        	});         		
        	}	        	      	
        });        
    });	    
}

function initJsEssentials() {
	    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

	// Adds Flex Video to YouTube and Vimeo Embeds
	jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
		if ( jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5 ) {
		  jQuery(this).wrap("<div class='widescreen responsive-embed'/>");
		} else {
		  jQuery(this).wrap("<div class='responsive-embed'/>");
		}
	});

	jQuery('.floating-contact-form .grid-x-wrapper').removeClass('grid-x-wrapper').find('.gform_body .gform_fields').addClass("grid-x grid-padding-x");
	jQuery('.floating-contact-form .gfield.hidden_label .gfield_label').remove();
		
	jQuery(document).on('gform_post_render', function(){	
	    jQuery('.floating-contact-form .gform_wrapper').find('.gform_body .gform_fields').addClass("grid-x grid-padding-x");
	});

	jQuery('.main .grid-x-wrapper').removeClass('grid-x-wrapper').find('.gform_body .gform_fields').addClass("grid-x grid-padding-x");
	jQuery('.main .gfield.hidden_label .gfield_label').remove();
		
	jQuery(document).on('gform_post_render', function(){	
	    jQuery('.main .gform_wrapper').find('.gform_body .gform_fields').addClass("grid-x grid-padding-x");
	});
	

	
	jQuery('.stars').html( "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>" );
	
	// This fixes the flash bug on the navigation
	jQuery('.lower-bar').removeClass('wait-js');
	jQuery('.sticky-wrapper-navigation').removeClass('wait-js');
	
	
	// MAKE SCROLLING ON IE SMOOTHER (ENABLE IF NEEDED)
/* if(navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/12\./)) {
        jQuery('body').on("mousewheel", function (event) {
            event.preventDefault();
            var wd = event.wheelDelta;
            var csp = window.pageYOffset;
            window.scrollTo(0, csp - wd);
        });
    } */
	
}

function initPreloaderScreen() {
	setTimeout(function(){
		jQuery('.home #loader').addClass('animated zoomOut');		
	}, 1000);
	setTimeout(function(){		
		jQuery('.home #loader-wrapper').fadeOut('slow');	
		jQuery('.home .off-canvas-wrapper').css('opacity', 1);
	}, 1550);
	initSubmenus();
}

function initSubmenus() {
	jQuery('.top-bar #menu-topnav-1').css('opacity',1);	
	setTimeout(function(){
		jQuery('.top-bar .fixedlogo').css('display','block').addClass('animated fadeInLeft');
	}, 800);	
}

function initNavigation() {
	jQuery('.sticky-wrapper-navigation').on('sticky.zf.stuckto:top', function(){
	  	jQuery(this).addClass('shrink');
	}).on('sticky.zf.unstuckfrom:top', function(){
	  	jQuery(this).removeClass('shrink');
	})
    
}

function initNavigationImgs() {
	
	jQuery('#menu-the-main-menu .menu-item a .background-image-container').each(function() {      
	        let imageUrl = jQuery(this).attr('data-image');
	        jQuery(this).closest('li.menu-item').css('background-image', 'url("'+imageUrl+'")').addClass('with-bg-img-container');   
	        jQuery(this).remove();  
       
        
    });
}

function initToggleProcedurePane(){
	
	var closeButton = jQuery('.procedures-dropdown-pane button#close-menu');
	var dropdownPane = jQuery('.procedures-dropdown-pane');
	jQuery(closeButton).on('click', function() {
		//jQuery('.procedures-dropdown-container').toggleClass('menu-visibility');
		jQuery(this).parent().toggleClass('is-open');
		
		jQuery('html, body').css({overflow: 'auto'});
	
	});
	
	
	
		dropdownPane.on('show.zf.dropdown', function () {
			jQuery('html, body').css({overflow: 'hidden'});
		});
		dropdownPane.on('hide.zf.dropdown', function () {
			jQuery('html, body').css({overflow: 'auto'});
		});
}


var navigator;
var DocumentTouch;

//	Animations v1.1, Joe Mottershaw (hellojd)
//	https://github.com/hellojd/animations / https://github.com/Sananes/animations

//	==================================================

//	Visible, Sam Sehnert, samatdf, TeamDF
//	https://github.com/teamdf/jquery-visible/
//	==================================================

	(function($){
		$.fn.visible = function(partial,hidden,direction) {
			var $t				= jQuery(this).eq(0),
				t				= $t.get(0),
				$w				= jQuery(window),
				viewTop			= $w.scrollTop(),
				viewBottom		= viewTop + $w.height(),
				viewLeft		= $w.scrollLeft(),
				viewRight		= viewLeft + $w.width(),
				_top			= $t.offset().top,
				_bottom			= _top + $t.height(),
				_left			= $t.offset().left,
				_right			= _left + $t.width(),
				compareTop		= partial === true ? _bottom : _top,
				compareBottom	= partial === true ? _top : _bottom,
				compareLeft		= partial === true ? _right : _left,
				compareRight	= partial === true ? _left : _right,
				clientSize		= hidden === true ? t.offsetWidth * t.offsetHeight : true;
				direction		= (direction) ? direction : 'both';

			if(direction === 'both')
				return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop)) && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
			else if(direction === 'vertical')
				return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop));
			else if(direction === 'horizontal')
				return !!clientSize && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
		};
		

		$.fn.fireAnimations = function(options) {
			function animate() {
				if (jQuery(window).width() >= 960) {
					jQuery('.animate').each(function(i, elem) {
							elem = jQuery(elem);
							var	type = jQuery(this).attr('data-anim-type'),
							delay = jQuery(this).attr('data-anim-delay');

						if (elem.visible(true)) {
							setTimeout(function() {
								elem.addClass(type);
							}, delay);
						} 
					});
				} else {
					jQuery('.animate').each(function(i, elem) {
							elem = jQuery(elem);
						var	type = jQuery(this).attr('data-anim-type'),
							delay = jQuery(this).attr('data-anim-delay');

							setTimeout(function() {
								elem.addClass(type);
							}, delay);
					});
				}
			}

			jQuery(document).ready(function() {
				jQuery('html').removeClass('no-js').addClass('js');

				animate();
			});

			jQuery(window).scroll(function() {
				animate();

				if (jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height()) {
					animate();
				}
			});
		};

		jQuery('.animate').fireAnimations();

	})(jQuery);
		
	var	triggerClasses = 'flash strobe shake bounce tada wave spin pullback wobble pulse pulsate heartbeat panic explode';
		
	var	classesArray = [];
		classesArray = triggerClasses.split(' ');

	var	classAmount = classesArray.length;
	var type;
	
	function randomClass() {
		var	random = Math.ceil(Math.random() * classAmount);

		type = classesArray[random];

		return type;
	}

	function triggerOnce(target, type) {
		if (type == 'random') {
			type = randomClass();
		}

		jQuery(target).removeClass('trigger infinite ' + triggerClasses).addClass('trigger').addClass(type).one('webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend', function() {
			jQuery(this).removeClass('trigger infinite ' + triggerClasses);
		});
	}

	function triggerInfinite(target, type) {
		if (type == 'random') {
			type = randomClass();
		}

		jQuery(target).removeClass('trigger infinite ' + triggerClasses).addClass('trigger infinite').addClass(type).one('webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend', function() {
			jQuery(this).removeClass('trigger infinite ' + triggerClasses);
		});
	}

/*	jQuery(window).resize(function() {
		jQuery('.animate').fireAnimations();
	});
*/

function initBrowserExposure() {
	 // {{{ win-safari hacks, scratch this,
  // let's just expose platform/browser to css
  (function($)
  {
    var uaMatch = '', prefix = '';

    if (navigator.userAgent.match(/Windows/))
    {
      jQuery('html').addClass('windows');
    }
    else if (navigator.userAgent.match(/Mac OS X/))
    {
      jQuery('html').addClass('macOs');
    }
    else if (navigator.userAgent.match(/X11/))
    {
      jQuery('html').addClass('x11');
    }

	var supports = (function() {
    var d = document.documentElement,
        c = "ontouchstart" in window || navigator.msMaxTouchPoints;
    if (c) {
        d.className += " touch";
        return {
            touch: true
        }
    } else {
        d.className += " no-touch";
        return {
            touch: false
        }
    }
	})();

    // browser
    if (navigator.userAgent.match(/Chrome/))
    {
      uaMatch = ' Chrome/';
      prefix = 'chrome';
    }
    else if (navigator.userAgent.match(/Safari/))
    {
      uaMatch = ' Version/';
      prefix = 'safari';
    }
    else if (navigator.userAgent.match(/Firefox/))
    {
      uaMatch = ' Firefox/';
      prefix = 'firefox';
    }
    else if (navigator.userAgent.match(/MSIE/))
    {
      uaMatch = ' MSIE ';
      prefix = 'x-msie';
    }
    // add result preifx as browser class
    if (prefix)
    {
      jQuery('html').addClass(prefix);

      // get major and minor versions
      // reduce, reuse, recycle
      uaMatch = new RegExp(uaMatch+'(\\d+)\.(\\d+)');
      var uaMatch1 = navigator.userAgent.match(uaMatch);
      if (uaMatch && uaMatch1[1])
      {
        // set major only version
        jQuery('html').addClass(prefix+'-'+uaMatch[1]);
        // set major + minor versions
        jQuery('html').addClass(prefix+'-'+uaMatch[1]+'-'+uaMatch[2]);
      }
    }
  })(jQuery);
  // }}}
}

// Get IE or Edge browser version
var version = detectIE();

if (version === false) {
  jQuery('html').addClass('not-ie-edge');
} else if (version >= 12) {
   jQuery('html').addClass('edge edge-'+ version);
} else {
   jQuery('html').addClass('ie ie-'+ version);
}

// add details to debug result
//document.getElementById('details').innerHTML = window.navigator.userAgent;

/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
  var ua = window.navigator.userAgent;

  // Test values; Uncomment to check result …

  // IE 10
  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
  
  // IE 11
  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
  
  // Edge 12 (Spartan)
  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';
  
  // Edge 13
  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}

