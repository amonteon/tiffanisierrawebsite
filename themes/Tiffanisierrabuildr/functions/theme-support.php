<?php
	
// Adding WP Functions & Theme Support
function joints_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	
	// Default thumbnail size
	set_post_thumbnail_size(125, 125, true);

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );
	
	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );
	
	// Add HTML5 Support
	add_theme_support( 'html5', 
	         array( 
	         	'comment-list', 
	         	'comment-form', 
	         	'search-form', 
	         ) 
	);
	
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	// Adding post format support
	 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); 
	
	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'joints_theme_support', 1200 );	
	
} /* end theme support */

add_action( 'after_setup_theme', 'joints_theme_support' );


// Additional theme support FM functions 

add_action( 'after_setup_theme', 'joints_theme_support' );

// @#2. ADDS AFC OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
			'page_title'  => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'  => false
		));
}


function setNativeUrl($url) {
	// The cdn url field can be found under the Theme Settings > Developer Options 
    $cdn_url = get_field('cloudfront_cdn_url', 'option');
    $new_url;
    if($cdn_url):
    	$path = parse_url($url, PHP_URL_PATH);
        $prefix = "//" . $cdn_url;    
       $new_url = $prefix . $path;
    else:
  	   $new_url = $url;
    endif;
    
    return $new_url;
}


function dataInterchangeImgs($dataImgs) {
    // This will read the ACF gallery field from mobile to retina, determine and assign any existing images uploaded    
    $ctr = 0; 
    $dataInterchangeStr = '';
    $bannerimgs;
    
    // The cdn url field can be found under the Theme Settings > Developer Options 
    $cdn_url = get_field('cloudfront_cdn_url', 'option');
    if($dataImgs){
        foreach($dataImgs as $image ): $ctr++;                           
                
            if( $cdn_url == true ){
                $bannerimgs[$ctr] = $image['url'];
                //$parse = parse_url($bannerimgs[$ctr]);
                //$host = $parse['host'];
                
                //$arrayHost = explode(".", $host);
                //$newHost =  (array_key_exists(count($arrayHost) - 1, $arrayHost) ? $arrayHost[count($arrayHost) - 2] : "").".".$arrayHost[count($arrayHost) - 1];
                
                $path = parse_url($bannerimgs[$ctr], PHP_URL_PATH);
                $prefix = "//" . $cdn_url;
    
                $newbannerimgs[$ctr] = $prefix . $path;
            } else{
                $newbannerimgs[$ctr] = $image['url'];
            }
            switch ($ctr) {
                case 1: $dataInterchangeStr = "[". $newbannerimgs[$ctr] .", small]";  break;
                case 2: $dataInterchangeStr .= ", [". $newbannerimgs[$ctr] .", medium]"; break;
                case 3: $dataInterchangeStr .= ", [". $newbannerimgs[$ctr] .", large]"; break;
                case 4: $dataInterchangeStr .= ", [".  $newbannerimgs[$ctr] . ", largest]"; break;                  
            }                               
        endforeach;         
        return $dataInterchangeStr; 
    } else {
        return false;
    }
} 

function _limit_word($string, $word_limit) {
	$words = explode(" ", $string);
	return implode(" ",array_splice($words, 0 , $word_limit));
}


//  @#3. Phone Number Special Character Replacement
function _phone_num($num)
{
	return preg_replace("/[^0-9]/","",$num);
}

// Add the filter and function, returning the widget title only if the first character is not "!"
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr( $widget_title, 0, 1 ) == '!' )
		return;
	else
		return ( $widget_title );
}

if ( is_user_logged_in() ) {
	// get the the role object - editor, author, etc. (or any specially created role)
	$role = get_role('editor');

	/* add a capability to this role object - The 'edit_theme_options' enables Dashboard APPEARANCE
	** and Sub-Menus of Themes, Widgets, Menus, and Backgrounds for users with that role
	** For a list of capabilities that can be added or removed visit the wp codex at: codex.wordpress.org/Roles_and_Capabilities#edit_plugins
	*/
	$role->add_cap(
		'edit_theme_options',
		'activate_plugins',
		'update_plugins',
		'delete_plugins'
	);
	$role->remove_cap(
		'delete_themes',
		'install_themes',
		'update_themes',
		'switch_themes',
		'edit_themes',
		'install_plugins'
	);
}
// For more CAP types and info, go to wordpress.org - Search for:  ROLES and CAPABILITIES


