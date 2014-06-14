function hide_preloader() {
	setTimeout(function() {
	jQuery(".body-image-preloader").fadeOut(200);
	jQuery("#body-preloader").fadeOut(1000);
	      // Do something after 5 seconds
	}, 1500);
	
}

function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function resizeVideo(){
	if(jQuery('.embedded_videos').length){
  		var iframe_width = jQuery('.embedded_videos').parent().width();
  		var_iframe_height = iframe_width/1.37;	
  		jQuery('.embedded_videos iframe ').each(function(){

  			jQuery(this).attr('width',iframe_width);
  			jQuery(this).attr('height',var_iframe_height);
  		});

  		jQuery('.embedded_videos div.video-js ').each(function(){

  			jQuery(this).attr('width',iframe_width);
  			jQuery(this).attr('height',var_iframe_height);
  			jQuery(this).css('width',iframe_width);
  			jQuery(this).css('height',var_iframe_height);
  		});
  		

  	}
}

	function init_toggle(){		
		/*toogle*/
		/*Case when by default the toggle is closed */
		jQuery(".open_title").toggle(function(){ 
				jQuery(this).next('div').slideDown();
				jQuery(this).find('a').removeClass('show');
				jQuery(this).find('a').addClass('toggle_close'); 
				jQuery(this).find('.title_closed').hide();
				jQuery(this).find('.title_open').show();
			}, function () {
			
				jQuery(this).next('div').slideUp();
				jQuery(this).find('a').removeClass('toggle_close');
				jQuery(this).find('a').addClass('show');		 
				jQuery(this).find('.title_open').hide();
				jQuery(this).find('.title_closed').show();
				
		});
		
		/*Case when by default the toggle is oppened */		
		jQuery(".close_title").toggle(function(){ 
				jQuery(this).next('div').slideUp();
				jQuery(this).find('a').removeClass('toggle_close');
				jQuery(this).find('a').addClass('show');		 
				jQuery(this).find('.title_open').hide();
				jQuery(this).find('.title_closed').show();
			}, function () {
				jQuery(this).next('div').slideDown();
				jQuery(this).find('a').removeClass('show');
				jQuery(this).find('a').addClass('toggle_close');
				jQuery(this).find('.title_closed').hide();
				jQuery(this).find('.title_open').show();
				
		});	
	}

	

jQuery(document).ready(function(){

	init_toggle();

  	/*resize FB comments depending on viewport*/

  	setTimeout('viewPort()',3000); 
  	
  	resizeVideo();

  	jQuery( window ).resize( function(){
       viewPort();
       resizeVideo();
    });

  	
	/* Accordion */
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	});
	
	//Superfish menu
	/*jQuery("ul.sf-menu").supersubs({
			minWidth:    12,
			maxWidth:    32,
			extraWidth:  1
		}).superfish({
			delay: 200,
			speed: 250
		});*/
		
	
	
	/* Hide Tooltip */
	jQuery(function() {
		jQuery('a.close').click(function() {
			jQuery(jQuery(this).attr('href')).slideUp();
            jQuery.cookie(cookies_prefix + "_tooltip" , 'closed' , {expires: 365, path: '/'});
            jQuery('.header-delimiter').removeClass('hidden');
			return false;
		});
	});
	
	/* initialize tabs */
	jQuery(function() { 
		jQuery('.cosmo-tabs').tabs({ fxFade: true, fxSpeed: 'fast' });
		jQuery( 'div.cosmo-tabs' ).not( '.submit' ).find( '.tabs-nav li:first-child a' ).click();
	});
	
	/* Hide title from menu items */
	jQuery(function(){
		jQuery("li.menu-item > a").hover(function(){
			jQuery(this).stop().attr('title', '');},
			function(){jQuery(this).stop().attr();
		});
		
		  
	});
	
	
	 /* widget tabber */
    jQuery( 'ul.widget_tabber li a' ).click(function(){
        jQuery(this).parent('li').parent('ul').find('li').removeClass('active');
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').fadeTo( 200 , 0 );
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').hide();
        jQuery( jQuery( this ).attr('href') + '_panel' ).fadeTo( 600 , 1 );
        jQuery( this ).parent('li').addClass('active');
    });
	

	/*Accordion*/
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	}); 
	
  /*Tweets widget*/
   var delay = 4000; //millisecond delay between cycles
   function cycleThru(variable, j){
           var jmax = jQuery(variable + " div").length;
           jQuery(variable + " div:eq(" + j + ")")
                   .css('display', 'block')
                   .animate({opacity: 1}, 600)
                   .animate({opacity: 1}, delay)
                   .animate({opacity: 0}, 800, function(){
                           (j+1 == jmax) ? j=0 : j++;
                           jQuery(this).css('display', 'none').animate({opacity: 0}, 10);
                           cycleThru(variable, j);
                   });
           };
           
   jQuery('.tweets').each(function(index, val) {
     //iterate through array or object
     var parent_tweets = jQuery(val).parent().attr('id');
     var actioner = '#' + parent_tweets + ' .tweets .dynamic .cosmo_twitter .slides_container';
     cycleThru(actioner, 0);
   });
   	
});


