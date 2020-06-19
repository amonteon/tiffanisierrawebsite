<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

get_header(); 
get_template_part('parts/components/component', 'banner');

	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_subpage_type"); 
	$container_attr = "";
	$cell_attr = "small-12 medium-12 large-12"; 
	switch ($template_type) {
    case "two_col_grid":
      	$grid_attr ="grid-padding-x";
        $cell_attr = "small-12 medium-10 large-8"; 
        $container_attr = "grid-container";     
        break;
	}	    
?>

<div class="content" id="content">

	<div class="<?=$container_attr?>">	

		<div class="inner-content grid-x <?php echo $grid_attr; ?>">	

		    <main class="main cell <?php echo $cell_attr; ?>" role="main">			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loops/loop', 'page' ); ?>
				
					<!--  load flexible content -->
					<?php get_template_part( 'parts/components/component', 'flexible-content' ); ?>
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->

		    <?php if($template_type == "two_col_grid"): get_sidebar(); endif; ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end .grid-container -->

</div> <!-- end #content -->

<?php get_footer(); ?>