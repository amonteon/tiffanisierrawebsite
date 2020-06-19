<?php
/**
 * Template part for displaying page content in page.php
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
        $container_attr = "grid-container";             
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

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
		<div class="<?=$container_attr ?> ">
			<div class="grid-x <?=$grid_attr?>">
				<div class="cell <?=$cell_attr?>">
				    <section class="entry-content" itemprop="articleBody">
					    <?php the_content(); ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
										    
					<?php comments_template(); ?>
				</div>
			</div>
		</div>
					
</article> <!-- end article -->