function viewPort(){  
	/* Determine screen resolution */
	//var $body = jQuery('body');
	wSizes = [1200, 960, 768, 480, 320, 240];
	wSizesClasses = ['w1200', 'w960', 'w768', 'w480', 'w320', 'w240'];
	
	//$body.removeClass(wSizesClasses.join(' '));
	var size = jQuery(this).width();
	//alert(size);
	for (var i=0; i<wSizes.length; i++) { 
		if (size >= wSizes[i] ) { 
			//$body.addClass(wSizesClasses[i]);

			
			jQuery('.fb_iframe_widget iframe,.fb_iframe_widget span').css({'width':jQuery('.columns_width').width() });   
			
			break;
		}
	}
	if(typeof(FB) != 'undefined' ){
		FB.Event.subscribe('xfbml.render', function(response) {
			FB.Canvas.setAutoGrow();
		});
	}  
	/** Mobile/Default      -   320px
 * Mobile (landscape)  -   480px
 * Tablet              -   768px
 * Desktop             -   960px
 * Widescreen          -   1200px
 * Widescreen HD       -   1920px*/
	
}

/* ----------------------front page related scripts ----------------------*/

jQuery(document).ready(function(){

	var numberOfMenus = jQuery("#nav > ul#menuid > li").size();
	if(numberOfMenus == 0){
		numberOfMenus = 1;
	}
    var widthOfElements = 100/numberOfMenus;
    jQuery(".container-wrapper").css('width', numberOfMenus * 100 + '%');
    jQuery(".container-wrapper > div").css('width', widthOfElements + '%');
    jQuery("#nav ul li").css('width', widthOfElements + '%');
    jQuery('.nav-dots').fadeOut();
    jQuery('.nav-arrows').fadeOut();

    var rtime = new Date(1, 1, 2000, 12,00,00);
			var timeout = false;
			var delta = 200;
			jQuery(window).resize(function() {
			    rtime = new Date();
			    if (timeout === false) {
			        timeout = true;
			        setTimeout(resizeend, delta);
			    }
			});

			function resizeend() {
			    if (new Date() - rtime < delta) {
			        setTimeout(resizeend, delta);
			    } else {
			        timeout = false;
			        jQuery('.home #main').each(function() {
					    var p = jQuery(this).parent();
					    jQuery(this).height((p.height() - (jQuery(this).offset().top - p.offset().top))+25);
					});
			    }               
			}

			jQuery('.home #main').each(function() {
			    var p = jQuery(this).parent();
			    jQuery(this).height((p.height() - (jQuery(this).offset().top - p.offset().top))+25);
			});
});     

