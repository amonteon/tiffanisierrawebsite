<?php
/*
Template Name: Reviews
*/

get_header(); ?>

<?php get_template_part('parts/components/component', 'banner');?>

<div class="content" id="content">

		<div class="inner-content">	

		    <main class="main" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			    	
			    	<?php get_template_part( 'parts/components/component', 'reviews' ); ?>
				
					<!--  load flexible content -->
					<?php get_template_part( 'parts/components/component', 'flexible-content' ); ?>
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>