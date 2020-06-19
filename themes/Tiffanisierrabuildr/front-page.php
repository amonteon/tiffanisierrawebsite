<?php get_header(); ?>
	<?php get_template_part( 'parts/components/component' , 'frontpage-banner');?>
	<section id="fp-content" class="fp-content" style="min-height:2000px; background-color:white; z-index:10;">
		<?php get_template_part( 'parts/components/component' , 'frontpage-flexible');?>	
	</section> 
<?php get_footer(); ?>