//Use [year] in your posts.
function year_shortcode() {
	$year = date('Y');
	return $year;
}
add_shortcode('year', 'year_shortcode');

// Note that your theme must support post thumbnails for this function to work.
// If you are getting an error try adding add_theme_support('post-thumbnails'); to your functions. php file

// Note that your theme must support post thumbnails for this function to work.
// If you are getting an error try adding add_theme_support('post-thumbnails'); to your functions. php file
function vp_get_thumb_url($text, $size){
		global $post, $posts;
	ob_start();
	ob_end_clean();
	$imageurl = "";
	// Check to see which image is set as "Featured Image"
/*
	$featuredimg = get_post_thumbnail_id($theID);
	// Get source for featured image
	$img_src = wp_get_attachment_image_src($featuredimg, $size);
	// Set $imageurl to Featured Image
	$imageurl=$img_src[0];
*/
	// If there is no image attached to the post, look for anything that looks like an image and get that
	if (!$imageurl) {
		//if (preg_match('/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i' ,  $text, $matches)) { $imageurl=$matches[1]; }
		if (preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches)) { $imageurl=$matches[1][0]; }		
	}	
	// If there's no image attached or inserted in the post, look for a YouTube video
	if (!$imageurl){
		// look for traditional youtube.com url from address bar
		if ( preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2)) {
		$youtubeurl = $matches2[0];	$videokey = $matches2[3]; } else { $youtubeurl = false; $videokey = false;  }
		if (!$youtubeurl) {
			// look for youtu.be 'embed' url
			if (  preg_match("/([a-zA-Z0-9\-\_]+\.|)youtu\.be\/([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2)) {
			$youtubeurl = $matches2[0];	$videokey = $matches2[2]; } else {	$youtubeurl = false; $videokey = false; }
		}
		if ($youtubeurl)
			// Get the thumbnail YouTube automatically generates
			// '0' is the biggest version, use 1 2 or 3 for smaller versions
			$imageurl = "http://i.ytimg.com/vi/{$videokey}/0.jpg";
	}
	// Spit out the image path
	return $imageurl;
}


function fp_limit_words($string, $word_limit) {
	$words = explode(" ", $string);
	return implode(" ",array_splice($words, 0 , $word_limit));
}
// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more' , 999);

function wpdocs_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' , 999 );

function wpdocs_custom_excerpt_length( $length ) {
	return 42;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


/*
*  ACF social links repeater shortcode
*/
function socLinks_fn() {
	if( function_exists('have_rows') ) {
		ob_start();
		if( have_rows('social_icons','options') ): ?>
			<ul class="socialLinks socLinkShortCode social-networks menu">
			<?php while( have_rows('social_icons','options') ): the_row(); ?>
			<?php 
				$add_custom_icon = get_sub_field('add_custom_icon');
				$soc_custom_img = get_sub_field('soc_custom_img');
				$soc_custom_svg = get_sub_field('soc_custom_svg');
			?>
				<li class="social-items">
					<a href="<?php the_sub_field('social_page_link','options'); ?>" target="_blank">
				<?php 
			switch($add_custom_icon) {
				case 'fontawesome': ?>
				<i class="fa <?php the_sub_field('social_icon','options'); ?>"></i><?php
				break;
				case 'image': ?>
				<img src="<?php echo $soc_custom_img['url']?>" width="20" height="20"><?php
				break; 
				case 'svg': 
				echo $soc_custom_svg;
				break;
			}
		?>
		</a></li>
		<?php endwhile; ?>
		</ul>
		<?php endif;
			$content = ob_get_contents();
		ob_end_clean();
	return $content;
	}
}
add_shortcode( 'socialLinks', 'socLinks_fn' );

function socLinks_offcanvas($atts) {
	if( function_exists('have_rows') ) {
		ob_start();
		
		$atts = shortcode_atts(
		array(
			'title' => "false",
		), $atts, 'socialtag' );
		
		if( have_rows('social_icons','options') ): ?>
			<ul class="off-canvas-social-networks menu vertical">
			<?php while( have_rows('social_icons','options') ): the_row(); ?>
			<?php 
				$social_title = get_sub_field('social_title');
				$add_custom_icon = get_sub_field('add_custom_icon');
				$soc_custom_img = get_sub_field('soc_custom_img');
				$soc_custom_svg = get_sub_field('soc_custom_svg');
			?>
				<li class="social-items">
					<a href="<?php the_sub_field('social_page_link','options'); ?>" target="_blank">	
						<div class="grid-x align-middle">
						<div class="cell shrink the-font-awesome">			
					<?php 
						switch($add_custom_icon) {
							case 'fontawesome': ?>
							<i class="fa <?php the_sub_field('social_icon','options'); ?>"></i><?php
							break;
							case 'image': ?>
							<img src="<?php echo $soc_custom_img['url']?>" width="20" height="20"><?php
							break; 
							case 'svg': 
							echo $soc_custom_svg;
							break;
						}	
						echo "</div><div class='cell auto soc-title'>".$social_title."</div>";				
					?>
						</div>
					</a>
					
				</li>
		<?php endwhile; ?>
		</ul>
		<?php endif;
			$content = ob_get_contents();
		ob_end_clean();
	return $content;
	}
}
add_shortcode( 'offcanvasSocial', 'socLinks_offcanvas' );

add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );

