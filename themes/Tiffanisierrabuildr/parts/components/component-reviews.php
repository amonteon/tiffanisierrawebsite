<?php 
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
        $cell_attr = "small-12 medium-12 xmedium-10 large-10";  
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
<?php if ( have_rows( 'reviews' ) ): ?>
	<?php while ( have_rows( 'reviews' ) ) : the_row(); ?>	
		<?php if ( get_row_layout() == 'read_more_buttons' ) : ?>		
			<?php if ( have_rows( 'read_more_buttons' ) ) : ?>
				<section class="reviews-content-buttons">
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-center">
							<div class="cell small-12">
								<div class="grid-x grid-padding-x align-center text-center">
									<?php while ( have_rows( 'read_more_buttons' ) ) : the_row(); ?>
										
										<?php $read_more_link = get_sub_field( 'read_more_link' ); ?>
										<?php if ( $read_more_link ) { ?>
											<div class="cell small-12 medium-6 large-3 reviews-cell">
												<a class="button rounded primary reviews-btn" href="<?php echo $read_more_link['url']; ?>" target="<?php echo $read_more_link['target']; ?>"><?php echo $read_more_link['title']; ?></a>
											</div>
										<?php } ?>
										
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>