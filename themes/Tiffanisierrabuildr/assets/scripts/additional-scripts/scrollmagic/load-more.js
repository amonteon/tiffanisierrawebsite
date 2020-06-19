jQuery(document).ready(function($) {
	
	var controller = new ScrollMagic.Controller(),
	postListing = jQuery('.endless-scroll'),
	themeUrl = beloadmore.themeUrl;
	
	if(postListing.length) {		
	
		postListing.append('<div class="no-more text-center">There are no more posts to show</div><div class="load-more text-center"><img src="'+ themeUrl +'/assets/images/loaders.gif"> Loading Posts</div>');
		
	var	loadMore = jQuery('.endless-scroll .load-more'),
	noMore = jQuery('.endless-scroll .no-more'),
	page = 1;	
		
	var ourScene = new ScrollMagic.Scene({
		triggerElement:".endless-scroll .load-more",		
		// trigger on 80% of the window
		triggerHook: 0.8,
		// 	triggerHook: "onEnter",			
		})		
		// Trigger Indicators
		/*
		.addIndicators({ 
			name: 'More posts scene',
			colorTrigger: 'green',
			colorStart: 'red'
		})
		*/

		.addTo(controller)
		.on("enter", function (e) {
			if(!loadMore.hasClass("active")) {
				loadMore.addClass("active");
				noMore.removeClass("active");				
				//console.log("loading Items");								
				setTimeout(addContent, 1500);				
			}				
		});	
	}		
		
		function addContent() {
			var data = {
				action: 'be_ajax_load_more',
				nonce: beloadmore.nonce,
				page: page,
				query: beloadmore.query,
			};
			$.post(beloadmore.url, data, function(res) {
				if( res.success) {
					if(res.data) {
						postListing.append( res.data );	
						postListing.append( loadMore );					
						page = page + 1;					
						// current page
						//console.log(page);
						loadMore.removeClass("active");			
						ourScene.update();							
					} else {
						//console.log('no more posts');
						noMore.addClass("active");
						loadMore.fadeOut('fast');	
						postListing.append( noMore );
					}
												
				}
			}).fail(function(xhr, textStatus, e) {
				 console.log(xhr.responseText);
			});
						
					
		}		
});