function form_submit_button( $button, $form ) {
    return "<button class='button primary rounded gform_button' id='gform_submit_button_{$form['id']}'><span>Submit</button>";
}


add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
	$starting_index = 1000; // if you need a higher tabindex, update this number
	if( $form )
		add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
	return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

add_filter('acf/settings/google_api_key', function () {
		return 'AIzaSyBrzD_21CB5NvmhLfu3Ugw4kTXi0jNCQio';
	});


add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
			'label'      => __('Default Image ID','acf'),
			'instructions'  => __('Appears when creating a new post','acf'),
			'type'      => 'image',
			'name'      => 'default_value',
		));
}

add_action('acf/render_field_settings/type=gallery', 'add_default_value_to_gallery_field', 20);
function add_default_value_to_gallery_field($field) {
	acf_render_field_setting( $field, array(
			'label'      => __('Default Gallery Images','acf'),
			'instructions'  => __('Appears when creating a new post','acf'),
			'type'      => 'gallery',
			'name'      => 'default_value',
		));
}

function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('acf_the_content', 'filter_ptags_on_images',9999);
add_filter('the_content', 'filter_ptags_on_images', 9999);

function user_content_replace($content) {
    return str_replace('<p>&nbsp;</p>','<p class="spacerP">&nbsp;</p>',$content);
}
add_filter('acf_the_content','user_content_replace', 99);
add_filter('the_content','user_content_replace', 99);


function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {
	
	// remove layout title from text
	$title = '';	
	
	// load text sub field
	if( $text = get_sub_field('section_title') ) {
		
		$title .= '<strong>' . $text . '</strong>';
		
	}	
	// return
	return $title;	
}

// name
add_filter('acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);


function make_mce_awesome( $init ) {
    /*
       There are easier things than make 'left/center/right align text' to use classes instead of inline styles
    */

    // decode
    $formats = preg_replace( '/(\w+)\s{0,1}:/', '"\1":', str_replace(array("\r\n", "\r", "\n", "\t"), "", $init['formats'] ));
    $formats = json_decode( $formats, true );

    // set correct values
    $formats['alignleft'][0]['classes'] = 'text-left';
    $formats['aligncenter'][0]['classes'] = 'text-center';
    $formats['alignright'][0]['classes'] = 'text-right';

    // remove inline styles
    unset( $formats['alignleft'][0]['styles'] );
    unset( $formats['aligncenter'][0]['styles'] );
    unset( $formats['alignright'][0]['styles'] );

    // encode and replace
    $init['formats'] = json_encode( $formats );

    return $init;
}
add_filter( 'tiny_mce_before_init', 'make_mce_awesome' );


/**
create additional wp customizer settings
*/


/**
* Create Logo Setting and Upload Control
*/
function tiffanibuildr_customizer_settings($wp_customize) {

// Add Page Template
	$wp_customize->add_section('tiffanibuildr_subpage', array(
	'title' => 'Sub Pages',
	'description' => 'Select tiffanibuildr Sub Pages Settings',
	'priority' => 21,
	));
	
	$wp_customize->add_setting( 'tiffanibuildr_subpage_type', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'two_col_grid',
	) );
	
	
	$wp_customize->add_control( 'tiffanibuildr_subpage_type', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_subpage', // Add a default or your own section
	  'label' => __( 'Choose Sub Page Template' ),
	  'description' => __( 'Select kind of sub page template' ),
	  'choices' => array(
	    'two_col_grid' => __( 'Two Column (8/4 Column)' ),
	    'full_width_grid_10' => __( 'Full Width (10 Column Centered)' ),
	    'full_width_grid' => __( 'Full Width Contained (12 Column)  ' ),
	    'full_width_grid_nc' => __( 'Full Width Expanded (12 Column)  ' ),
	  ),
	) );


	
