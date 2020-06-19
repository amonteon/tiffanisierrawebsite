<?php
/**
 * Displays archive pages if a speicifc template is not set. 
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header(); 
get_template_part('parts/components/component', 'banner');

	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_archive_type"); 
	$container_attr = "grid-container";
	switch ($template_type) {
    case "two_col_grid":
      	$grid_attr ="grid-padding-x";
        $cell_attr = "small-12 medium-10 large-8";      
        break;
    case "full_width_grid_10":
    	$grid_attr ="align-center grid-padding-x"; 
        $cell_attr = "small-12 medium-12 large-10";               
        break; 
    case "full_width_grid":
        $cell_attr = "small-12 medium-12 large-12";
        $grid_attr =  "grid-padding-x";       
        break;
    case "full_width_grid_nc":
        $cell_attr = "small-12 medium-12 large-12";
        $grid_attr =  "";
        $container_attr = "";       
		break;}	    	
?>

<div class="content" id="content">

	<div class="<?=$container_attr?>">		
		<div class="inner-content grid-x <?php echo $grid_attr; ?>">		
			<!-- endless-scroll -->
		    <main class="main cell <?php echo $cell_attr; ?>" role="main">
			  		    
					
		    	<?php 
			    /* Disabled for endless scrolling. left commented if it needs to be reverted to classic pagination */
				if (have_posts()) : while (have_posts()) : the_post();			
					//if  (is_post_type_archive('galleries')):
							// get_template_part( 'parts/loops/loop', 'archive-galleries' );	
					//else:
						get_template_part( 'parts/loops/loop', 'archive-excerpt' ); 
				//	endif;				    
				endwhile;
					joints_page_navi();				
				else :											
					get_template_part( 'parts/contents/content', 'missing' );						
				endif;  ?>
		
		
			</main> <!-- end #main -->
			
			<?php if($template_type == "two_col_grid"): get_sidebar(); endif; ?>
	    
	    </div> <!-- end #inner-content -->
	    
	</div> <!-- end #content -->

</div> <!-- end .grid-container -->

<?php get_footer(); ?>