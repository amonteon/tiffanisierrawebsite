<?php 
/**
 * The template for displaying all single posts and attachments
 */

get_header(); 
get_template_part('parts/components/component', 'banner');

	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_archive_type"); 
	$container_attr = "";
	$cell_attr = "small-12 medium-12 large-12"; 
	switch ($template_type) {
    case "two_col_grid":
      	$grid_attr ="grid-padding-x align-center";
        $cell_attr = "small-12 medium-12 large-12"; 
        $container_attr = "grid-container";     
        break;
	}	    
?>

	<div class="content" id="content">
	    <main class="main cell endless-scroll <?php echo $cell_attr; ?>" role="main">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			  	
		    			<!--  load flexible content -->
				<?php get_template_part( 'parts/components/component', 'flexible-content' ); ?>
		    	
		    <?php endwhile; else : ?>
		
		   		<?php get_template_part( 'parts/contents/content', 'missing' ); ?>

		    <?php endif; ?>
		</main> <!-- end #main -->
</div> <!-- end . grid-container -->

<?php get_footer(); ?>