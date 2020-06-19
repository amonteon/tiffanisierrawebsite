<?php	  

	
if( have_rows('flexible_section_fields') ):
  // loop through the rows of data
    while ( have_rows('flexible_section_fields') ) : the_row();

		if ( get_row_layout() == 'new_row'):
	
		$customID = get_sub_field( 'unique_id' );
		$customClass = get_sub_field('custom_classes');
		$data_attributes = get_sub_field('data_attributes');	
		$add_bg_images = get_sub_field('add_bg_images');
		$make_gradient = get_sub_field( 'make_it_gradient' );
		$type_of_row = get_sub_field('type_of_row');
		$add_column_padding = get_sub_field('add_column_padding');
		$bgImgs = get_sub_field('background_images');
		$fp_background_color = get_sub_field('fp_background_color');
		$fp_background_color_two = get_sub_field('fp_background_color_two');	
		$fp_background_color_three = get_sub_field('fp_background_color_three');	
		$fp_parallax_images = get_sub_field('fp_parallax_images');		
		$interchangeImgs = dataInterchangeImgs($bgImgs);	
		$type_of_parallax = get_sub_field('type_of_parallax');	 
		$change_font_color = get_sub_field( 'change_text_color' );
		$new_font_color = get_sub_field( 'new_text_color' );
		$add_caption_to_bg = get_sub_field( 'fp_add_caption' );
		$countr=0;
 
		?>		
		<section id="<?=$customID;?>" class="fp-section-wrapper <?php if($add_caption_to_bg == true): ?> add-caption-to-bg <?php endif;?>">			
				<div class="fp-sections fp-section-background <?php if($fp_parallax_images): echo $type_of_parallax; endif;?>"  <?php if($add_bg_images): ?>data-interchange="<?=$interchangeImgs?>"<?php endif; ?>  <?php if(($add_bg_images && $make_gradient) == true): ?>style="background:linear-gradient(to right, <?=$fp_background_color;?>,<?=$fp_background_color_two;?>,<?=$fp_background_color_three;?> " <?php elseif($add_bg_images): ?>style="background:<?=$fp_background_color?>; background-repeat: no-repeat; background-size: cover;" <?php endif; ?> <?=$data_attributes?> >			 <div class="<?=$type_of_row?>">
					<div class="grid-x align-center align-middle <?=$customClass;?> <?=$add_column_padding?>" >
					<?php if( have_rows('columns') ):?>		
						<?php while ( have_rows('columns') ) : the_row(); ?>			
							<?php 
								// $add_slider = get_sub_field('add_slider');
								
								$colClasses = get_sub_field('custom_classes');
								$column_data_attribute = get_sub_field('column_data_attribute');
								$smCol = get_sub_field('sm_size');
								$mdCol = get_sub_field('md_size');
								$xmdCol = get_sub_field('xmd_size');							
								$lgCol = get_sub_field('lg_size');
								$xlgCol = get_sub_field('xlg_size');														
								
								$colContent = get_sub_field('column_content');
								$add_content = get_sub_field('add_content');							
								
								$add_background_image = get_sub_field('add_background_image');
								$background_image_cell = get_sub_field('background_image_cell');
								$interchangeImgInternal = dataInterchangeImgs($background_image_cell);
								$invert_slider= get_sub_field( 'invert_slider' );
								
									
							?>
							<div class="cell align-middle <?php if($change_font_color): ?> new-font-styles <?php endif;?> <?=$colClasses;?> small-<?=$smCol;?> medium-<?=$mdCol;?> xmedium-<?=$xmdCol;?> large-<?=$lgCol;?> xlarge-<?=$xlgCol?>"	<?=$column_data_attribute?> <?php if($background_image_cell && $add_background_image): ?> style="height:100%; background-size: cover; background-repeat: no-repeat;" <?php endif; ?>>
								<div class="cell-background align-middle" <?php if($background_image_cell && $add_background_image): ?> data-interchange="<?=$interchangeImgInternal?>" style="height:100%; background-repeat: no-repeat; background-size: cover;" <?php endif; ?><?php if($change_font_color): ?> style="color:<?=$new_font_color;?>;"<?php endif;?> >
																	
									<?php
										// check if the flexible content field has rows of data
										if( have_rows('add_content_column') ):									
										     // loop through the rows of data
										    while ( have_rows('add_content_column') ) : the_row();	$countr++;								
										        if( get_row_layout() == 'content_slider' ):		
										        	$column_slider_id = get_sub_field('column_slider_id');
										        	$slider_title = get_sub_field( 'section_title' );
										        	$slider_subheading = get_sub_field( 'content_slider_subheading' );
										        	$read_more_link = get_sub_field( 'read_more_link' );
													if(have_rows('content_slider_inner')): $ctr = 0; ?>
														<div class="fp-slider-container grid-container align-middle">
															<div class="grid-x grid-padding-x align-center align-middle">
																<div class="cell small-12 medium-10 large-5">
																	<span class="subheading text-center"><?=$slider_subheading;?></span>
																	<h2 class="text-center reviews-slider-title"><?=$slider_title; ?></h2>
																</div>
																<div class="cell small-12 medium-12 large-10">
																	<div class="swiper-container align-middle" id="<?=$column_slider_id?>">
																		<div class="swiper-wrapper">
																			<?php while(have_rows('content_slider_inner')): the_row(); 
																				$content = get_sub_field('content'); ?>
																				<div class="swiper-cell carousel-cell">
																					<div class="fp-carousel-slide-container text-center">
																						<div class="inner-slider-content">
																							<?=$content; ?>
																						</div>
																					</div>
																				</div>
																			<?php endwhile; ?>
																		</div>
																	</div>
																</div>
																<div class="cell small-10 medium-10 large-3 reviews-button-cell">
																		<?php if ( $read_more_link ) { ?>
																			<a class="button hollow white reviews-button" href="<?php echo $read_more_link['url']; ?>" target="<?php echo $read_more_link['target']; ?>"><?php echo $read_more_link['title']; ?></a>
																		<?php } ?>
																</div>
															</div>
														</div>
													<?php endif; ?>		
											<?php elseif ( get_row_layout() == 'images_slider' ) : ?>
											<div class="hp-images-slider grid-container">
												<div class="grid-x grid-padding-x">
													<div class="cell">
														<?php if ( have_rows( 'images_slider' ) ) :  ?>
															<div class="hp-images-slider hp-images-slider-<?=$countr;?>">
																<div class="swiper-wrapper">
																	<?php while ( have_rows( 'images_slider' ) ) : the_row();?>
																		<?php $image_image = get_sub_field( 'image_image' ); ?>
																		<div class="swiper-slide">
																			<?php if ( $image_image ) { ?>
																				<img src="<?php echo $image_image['url']; ?>" alt="<?php echo $image_image['alt']; ?>" />
																			<?php } ?>
																		</div>
																	<?php endwhile; ?>
																</div>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</div> 										
										     <?php  elseif( get_row_layout() == 'wysiwyg_editor' ): 					        										        								$cell_content = get_sub_field('cell_content');	
										        	if($cell_content): echo $cell_content; endif;							
										        endif;									
										    endwhile;									
										else :									
										    // no layouts found									
										endif;									
									?>
									
								
								
								</div>
							</div>			
								
						<?php endwhile;?>						
					<?php endif;?>		
					</div>
				</div>
			</div>		
		</section>	


		<?php elseif ( get_row_layout() == 'fp_card_slider' ) : $count=0; ?>
		<section class="fp-card-section grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell auto">
					<?php if ( have_rows( 'card_content' ) ) : ?>
						<div class="fp-image-card-slider fp-image-card-slider-<?=$count;?>">
							<div class="swiper-wrapper">
								<?php while ( have_rows( 'card_content' ) ) : the_row(); $count++; ?>
									<div class="swiper-slide">
										<div class="card-image">
											<?php $card_image = get_sub_field( 'card_image' ); ?>
											<?php if ( $card_image ) { ?>
												<img src="<?php echo $card_image['url']; ?>" alt="<?php echo $card_image['alt']; ?>" />
											<?php } ?>
										</div>
										<div class="card">
											<div class="inner-card-content">
												<span class="card-title"><?php the_sub_field( 'card_title' ); ?></span>
												<?php the_sub_field( 'card_inner_content' ); ?>
											</div>
										</div>
										
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
				</div>
			</div>
		</section>


		<?php elseif ( get_row_layout() == 'reviews_grid' ) : ?>
		<section class="fp-reviews-section grid-container">
			<div class="grid-x grid-padding-x align-center align-middle hp-reviews-container">
				<div class="cell small-12 medium-10 large-12">
					<div class="grid-x">
						<div class="cell small-12 xmedium-6 reviews-heading">
							<span class="subheading"><?php the_sub_field( 'fp_reviews_subtitle' ); ?></span>

							<h2><?php the_sub_field( 'fp_reviews_heading' ); ?></h2>
							<div class="reviews-desc"><?php the_sub_field( 'reviews_description' ); ?></div>
						</div>
						
						<div class="cell small-12 xmedium-6 reviews-img-cell">
							<?php $reviews_image_images = get_sub_field( 'reviews_image' );
									$interchangeImgInternal = dataInterchangeImgs($reviews_image_images); ?>
									<div class="reviews-image" data-interchange="<?=$interchangeImgInternal?>" style="height:100%; background-repeat: no-repeat; background-size: contain; background-position:right;"></div>
						</div>
						<div class="cell small-12 xmedium-6 reviews-heading-mobile hide-for-xmedium">
							<div class="reviews-desc-mobile"><?php the_sub_field( 'reviews_description' ); ?></div>
						</div>
						<div class="cell small-12 xmedium-12 large-7 review-quote-cell">
							<div class="review-quote">
								<?php the_sub_field( 'review_quote' ); ?>
							</div>
							<?php $reviews_link = get_sub_field( 'reviews_link' ); ?>
							<?php if ( $reviews_link ) { ?>
								<a class="other-links" href="<?php echo $reviews_link['url']; ?>" target="<?php echo $reviews_link['target']; ?>"><?php echo $reviews_link['title']; ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<?php elseif ( get_row_layout() == 'hp_fifty_fifty' ) : ?>
			<section class="hp-fifty-fifty-section">
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center align-middle hp-fifty-container">
						
						<div class="cell small-12 xmedium-6 large-6 fifty-image-cell">
							<div class="fifty-img-container">
							<?php if ( have_rows( 'content_left' ) ) : ?>
								<?php while ( have_rows( 'content_left' ) ) : the_row(); ?>
									<?php $video_placeholder_image = get_sub_field( 'video_placeholder_image' ); ?>
									<?php if ( $video_placeholder_image ) { ?>
										<img src="<?php echo $video_placeholder_image['url']; ?>" alt="<?php echo $video_placeholder_image['alt']; ?>" />
									<?php } ?>
									<?php $video_play_button_link = get_sub_field( 'video_play_button_link' ); ?>
									<?php if ( $video_play_button_link ) { ?>
										<a class="button white rounded" href="<?php echo $video_play_button_link['url']; ?>" target="<?php echo $video_play_button_link['target']; ?>"><?php echo $video_play_button_link['title']; ?></a>
									<?php } ?>
								<?php endwhile; ?>
							<?php endif; ?>
							</div>
						</div>

						<div class="cell small-12 xmedium-6 large-6 fifty-content-cell">
							<?php if ( have_rows( 'content_right' ) ): ?>
								<?php while ( have_rows( 'content_right' ) ) : the_row(); ?>
									<?php if ( get_row_layout() == 'content_fields' ) : ?>
										<span class="subheading"><?php  the_sub_field( 'content_subheading' ); ?></span>
										<h2><?php the_sub_field( 'content_heading' ); ?></h2>
										<?php the_sub_field( 'content' ); ?>
										<?php $content_link = get_sub_field( 'content_link' ); ?>
										
										<a class="other-links" href="<?php echo $content_link['url']; ?>" target="<?php echo $content_link['target']; ?>"><?php echo $content_link['title']; ?></a>
									
									<?php endif; ?>
								<?php endwhile; ?>
							<?php else: ?>
								<?php // no layouts found ?>
							<?php endif; ?>
						</div>
					</div>
				</div>	
			</section>
			

			
		<?php endif;?>		
	<?php endwhile; ?>	
<?php else : ?>

no layouts found

<?php  // no layouts found
endif; ?>



  