function init_horizontal_scroll(){
	var horizontalScroll = jQuery('.single-slider').jScrollPane({showArrows:true,autoReinitialise:true});
	var hApi = horizontalScroll.data('jsp');
	//initHorizontalMouseWheel(horizontalScroll,hApi);
}

function initHorizontalMouseWheel(elem, hApi){
	elem.bind( 
        'mousewheel',
        function (event, delta, deltaX, deltaY) 
        { 
            hApi.scrollByX(delta*-50); 
         	return false;
        } 
    ); 
}

jQuery(window).load(function() {
	jQuery(".small-device-menu-link").pageslide({ direction: "right", modal: true });

	jQuery('#small-menu-elements li').click(function(){
		jQuery.pageslide.close(function() {
		  goto('#ctn_' + location.hash.replace('#', ''), this);
		});
	});
	
	var verticalScroll = jQuery('.scroll-this').jScrollPane({showArrows:true,autoReinitialise:true,contentWidth: '0px',mouseWheelSpeed:70});
	var vApi = verticalScroll.data('jsp');
	init_horizontal_scroll();

	var rtime = new Date(1, 1, 2000, 12,00,00);
	var timeout = false;
	var delta = 200;
	jQuery(window).resize(function() {
	    rtime = new Date();
	    if (timeout === false) {
	        timeout = true;
	        setTimeout(resizeend, delta);
	    }
	});

	function resizeend() {
	    if (new Date() - rtime < delta) {
	        setTimeout(resizeend, delta);
	    } else {
	        timeout = false;
			jQuery('.scroll-this').jScrollPane({showArrows:true});
			jQuery('.scroll-this').jScrollPane({autoReinitialise:true});
	    }               
	}

	jQuery('#collapse-branding-btn').click(function(){
		if (jQuery('#collapse-branding-btn i').hasClass("icon-chevron-down")) {
			if (jQuery.trim(jQuery('.small_logo').html()).length>0){
				jQuery('.small_logo').fadeOut(1000,function(){
					showHideSmallLogo();
				});
			}else{
				showHideSmallLogo();
			}
		}else{
			showHideSmallLogo();
		}

		
	});

	function showHideSmallLogo(){
		jQuery('.branding').slideToggle('slow',function(){
		    jQuery('.home #main').each(function() {
			    var p = jQuery(this).parent();
			    jQuery(this).height((p.height() - (jQuery(this).offset().top - p.offset().top))+25);
			});

			jQuery('.scroll-this').jScrollPane({showArrows:true});
			if (jQuery('#collapse-branding-btn i').hasClass("icon-chevron-up")) {
				jQuery.cookie("branding_cookie", null);
				jQuery('#collapse-branding-btn .icon-chevron-up').removeClass('icon-chevron-up').addClass('icon-chevron-down');
				var cookie_value = jQuery('#collapse-branding-btn i').attr('class');
				jQuery.cookie("branding_cookie", cookie_value, { expires: 7 });
				jQuery('.small_logo').fadeIn(1000);
			}else{
				jQuery.cookie("branding_cookie", null);
				jQuery('#collapse-branding-btn .icon-chevron-down').removeClass('icon-chevron-down').addClass('icon-chevron-up');
				var cookie_value = jQuery('#collapse-branding-btn i').attr('class');
				jQuery.cookie("branding_cookie", cookie_value, { expires: 7 });
			}
		});
	}

if( typeof comment_submit == 'function' ) { 
        comment_submit();
    }
    
});
    // Slider here

