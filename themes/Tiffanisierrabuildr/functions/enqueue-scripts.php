<?php
function site_scripts() {
	
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
   	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery' ), filemtime(get_template_directory() . '/assets/scripts/js'), true );        
   	// Adding scripts file in the footer    
    wp_enqueue_script( 'event-js', get_template_directory_uri() . '/assets/scripts/additional-scripts/event-move/jquery.event.move.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'twenty-js', get_template_directory_uri() . '/assets/scripts/additional-scripts/twenty-twenty/jquery.twentytwenty.min.js', array( 'jquery' ), '', true ); 
	
	// SWIPER 
	wp_enqueue_script( 'swiper-js-min', 'https://unpkg.com/swiper/js/swiper.min.js',array(), '', true ); 
	wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/js/swiper.js',array(), '', true ); 

	
	// Flickity sync (sync carousels) - use https://github.com/metafizzy/flickity-sync as reference      
  //  wp_enqueue_script( 'flickity-sync-js', get_template_directory_uri() . '/assets/scripts/additional-scripts/flickity-sync/flickity-sync-min.js', array( 'jquery' ), '', true );
        
    //Scrollmagic
	// wp_enqueue_script( 'scroll-magic-js', get_template_directory_uri() . '/assets/scripts/additional-scripts/scrollmagic/scrollmagic.min.js', array( 'jquery' ), '', true );
    // wp_enqueue_script( 'scroll-indicators-js', get_template_directory_uri() . '/assets/scripts/additional-scripts/scrollmagic/plugins/debug.addIndicators.min.js', array( 'jquery' ), '', true );	

    // Register site fonts currently loading from /assets/fonts/ testing performance via local vs external request
    //wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Average|Source+Sans+Pro:400,400i,600,700,900', array(), '', 'all' );  
    
      // Register main stylesheet
    wp_enqueue_style( 'additional-css', get_template_directory_uri() . '/assets/styles/css/additional-styles/style.css', array(), filemtime(get_template_directory() . '/assets/styles/css/additional-styles'), 'all' );
    //SWIPER
    wp_enqueue_style( 'swiper-css-min', 'https://unpkg.com/swiper/css/swiper.min.css', array(), '', 'all' );
    wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/css/swiper.css', array(), '', 'all' );
    
    wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/assets/styles/css/additional-styles/fancybox.min.css', array(), filemtime(get_template_directory() . '/assets/styles/css/additional-styles'), 'all' );
    //wp_enqueue_style( 'flickity-css', get_template_directory_uri() . '/assets/styles/css/additional-styles/flickity.min.css', array(), filemtime(get_template_directory() . '/assets/styles/css/additional-styles'), 'all' );
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/styles/css/main-styles/style.css', array(), filemtime(get_template_directory() . '/assets/styles/css/main-styles'), 'all' );
    
    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

/**
 * Enqueue Scripts for LOAD MORE JS (Endless Scrolling)
 *
 */
/*
function be_load_more_js() {
	global $wp_query;
	$args = array(
		'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
		'url'   => admin_url( 'admin-ajax.php' ),
		'query' => $wp_query->query,
		'themeUrl' => get_stylesheet_directory_uri(),
	);
	
	if(is_archive() || is_home()){		
	//Adding Scripts on Blog page and Custom post pages only	
	wp_enqueue_script( 'scroll-magic-js', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'scroll-indicators-js', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array( 'jquery' ), '', true );					
	wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '/assets/scripts/additional-scripts/load-more.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'be-load-more', 'beloadmore', $args );		
	} else {
		return;
	}	
}
add_action( 'wp_enqueue_scripts', 'be_load_more_js' );
*/