// Add Page Template
	$wp_customize->add_section('tiffanibuildr_archive', array(
	'title' => 'Archives',
	'description' => 'Select tiffanibuildr Archives Settings',
	'priority' => 21,
	));
	
	$wp_customize->add_setting( 'tiffanibuildr_archive_type', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'two_col_grid',
	) );
	
	
	$wp_customize->add_control( 'tiffanibuildr_archive_type', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_subpage', // Add a default or your own section
	  'label' => __( 'Choose Archive Template' ),
	  'description' => __( 'Select kind of archive template' ),
	  'choices' => array(
	    'two_col_grid' => __( 'Two Column (8/4 Column)' ),
	    'full_width_grid_10' => __( 'Full Width (10 Column Centered)' ),
	    'full_width_grid' => __( 'Full Width Contained (12 Column)  ' ),
	    'full_width_grid_nc' => __( 'Full Width Expanded (12 Column)  ' ),
	  ),
	) );


// Add Header Section To Customizer
	$wp_customize->add_section('tiffanibuildr_topbar', array(
	'title' => 'Menu Bar',
	'description' => 'Select tiffanibuildr Navigation Settings',
	'priority' => 20,
	));

	$wp_customize->add_setting( 'tiffanibuildr_nav_type', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'offcanvas_topbar',
	) );

	$wp_customize->add_control( 'tiffanibuildr_nav_type', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_topbar', // Add a default or your own section
	  'label' => __( 'Choose Navigation Template' ),
	  'description' => __( 'Select kind of menu' ),
	  'choices' => array(
	    'offcanvas_topbar' => __( 'Off Canvas Topbar' ),
	    'offcanvas_tiles' => __( 'Off Canvas Tiles (mobile)' ),
	    'offcanvas_curtain' => __( 'Off Canvas Curtain' ),
	  ),
	) );


	$wp_customize->add_setting( 'offcanvas_select_setting_tablet_id', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'left',
	) );

	$wp_customize->add_control( 'offcanvas_select_setting_tablet_id', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_topbar', // Add a default or your own section
	  'label' => __( 'Choose Off Canvas Position (Tablet)' ),
	  'description' => __( 'This is a custom select option.' ),
	  'choices' => array(
	    'left' => __( 'Off Canvas Left' ),
	    'right' => __( 'Off Canvas Right' ),
	    'top' => __( 'Off Canvas Top' ),
	    'bottom' => __( 'Off Canvas Bottom' ),
	  ),
	) );
	
	
		$wp_customize->add_setting( 'offcanvas_transition_tablet_id', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'push',
	) );

	$wp_customize->add_control( 'offcanvas_transition_tablet_id', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_topbar', // Add a default or your own section
	  'label' => __( 'Off Canvas Transition Style (Tablet)' ),
	  'description' => __( 'Choose Push Or Overlap Transition.' ),
	  'choices' => array(
	    'push' => __( 'Push Transition' ),
	    'overlap' => __( 'Overlap Transition' ),
	  ),
	) );



	$wp_customize->add_setting( 'offcanvas_select_setting_id', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'left',
	) );

	$wp_customize->add_control( 'offcanvas_select_setting_id', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_topbar', // Add a default or your own section
	  'label' => __( 'Choose Off Canvas Position (Mobile)' ),
	  'description' => __( 'This is a custom select option.' ),
	  'choices' => array(
	    'left' => __( 'Off Canvas Left' ),
	    'right' => __( 'Off Canvas Right' ),
	    'top' => __( 'Off Canvas Top' ),
	    'bottom' => __( 'Off Canvas Bottom' ),
	  ),
	) );



	$wp_customize->add_setting( 'offcanvas_transition_id', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'offcanvas_sanitize_select',
	  'default' => 'push',
	) );

	$wp_customize->add_control( 'offcanvas_transition_id', array(
	  'type' => 'select',
	  'section' => 'tiffanibuildr_topbar', // Add a default or your own section
	  'label' => __( 'Off Canvas Transition Style' ),
	  'description' => __( 'Choose Push Or Overlap Transition.' ),
	  'choices' => array(
	    'push' => __( 'Push Transition' ),
	    'overlap' => __( 'Overlap Transition' ),
	  ),
	) );


	function offcanvas_sanitize_select( $input, $setting ) {
	
	  // Ensure input is a slug.
	  $input = sanitize_key( $input );
	
	  // Get list of choices from the control associated with the setting.
	  $choices = $setting->manager->get_control( $setting->id )->choices;
	
	  // If the input is a valid key, return it; otherwise, return the default.
	  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}



}
add_action('customize_register', 'tiffanibuildr_customizer_settings');