function createSlider(sliderID){
    	var anSliderID = (function() {
			var navigationBullets = '.sliders-navigator ul li.'+sliderID + ' > .nav-dots';
			var $navArrows = jQuery('.sliders-navigator ul li.'+sliderID + ' > .nav-arrows' ),
				$nav = jQuery( navigationBullets + ' > span' ),
				slitslider = jQuery( '#' + sliderID ).slitslider( {
					onBeforeChange : function( slide, pos ) {

						$nav.removeClass( 'nav-dot-current' );
						$nav.eq( pos ).addClass( 'nav-dot-current' );

					}
				} ),

				init = function() {

					initEvents();
					jQuery(window).trigger('resize');
					jQuery('.nav-dots, .nav-arrows').fadeOut();
					jQuery(navigationBullets).fadeIn(200);
					jQuery('.' + sliderID + ' .nav-arrows').fadeIn(200);
				},
				initEvents = function() {
					// add navigation events
					$navArrows.children( ':last' ).on( 'click', function() {

						slitslider.next();
						return false;

					} );

					$navArrows.children( ':first' ).on( 'click', function() {
						
						slitslider.previous();
						return false;

					} );
					$nav.each( function( i ) {
					
						jQuery( this ).on( 'click', function( event ) {
							
							var $dot = jQuery( this );
							
							if( !slitslider.isActive() ) {

								$nav.removeClass( 'nav-dot-current' );
								$dot.addClass( 'nav-dot-current' );
							}
							
							slitslider.jump( i + 1 );
							return false;
						
						} );
						
					} );

				};

				return { init : init };
		})();
		anSliderID.init();
}

function moveTabs(elemId){

	// Fading effect for scrollbars in containers
	jQuery('.jspVerticalBar').animate({opacity: 0}, 100, 'easeInOutCubic');
	setTimeout(function() {
		jQuery('.jspVerticalBar').animate({opacity: 1}, 400, 'easeInOutCubic');
	}, 1700);
	// Get number of menu elements and setting widths

	var numberOfMenus = jQuery("#nav > ul#menuid > li").size();
	var widthOfElements = 100/numberOfMenus;
	var currentActiveMenuIndex = jQuery('#nav ul li a.active').parent().index();
	var nameOfId = elemId.replace('#', '#ctn_');
 	var clickedMenuIndex = jQuery('#menu_'+nameOfId.replace('#ctn_', '')).parent().index();
 	var clickedMenuId = jQuery(elemId);
 	jQuery('.nav-dots, .nav-arrows').fadeOut();


 	// Add active class to selected container
 	jQuery('.container-wrapper > div').removeClass('active');
 	jQuery('.container-wrapper').find(clickedMenuId).addClass('active');

 	// Change background depending on the tab
    jQuery('.bgr').find('li').fadeOut(500);
    jQuery('.bgr').find('li[data-id-bg="'+nameOfId+'"]').fadeIn(1000);

    // Verify which way menu has to go
 	var diffCurrentActive = clickedMenuIndex - currentActiveMenuIndex;

 	goto(nameOfId, this);

	var diffCount = Math.abs(diffCurrentActive);

	/* Code going to right */
	if(diffCurrentActive < 0){
		if(diffCount >= 1){
			for (var i = 0; i < diffCount; i++) {
				/* Moving part for the menu */
				var lastElementIndex = jQuery('#nav ul li:last').index();
				jQuery('#nav ul').css('text-align','right');
				jQuery('#nav ul li').eq(lastElementIndex-i).animate({'width' : '0', 'opacity' : '0'}, 700, 'easeInOutCubic', 
					function(){
						jQuery(this).prependTo(jQuery(this).parent()).css({ 'width' : widthOfElements + '%'}).fadeTo(200, 1);
					});
			}
			
		}
		
	}
	/* Code going to left */
	if(diffCurrentActive > 0){
		
		if(diffCount >= 1){
			for (var i = 0; i < diffCount; i++) {
				var firstElementIndex = jQuery('#nav ul li:first').index();
				jQuery('#nav ul').css('text-align','left');
				jQuery('#nav ul li').eq(firstElementIndex+i).animate({'width' : '0', 'opacity' : '0'}, 700, 'easeInOutCubic', 
					function(){
						jQuery(this).appendTo(jQuery(this).parent()).css({ 'width' : widthOfElements + '%'}).fadeTo(200, 1);
					});
			}
		}
	}
	// Check if contentbox is slider
 		
		if(jQuery(nameOfId).hasClass('isSlider')){
      		var sliderID = String(jQuery(nameOfId).attr('data-slider'));
			createSlider(sliderID);
     	}
}


