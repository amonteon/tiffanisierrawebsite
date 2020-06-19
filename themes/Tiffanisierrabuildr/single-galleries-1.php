<?php 
/* 
	default template for main Single Gallery Custom Post type
*/ 
get_header(); 
get_template_part('parts/components/component', 'banner');

	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_archive_type"); 
	$container_attr = "grid-container";
	switch ($template_type) {
    case "two_col_grid":
      	$grid_attr ="grid-padding-x align-center";
        $cell_attr = "small-12 medium-12 large-10";      
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

		    <main class="main cell endless-scroll <?php echo $cell_attr; ?>" role="main">
			
				 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loops/loop', 'single-gallery' ); ?>
		    		
		    <?php endwhile; else : ?>
		
		   		<?php get_template_part( 'parts/contents/content', 'missing' ); ?>

		    <?php endif; ?>
						
			    					
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

</div> <!-- end .grid-container -->

<?php get_footer(); ?>