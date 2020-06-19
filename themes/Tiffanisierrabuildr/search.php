<?php 
/**
 * The template for displaying search results pages
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
get_header(); 
get_template_part('parts/components/component', 'banner');

	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_subpage_type"); 
	switch ($template_type) {
    case "two_col_grid":
      	$grid_attr ="";
        $cell_attr = "small-12 medium-8 large-8";      
        break;
    case "full_width_grid_10":
    	$grid_attr ="align-center"; 
        $cell_attr = "small-12 medium-10 large-10";               
        break; 
    case "full_width_grid":
        $cell_attr = "small-12 medium-12 large-12";
        $grid_attr =  "";       
        break;}		
?>

<div class="content">
	
	<div class="grid-container">

		<div class="inner-content grid-x grid-padding-x <?php echo $grid_attr; ?>">
	
			<main class="main cell endless-scroll <?php echo $cell_attr; ?>" role="main">

				<?php 
/*
					if (have_posts()) : while (have_posts()) : the_post(); 
					 	get_template_part( 'parts/loops/loop', 'archive' ); 					 
					  endwhile; 					  
					  	joints_page_navi();  
					  else :					  
					  get_template_part( 'parts/contents/content', 'missing' ); 
					endif;
*/ 
					?>
	
		    </main> <!-- end #main -->
		
		    <?php if($template_type == "two_col_grid"): get_sidebar(); endif; ?>
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

</div> <!-- end . grid-container -->

<?php get_footer(); ?>