jQuery(function () {

	// Toggle the single window
	jQuery(".single-clicker").click(function() {
		jQuery('.single-container').animate({'right': '0%', opacity: 1}, 1000, 'easeInOutCubic');
		return false;
	});
	jQuery(".single-close").click(function() {
		jQuery('.single-container').animate({'right': '-60%', opacity: 0}, 500, 'easeInOutCubic');
		return false;
	});

   

    

     jQuery('#nav ul.home_menu li a').click(function (e) {
     	var menuId = jQuery(this).attr('href');
     	var theNameId = menuId;
		//jQuery(this).addClass('active');
		var currentActiveMenuIndex = jQuery('#nav ul li a.active').parent().index();
		
		// prevent default behaviour
	    e.preventDefault();
	    // cache href attribute
	    location.hash = menuId;
     });

});


function goto(id, t){
	//animate to the div id.
	jQuery(".container-wrapper").animate({"left": -(jQuery(id).position().left)}, 1500, 'easeInOutCubic');
	
}
 
jQuery(window).resize(function() {
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            jQuery(this).trigger('resizeEnd');
        }, 500);
    });
jQuery(window).bind('resizeEnd', function() {
    //do something, window hasn't changed size in 500ms
    goto('#ctn_' + location.hash.replace('#', ''));
});

jQuery(document).ready(function() {
	// Stuff to do as soon as the DOM is ready;
	var activeMenuTab = jQuery('#nav ul li a.active').attr('href');
	//activeMenuTab = activeMenuTab.replace('ctn_', '');
	//goto(activeMenuTab, this); return false;

	jQuery('.item-overlay').live('mouseenter',function(){
		jQuery(this).stop().animate({'opacity':'1'},500);
		jQuery('.featimg-hover .featimg-hover-more',jQuery(this)).stop().animate({'top':'50%'}, 500, 'easeInOutCubic');
	}).live('mouseleave', function(){
		jQuery(this).stop().animate({'opacity':'0'},500);
		jQuery('.featimg-hover .featimg-hover-more',jQuery(this)).stop().animate({'top':'-20%'}, 500, 'easeInOutCubic',
			function(){
				jQuery(this).css('top','120%');
			});
	});

	init_thumbs_hover();

  //testimonials
        jQuery('.testimonials-quotes li').hide(); // Hide all divs
        jQuery('.testimonials-quotes li:first-child').show(); // Show the first div
        jQuery('.testimonials-quotes li:first').addClass('active'); // Set the class for active state
        jQuery('.testimonials-authors li a').click(function(){ // When link is clicked
          var currentTab = jQuery(this).attr('href'); // Set currentTab to value of href attribute
          var parenter = '#'+jQuery(this).parent().parent().prev().attr('id');
          var par = '#'+jQuery(this).parent().parent().prev().attr('id') + ' > li';
          
          var div_height = jQuery(parenter).find(currentTab).height();
          jQuery(parenter).find(currentTab).parent().height(div_height);
          jQuery(par).hide(); // Hide all divs
          jQuery(parenter).find(currentTab).fadeIn(); // Show div with id equal to variable currentTab
          jQuery(parenter).find(currentTab).parent().height('auto');
          //Here we change the image
          var data_image = jQuery(this).parent().parent().prev().find(currentTab).attr('data-image');
          jQuery(this).parent().parent().find('.author img').animate({opacity: 0},0).attr('src', data_image).animate({opacity: 0},1).animate({opacity: 1},500);

          //Here we change the testimonial name

          jQuery(this).parent().parent().next().find('li').hide();
          jQuery(this).parent().parent().next().find(currentTab+'-author').fadeIn(1500);
          return false;
    	});	

		/*start prettyPhoto settings*/
		if (prettyPhoto_enb.enb_lightbox) { 
			jQuery(document).ready(function(){
			    /* show images inserted in gallery */
			    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			            autoplay_slideshow: false,
			            theme: 'light_rounded',
			            deeplinking: false 

			    });

			    /* show images inserted into post in LightBox */
			    jQuery("[class*='wp-image-'] ").parents('a').prettyPhoto({
			            autoplay_slideshow: false,
			            theme: 'light_rounded',
			            deeplinking: false 

			    });

			    jQuery("a[rel^='keyboardtools']").prettyPhoto({
			            autoplay_slideshow: false,
			            theme: 'light_rounded',
			            social_tools : '',
			            deeplinking: false 

			    });
			});
		};
		/*end prettyPhoto settings*/


	
});
	
