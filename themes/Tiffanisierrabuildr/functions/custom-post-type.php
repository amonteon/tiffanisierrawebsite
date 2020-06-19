<?php
/* FmBuilder3.0 Custom Post Types

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.


DELETE THE ONES YOU DONT NEED.

*/

// let's create the function for the custom type
function procedure_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'procedure_post', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Procedures', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Procedure', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Procedures', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New Procedure', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Procedures', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit Procedure', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Procedure', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Procedure', 'jointswp'), /* New Display Title */
			'view_item' => __('View Procedure', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Procedure', 'jointswp'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example service post type', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-universal-access-alt', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'procedures', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'procedures', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',  'page-attributes' , 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'procedure_post');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'procedure_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'procedure_cat', 
    	array('procedure_post'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Procedure Categories', 'jointswp' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Procedure Category', 'jointswp' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Procedure Categories', 'jointswp' ), /* search title for taxomony */
    			'all_items' => __( 'All Procedure Categories', 'jointswp' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Procedure Category', 'jointswp' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Procedure Category:', 'jointswp' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Procedure Category', 'jointswp' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Procedure Category', 'jointswp' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Procedure Category', 'jointswp' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Procedure Category Name', 'jointswp' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'procedure-category' ),
    	)
    );   
    

    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */








// let's create the function for the custom type
function service_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'service_post', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Services', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Service', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Services', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New Service', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Services', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit Service', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Service', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Service', 'jointswp'), /* New Display Title */
			'view_item' => __('View Service', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Service', 'jointswp'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example service post type', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-universal-access-alt', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'services', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'services', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',  'page-attributes' , 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'service_post');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'service_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'service_cat', 
    	array('service_post'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Service Categories', 'jointswp' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Service Category', 'jointswp' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Service Categories', 'jointswp' ), /* search title for taxomony */
    			'all_items' => __( 'All Service Categories', 'jointswp' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Service Category', 'jointswp' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Service Category:', 'jointswp' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Service Category', 'jointswp' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Service Category', 'jointswp' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Service Category', 'jointswp' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Service Category Name', 'jointswp' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'service-category' ),
    	)
    );   
    

    
    