/**
 * AJAX Load More 
 *
 */
function be_ajax_load_more() {
	check_ajax_referer( 'be-load-more-nonce', 'nonce' );
    
	$args = isset( $_POST['query'] ) ? $_POST['query'] : array();
	$args['post_type'] = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
	$args['paged'] = $_POST['page'];
	$args['post_status'] = 'publish';
	ob_start();
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();		
		if  ($args['post_type'] == 'galleries'):
			get_template_part( 'parts/loops/loop', 'archive-galleries' );
		else:
			get_template_part( 'parts/loops/loop', 'archive-excerpt' );
		endif;		
	endwhile; endif; wp_reset_postdata();
	$data = ob_get_clean();
	wp_send_json_success( $data );
	wp_die();
}
add_action( 'wp_ajax_be_ajax_load_more', 'be_ajax_load_more' );
add_action( 'wp_ajax_nopriv_be_ajax_load_more', 'be_ajax_load_more' );

add_filter( 'gform_confirmation_anchor', '__return_false' );

function my_acf_admin_head() {
    ?>
    <script type="text/javascript">
        (function($){

            $(document).ready(function(){
                $('.acf-field-flexible-content .layout').addClass('-collapsed');          
            });

        })(jQuery);
    </script>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

//add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

/*
function my_wp_nav_menu_objects( $items, $args ) {

	foreach( $items as &$item ) {
		
		// vars
		$add_background_image = get_field('add_background_image', $item);
		$backgroundImage = get_field('background_image', $item);
		
		
		// append icon
		if( $add_background_image && $backgroundImage ) {
			
			  $item->title .= '<div class="background-image-container" data-image="'. $backgroundImage['url'] .'"></div>';
			
		}		
	}
		
	// return
	return $items;
	
}
*/
add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {	
		
	$attribs = get_field('mega_menu_selector', $item);	
	
	if($attribs != "---"):
		$atts['data-toggle'] = $attribs;
	endif;
	
return $atts;

}, 10, 3 );


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// get menu
	$menu = $args->menu;
	
		// modify primary only
	if( $args->theme_location == 'main-nav' ) { 
		$html = "";	
	
		if(have_rows('mega_menu', $menu)):
			while(have_rows('mega_menu', $menu)): the_row();
				$title = get_sub_field('title');
				$id_name = get_sub_field('id_name');
				$has_active_links = false;				
				$current_id = get_the_id(); 
				$id_classifier = $id_name;
				
				
				$menu_background_image = get_sub_field( 'menu_background_image' );
				$menu_background_image_url = $menu_background_image['url'];
				
				$html .= '<div class="dropdown-pane procedures-dropdown-pane" id="' . $id_name . '" data-dropdown data-hover="true" data-hover-pane="true" bottom animated fadeIn data-h-offset="100" data-options="closeOnClick:true; hover:true; hoverPane:true;  alignment:center; vOffset:10" style="background-image: url('. $menu_background_image_url .')">';
				$html .= '<button id="close-menu">X</button>';
				$html .= '<div class="grid-y  mega-menu-wrapper">';
			//	$html .= '<h2>' . $title . '</h2>';
				
				if ( have_rows( 'menu_items' ) ) : $ctr = 0;
					while ( have_rows( 'menu_items' ) ) : the_row(); $ctr++;
						$navigation_item_background_image = get_sub_field( 'navigation_item_background_image' );
						$navigation_item_background_image_url = $navigation_item_background_image['url'];
						
						$nav_item_title = get_sub_field( 'navigation_item_title' );					
						($ctr == 1) ? $active = "is-active" : $active = "" ;
						$html .= '<div class="cell auto cell-items parent-lvl-'.$ctr.' '.$active.'" id="'.$id_classifier.'-parent-lvl-'.$ctr.'">';
						
						
						if ( have_rows( 'navigation_item' ) ): $ctrtwo = 0;
						
							$html .= '<div class="menu-wrapper grid-x grid-padding-x "><div class="menu-label cell small-12"><div class="menu-label-bg"><div class="menu-label-img" style="background: url('. $navigation_item_background_image_url .')"></div><a href="#" title="'.$nav_item_title .'" class="parent-menu-link">'.$nav_item_title . '</a><div class="nav-container cell auto submenu is-dropdown-submenu">'; 
							//$html .= '<div class="nav-container cell auto">';
								
							while ( have_rows( 'navigation_item' ) ) : the_row(); $ctrtwo++;
							
								if ( get_row_layout() == 'navigation_menu_item' ) :
									$nav_item_name = get_sub_field( 'nav_item_name' );
									$post_object = get_sub_field( 'nav_item_link' );
									$state = "";
									
									
									if ( $post_object ):
										$post = $post_object;
										setup_postdata( $post );
										
										$post_id_num = $post->ID; 											
										$nav_item_link = get_the_permalink($post_id_num);
							             if($current_id == $post_id_num):							            		 	
					            		 	$state = "active";							            		 	
					            		 	$has_active_links = true; ?>
					            		 
					            		 <script>
				            		 		 jQuery(document).ready(function(){jQuery('#<?=$id_classifier?>-parent-lvl-<?=$ctr?>').addClass('active');});
				            		 	 </script>
					            		 						            
					            	<?php endif; 
							            wp_reset_postdata(); 
									endif;
									
										
									
									if ( get_sub_field( 'has_children' ) == 1 ) :
										$html .= '<div id="parent-lvl-'.$ctr.'-'.$ctrtwo.'" class="submenu '.$id_classifier.'-parent-lvl-'.$ctr.'-'.$ctrtwo.' menu-items has-nested-menu '.$state.'"><a href="#">'.$nav_item_name.'</a><div class="nested-menu-container">';
										if ( have_rows( 'nested_nav_item' ) ) :
											while ( have_rows( 'nested_nav_item' ) ) : the_row();
											$nested_post_obj = get_sub_field( 'nested_nav_item_link' );
											$nested_post_name = get_sub_field( 'nested_nav_item_name' );
											$state = "";
											
												if ( $nested_post_obj ):
													$post = $nested_post_obj;
													setup_postdata( $post );
													
													$post_id_num = $post->ID; 											
													$nav_item_link = get_the_permalink($post_id_num);
											          if($current_id == $post_id_num):							            		 	
								            		 	$state = "active";
								            		 	$has_active_links = true; ?>							            		 	
								            		 	<script>
								            		 		jQuery(document).ready(function(){ jQuery('#<?=$id_classifier?>-parent-lvl-<?=$ctr?>, #<?=$id_classifier?>-parent-lvl-<?=$ctr?>-<?=$ctrtwo?>').addClass('active');});
								            		 	 </script>            		 								            		
								            		<?php endif;     
											            wp_reset_postdata(); 
												endif;
													$html .= '<div class="menu-items nested-menu-items '.$state.'"><a href="'.$nav_item_link.'">'.$nested_post_name.'</a></div>';	
												
											endwhile;
										endif;
										$html .= '</div></div>'; // Close menu-item
										
									else:
										$html .= '<div id="'.$id_classifier.'-parent-lvl-'.$ctr.'-'.$ctrtwo.'" class="menu-items regular-menu-items '.$state.'"><a href="'.$nav_item_link.'">'.$nav_item_name.'</a></div>';
									endif; // end if has children
								endif;
							endwhile;
							// Close nav-container
							$html .= '</div></div></div>';
							// Close menu-wrapper
							$html .= '</div>';
						endif;
						// Close nav-items
						$html .= '</div>';
					endwhile;
				endif;
				
				// Close grid
				$html .= '</div>';
				// Close dropdown
				$html .= '</div>'; ?>		
					<?php if($has_active_links):  ?>
				    <script type="text/javascript">
			        (function($){
					   jQuery(document).ready(function(){						   
			                jQuery('#menu-desktop-menu li.<?=$id_name?>').addClass('active'); 
			                	                              		               			                      
			            });		
			        })(jQuery);
			    	</script>
			      <?php endif; ?>     
			<?php 		
			endwhile; ?>
	
				
		<?php endif;
		echo $html;
	}
	return $items;
}