jQuery(window).load(function () {
  	init_freetile();
});	

/* History thing */

jQuery(function(){
	if(location_hash.triger_hash  == '1'){
		if(location.hash != ""){
			var tHash = location.hash;
			moveTabs(tHash, null);
			var hash = location.hash.replace('#','');
			jQuery('#nav ul li a').removeClass('active');
			jQuery('#menu_' + hash).addClass('active');
			isHash = true;
		}else{
			isHash = false;
			//location.hash = '#ctn_tag_1_portfolio';
			location.hash = location_hash.initial_hash;
		}
	}
	
	if ("onhashchange" in window){
	    jQuery(window).bind('hashchange', function(e){
	        e.preventDefault();
	    	var hash = location.hash;
	    	moveTabs(hash, null);
	        return false;
	    });
	}
	
  // Bind an event to window.onhashchange that, when the hash changes, gets the
  // hash and adds the class "selected" to any matching nav link.
  jQuery(window).hashchange( function(event){
    var hash = location.hash;
    

    // Iterate over all nav links, setting the "selected" class as-appropriate.
    jQuery('#nav ul li a').each(function(){
      var that = jQuery(this);
      that[ that.attr( 'href' ) === hash ? 'addClass' : 'removeClass' ]( 'active' );
    });

  	event.preventDefault();
  })
  
  // Since the event is only triggered when the hash changes, we need to trigger
  // the event now, to handle the hash the page may have loaded with.
  
});

function init_freetile(){
	jQuery('.masonry').each(function(index) {
	    jQuery(this).freetile({
		    animate: true,
		    elementDelay: 30
		});
	});
}

function init_thumbs_hover(){
	jQuery('.thumb_view .featimg').mouseover(function(){
		jQuery('.entry-title',jQuery(this)).css('opacity','1');
	}).mouseleave(function(){
		jQuery('.entry-title',jQuery(this)).css('opacity','0');
	});
}

/*start tour.js*/
(function($){
    var defaultOptions = {
        "nextClass" : "next",
        "skipClass" : "skip",
        "closeClass" : "close"
    };

    $.fn.tour = function( options ){
        var container = this;
        var index;
        var side;
        var opt = $.extend( {} , defaultOptions , options );
        return this.each(function(){            
            index = 0;
            jQuery( "." + opt.nextClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( container ).each(function( i ){
                    if( index + 1 == parseInt( jQuery( this ).attr('index') ) ){
                        jQuery( this ).fadeTo('slow', 1 );
                        jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index + 1 , {expires: 365, path: '/' } );
                        jQuery( this ).gonext();
                        
                    }else{
                        jQuery( this ).fadeTo('slow', 0 , function(){
                            jQuery( this ).hide();
                        });
                    }
                });
            });

            jQuery( "." + opt.skipClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index , {expires: 365, path: '/' } );
            });
            jQuery( "." + opt.closeClass , this ).click(function(){
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                
                jQuery.cookie(cookies_prefix + '_tour_closed_' + side , 'true' , {expires: 365, path: '/' } );
            });
        });
    }

    $.fn.gonext = function(){
        var h = parseInt((parseInt( jQuery( window ).height() ) - parseInt( jQuery( this ).height()) ) / 2 );
        if( jQuery( this ).offset().top > h ){
            jQuery.scrollTo( jQuery( this ).offset().top - h , 400 );
        }
    }
})(jQuery);
/*end tour.js*/


