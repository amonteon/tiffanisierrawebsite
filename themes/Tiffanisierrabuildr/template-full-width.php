<?php
/*
Template Name: Full Width (No Sidebar)
*/

get_header(); ?>

<?php get_template_part('parts/components/component', 'banner');?>

<div class="content" id="content">

	<div class="grid-container">	

		<div class="inner-content grid-x grid-padding-x">	

		    <main class="main small-12 cell" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loops/loop', 'page' ); ?>
				
					<!--  load flexible content -->
					<?php get_template_part( 'parts/components/component', 'flexible-content' ); ?>
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

</div> <!-- end .grid-container -->

<?php get_footer(); ?>