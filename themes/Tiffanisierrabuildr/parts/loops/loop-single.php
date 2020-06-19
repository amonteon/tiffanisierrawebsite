<?php
/**
 * Template part for displaying a single post
 */
 
 	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	$template_type = get_theme_mod("tiffanibuildr_subpage_type"); 
	$container_attr = "";
	$cell_attr = ""; 
	
	switch ($template_type) {
	
	/****
		USE this variables when making a new flexible field
	****/
		
    case "full_width_grid_10":
    	$grid_attr ="align-center grid-padding-x"; 
        $cell_attr = "small-12 medium-12 large-10";  
        $container_attr = "";             
        break; 
    case "full_width_grid":
        $cell_attr = "small-12 medium-12 large-12";
        $grid_attr =  "grid-padding-x"; 
        $container_attr = "grid-container";       
        break;
    case "full_width_grid_nc":
        $cell_attr = "small-12 medium-12 large-12";
        $grid_attr =  "";
        $container_attr = "";       
		break;
	}
 
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		<div class="<?=$container_attr ?> ">
			<div class="grid-x <?=$grid_attr?>">
				<div class="cell small-12 medium-12 large-12">					
				    <section class="entry-content" itemprop="articleBody">
						
						<h3><?php the_title(); ?></h3>
						<p class="blog-date"><?php echo get_the_date(); ?></p>
						<?php the_content(); ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
					</footer> <!-- end article footer -->
										
					<?php comments_template(); ?>	
				</div>
			</div>	
		</div>		
													
</article> <!-- end article -->