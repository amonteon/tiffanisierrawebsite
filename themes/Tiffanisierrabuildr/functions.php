<?php
/** 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */			
	
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php'); 

// Adds custom acf widgets to theme
require_once(get_template_directory().'/functions/theme-widgets.php'); 

// Adds site styles to the WordPress editor
require_once(get_template_directory().'/functions/editor-styles.php'); 

// Remove 4.2 Emoji Support
require_once(get_template_directory().'/functions/disable-emoji.php'); 

// add buttons to mce in content editor
require_once(get_template_directory().'/functions/additional-mce-buttons.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Customize the WordPress login menu
require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
require_once(get_template_directory().'/functions/admin.php'); 