(function($){
    $.fn.sorted = function(customOptions) {
        var options = {
            reversed: false,
            by: function(a) {
                return a.text();
            }
        };
        $.extend(options, customOptions);
    
        $data = jQuery(this);
        arr = $data.get();
        arr.sort(function(a, b) {
            
            var valA = options.by(jQuery(a));
            var valB = options.by(jQuery(b));
            if (options.reversed) {
                return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;              
            } else {        
                return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;  
            }
        });
        return jQuery(arr);
    };

})(jQuery);

/* ###### Filters ##### */

/* thumbs filter */


jQuery('.filter_container').each(function(){
	var list_class = 'thumbs-list-' + jQuery(this).data('id');
	var controls_class = 'thumbs-splitter-' + jQuery(this).data('id');
	init_thumbs_filter(list_class, controls_class );	
});

function init_thumbs_filter(list_class, controls_class ){
  /*var $list = jQuery('.thumbs-list');
  var $controls = jQuery('ul.thumbs-splitter');*/

  var read_button = function(class_names) {
    var r = {
      selected: false,
      type: 0
    };
    for (var i=0; i < class_names.length; i++) {
      if (class_names[i].indexOf('selected-') == 0) {
        r.selected = true;
      }
      if (class_names[i].indexOf('segment-') == 0) {
        r.segment = class_names[i].split('-')[1];
      }
    };
    return r;
  };
  
  var determine_sort = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var determine_kind = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var $preferences = {
    duration: 800,
    easing: 'easeInOutQuad',
    adjustHeight: 'dynamic'
  };
  
  var $list = jQuery('.'+list_class);
  var $data = $list.clone();
  
  var $controls = jQuery('ul.'+controls_class);
  
  $controls.each(function(i) {
    
    var $control = jQuery(this);
    var $buttons = $control.find('a');
    
    $buttons.bind('click', function(e) {
      
      var $button = jQuery(this);
      var $button_container = $button.parent();
      var button_properties = read_button($button_container.attr('class').split(' '));      
      var selected = button_properties.selected;
      var button_segment = button_properties.segment;

      if (!selected) {


        var nrOfButtonsMax = '15';
       for(var i = 0; i<=15; i++)
          nrOfButtonsMax += ' ' + 'selected-' + i;
       $buttons.parent().removeClass(nrOfButtonsMax);


        $buttons.parent().removeClass('selected');
        $button_container.addClass('selected-' + button_segment);
        $button_container.addClass('selected');
        
        var sorting_type = determine_sort($controls.eq(1).find('a'));
        var sorting_kind = determine_kind($controls.eq(0).find('a'));
        
        if (sorting_kind == 'all') {
          var $filtered_data = $data.find('div.all-elements');
        } else {
          var $filtered_data = $data.find('div.' + sorting_kind);
        }
        
        if (sorting_type == 'size') {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return parseFloat(jQuery(v).find('span').text());
            }
          });
        } else {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return jQuery(v).find('strong').text().toLowerCase();
            }
          });
        }
        
        $list.quicksand($sorted_data, $preferences, function() { 
        // callback function
			jQuery('.scroll-this').jScrollPane({showArrows:true});
			jQuery('.scroll-this').jScrollPane({autoReinitialise:true});
        }
        );
        
      }
      
      e.preventDefault();
    });
    
  }); 
 
}