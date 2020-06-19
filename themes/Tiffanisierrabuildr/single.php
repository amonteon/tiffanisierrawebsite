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
        $cell_attr = "small-12 medium-12 large-8"; 
        $container_attr = "grid-container";     
        break;
	}	    
?>

<div class="content" id="content">

	<div class="<?=$container_attr?>">	

		<div class="inner-content grid-x <?php echo $grid_attr; ?>">	
			<div class="cell small-12 medium-12 large-12">
				<div class="grid-x grid-padding-x align-center">
					
				    <main class="main cell endless-scroll <?php echo $cell_attr; ?>" role="main">
						
						<?php   $categories = get_categories(); ?>
						 <div class="grid-x grid-padding-x cat-links-container hide-for-large">
							<div class="cell small-12 large-12 links-cell">
								<div class="cat-container">
									<button class="button cat-select-btn" type="button" data-toggle="cat-dropdown">Choose a Category</button>
									<div class="cat-pane-wrapper">
										<div class="dropdown-pane cat-link-pane bottom" id="cat-dropdown" data-dropdown  data-position="bottom" data-alignment="left">
											 <?php foreach($categories as $c): ?>
											 	 <?php  $cat = get_category( $c );?>
											 	 <?php  $cat_id = get_cat_ID( $cat->name ); ?>
											 	 <?php  echo '<li><a class="other-links" href="'.get_category_link($cat_id).'" data-smooth-scroll data-offset="200">'.$cat->name.'</a></li>';?>
											<?php endforeach; ?>	
										</div>
									</div>
								</div>
							</div>
						 </div>
						
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					    	<?php get_template_part( 'parts/loops/loop', 'single' ); ?>
					    	
					    			<!--  load flexible content -->
							<?php get_template_part( 'parts/components/component', 'flexible-content' ); ?>
					    	
					    <?php endwhile; else : ?>
					
					   		<?php get_template_part( 'parts/contents/content', 'missing' ); ?>
			
					    <?php endif; ?>
						
						<section class="three-img-block-section anchor-link-section">
							<div class="grid-container">
								<div class="grid-x grid-padding-x three-img-block-grid-container align-middle align-center hide-for-large">
									<div class="cell small-12 large-10">
										<div class="grid-x grid-padding-x align-middle align-center text-center cell-background">
											<?php if ( have_rows( 'three_image_block_wrapper', 'option' ) ) : ?>
												<div class="swiper-container">
													<div class="swiper-wrapper">
														<?php while ( have_rows( 'three_image_block_wrapper', 'option' ) ) : the_row(); ?>
															<div class="swiper-slide">	
																<?php $image_title = get_sub_field( 'title' ); ?>
																<?php $block_link = get_sub_field( 'block_link' ); ?>
																<?php $image = get_sub_field( 'image' ); ?>
																<a href="<?php echo $block_link['url']; ?>" target="<?php echo $block_link['target'];?>" title="<?=$block_link['title'];?>">
																	<div class="image-block-image"><img class="cell" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
																	<div class="image-block-title"><?php echo $image_title; ?></div>
																	<div class="image-block-button hollow button primary rounded"><?php echo $block_link['title']; ?></div>
																</a>
															</div>
														<?php endwhile; ?>
													</div>
													<div class="swiper-scrollbar"></div>
												</div>
											<?php else : ?>
												<?php // no rows found ?>
											<?php endif; ?>
										</div>
									</div>		
								</div>	
							</div>
						</section>
					</main> <!-- end #main -->
			
					<?php if($template_type == "two_col_grid"): get_sidebar(); endif; ?>
				</div>
			</div>
	
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

</div> <!-- end . grid-container -->

<?php get_footer(); ?>