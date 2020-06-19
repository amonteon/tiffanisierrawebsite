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
	if( is_single() ):
		$grid_attr = "align-center grid-padding-x";
		$container_attr = "";
		$cell_attr = "cell small-12 medium-12 large-12";
		endif;
	if(is_singular('procedure_post')):
		$grid_attr = "align-center grid-padding-x";
		$container_attr = "grid-container";
		$cell_attr = "cell small-12 medium-12 xmedium-12 large-10";
	endif;

	/****
		These fields are used to tag IDs on each flexible field category
	****/
	
	$column_grid_images = 0;
	$three_column = 0;
	$full_width_content = 0;
	$full_width_content_text_only = 0;
	$fifty_fifty_content = 0;
	$four_eight_content = 0; 
	$eight_four_content = 0;
	$accordion = 0; 
	$tabbed_content = 0;
	$image_slider = 0;
	$content_slider = 0;
	$video_content = 0;
	$horizontal_divider = 0;
	$contact_form_widget_ctr = 0;
	$eightColContentCount = 0;
	
	
	if( have_rows('flexible_page_sections') ): $tag = 0; ?>
			
	<?php while ( have_rows('flexible_page_sections') ) : the_row(); $tag++;?>

        <?php if ( get_row_layout() == 'column_grid_images'): $column_grid_images++; ?>
			<?php 
				$smallUp  = get_sub_field('small_up');
				$mediumUp  = get_sub_field('medium_up');
				$largeUp  = get_sub_field('large_up');
				$title = get_sub_field('grid_section_title');
			?>
			<div class="<?=$container_attr ?> flexible-field-<?=$tag?>" id="column-grid-images-<?=$column_grid_images?>">
				<div class="grid-x <?=$grid_attr?>">
					<div class="cell <?=$cell_attr?>">	
						<h2><?=$title;?></h2>				
						<div class="grid-x grid-padding-x grid-padding-y small-up-<?=$smallUp;?> xmedium-up-<?=$mediumUp;?> large-up-<?=$largeUp;?> grid-image-cols">	
							<?php 
							$colImgs  = get_sub_field('col_grid_images');
							
							if( $colImgs ): ?>
								<div class="swiper-interior-logo-container">
									<div class="swiper-wrapper">													
										<?php while ( have_rows( 'col_grid_images' ) ) : the_row(); ?>
											<div class="swiper-slide">	
												<?php $grid_image = get_sub_field( 'grid_image' ); ?>
												<?php if ( $grid_image ) : ?>
											
													<div class="cell grid-image-wrapper">
														<img src="<?php echo $grid_image['url']; ?>" alt="<?php echo $grid_image['alt']; ?>"  width="<?=$grid_image['width'];?>" height="<?=$grid_image['height'];?>" class="image-grid-img"/>
													</div>	
												<?php endif; ?>
											</div>
										<?php endwhile; ?>
									</div>
								</div>
								
							<?php endif; ?>				
						</div>
					</div>
				</div>
			</div>
        <?php elseif ( get_row_layout() == 'three_column'): $three_column++;?>

			<?php 
			$colOne = get_sub_field('column_one');
			$colTwo = get_sub_field('column_two');
			$colThree = get_sub_field('column_three');
			?>
			<div class="<?=$container_attr ?> flexible-field-<?=$tag?>" id="three-col-<?=$three_column?>">
				<div class="grid-x <?=$grid_attr?>">
					<div class="cell <?=$cell_attr?>">		
						<div class="grid-x grid-padding-x entry-content">
							<div class="cell small-12 xmedium-4">
								<?=$colOne;?>
							</div>
							<div class="cell small-12 xmedium-4">
								<?=$colTwo;?>
							</div>
							<div class="cell small-12 xmedium-4">
								<?=$colThree;?>
							</div>												
						</div>
					</div>
				</div>	
			</div>     
        <?php elseif( get_row_layout() == 'full_width_content' ): $full_width_content++; ?>
			<?php 
			$fullWidthContent = get_sub_field('full_width_content_area');
			$custom_css_name = get_sub_field('custom_css_name');
			$add_background_image = get_sub_field('add_background_image');
			$invert_colors = get_sub_field('invert_colors');
			$background_image = get_sub_field('background_image');
			$background_color = get_sub_field('background_color');
			$dataInterchangeBG = "";
			if($add_background_image && $background_image ): 
				$dataInterchangeBG = dataInterchangeImgs($background_image);
			endif;						
			
			?>
				<style>		
					<?php if($invert_colors): ?>		
					#full-width-content-<?=$full_width_content?> h1,
					#full-width-content-<?=$full_width_content?> h2,
					#full-width-content-<?=$full_width_content?> h3,
					#full-width-content-<?=$full_width_content?> h4,
					#full-width-content-<?=$full_width_content?> h5,
					#full-width-content-<?=$full_width_content?> h6,
					#full-width-content-<?=$full_width_content?> p { 
						color:white;
					}
					<?php endif; ?>
					
					<?php if($background_color): ?>
					#full-width-content-<?=$full_width_content?> {
						background-color:<?=$background_color?>
					}
					<?php endif; ?>
				</style>			
		
				<div id="full-width-content-<?=$full_width_content?>" <?php if($dataInterchangeBG || $background_color != "#ffffff"): echo 'class="inner-bg-image flexible-field-'.$tag.'" data-interchange="'.$dataInterchangeBG.'"'; else: echo 'class="fullwidthVisual flexible-field-'.$tag.'"'; endif; ?>>
					<div class="<?=$container_attr ?> ">
						<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
							<div class="cell <?=$cell_attr?>">										
								<div class="grid-x entry-content">
									<div class="cell small-12">
										<?=$fullWidthContent;?>
									</div>
								</div>
							</div>
						</div>
					</div>		
				</div>


		<?php elseif ( get_row_layout() == 'full_content_grid' ) : ?>


			<?php
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
				$interchangeImgs = dataInterchangeImgs($bgImgs);	
				$change_font_color = get_sub_field( 'change_text_color' );
				$new_font_color = get_sub_field( 'new_text_color' );
				$countr=0;
			?>
			<section id="<?=$customID;?>" class="content-section-wrapper">			
				<div class="fp-sections fp-section-background"  <?php if($add_bg_images): ?>data-interchange="<?=$interchangeImgs?>"<?php endif; ?>  <?php if(($add_bg_images && $make_gradient) == true): ?>style="background:linear-gradient(to bottom, <?=$fp_background_color;?>,<?=$fp_background_color_two;?> " <?php elseif($add_bg_images): ?>style="background:<?=$fp_background_color?>; background-repeat: no-repeat; background-size: cover;" <?php endif; ?> <?=$data_attributes?> >
					<div class="<?=$type_of_row?> content-grid-container">
						<div class="grid-x align-center align-middle <?=$customClass;?> <?=$add_column_padding?>" >
							<?php if ( have_rows( 'columns' ) ) : ?>


								<?php while ( have_rows( 'columns' ) ) : the_row(); ?>
									<?php 									
										$colClasses = get_sub_field('custom_classes');
										$column_data_attribute = get_sub_field('column_data_attribute');
										$smCol = get_sub_field('sm_size');
										$mdCol = get_sub_field('md_size');
										$xmdCol = get_sub_field('xmd_size');							
										$lgCol = get_sub_field('lg_size');
										$xlgCol = get_sub_field('xlg_size');														
										$removeBttmPadding = get_sub_field('remove_bottom_padding');
										$colContent = get_sub_field('column_content');
										$add_content = get_sub_field('add_content');							
										
										$add_background_image = get_sub_field('add_background_image');
										$background_image_cell = get_sub_field('background_image_cell');
										$interchangeImgInternal = dataInterchangeImgs($background_image_cell);
										$invert_slider= get_sub_field( 'invert_slider' );			
									?>

							<div class="cell align-middle <?php if($change_font_color): ?> new-font-styles <?php endif;?> <?php if($removeBttmPadding):?> removeBottmPadding <?php endif; ?> <?=$colClasses;?> small-<?=$smCol;?> medium-<?=$mdCol;?> xmedium-<?=$xmdCol;?> large-<?=$lgCol;?> xlarge-<?=$xlgCol?>"	<?=$column_data_attribute?> <?php if($background_image_cell && $add_background_image): ?> style="height:100%; background-size: cover; background-repeat: no-repeat;" <?php endif; ?>>
										<div class="cell-background align-middle" <?php if($background_image_cell && $add_background_image): ?> data-interchange="<?=$interchangeImgInternal?>" style="height:100%; background-repeat: no-repeat; background-size: cover;" <?php endif; ?><?php if($change_font_color): ?> style="color:<?=$new_font_color;?>;"<?php endif;?> >
										
											<?php if ( have_rows( 'add_content_column' ) ): ?>
												<?php while ( have_rows( 'add_content_column' ) ) : the_row();?>
													<?php if ( get_row_layout() == 'wysiwyg_editor' ) : ?>
														<?php the_sub_field( 'cell_content' ); ?>
													<?php endif; ?>
												<?php endwhile; ?>
											<?php else: ?>
												<?php // no layouts found ?>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif;?>
						</div>
					</div>
				</div>
			</section>

        <?php  elseif( get_row_layout() == 'fifty_fifty_content' ): $fifty_fifty_content++; ?>
			<?php 
			$ffContentLeft = get_sub_field('content_left');
			$ffContentRight = get_sub_field('content_right');
			$custom_css_name = get_sub_field('custom_css_name');	
							
			?>
			
			<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="fifty-fifty-content-<?=$fifty_fifty_content?>">
				<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
					<div class="cell <?=$cell_attr?>">	
						<div class="grid-x grid-padding-x entry-content" >
						<?php 
							$cellBGColor = get_sub_field( 'background_color' ); 
							$cellTxtColor = get_sub_field( 'text_color' );
						?>
							<div class="cell small-12 xmedium-6 fifty-content-left-cell" style="<?php if ( get_sub_field( 'add_background_color' ) == 1 ): ?> background-color: <?= $cellBGColor;?>;<?php endif;?> <?php if ( get_sub_field( 'change_text_color' ) == 1 ) : ?>color:<?=$cellTxtColor;?><?php endif;?>">
								<div class="fifty-content-left">
									<?=$ffContentLeft;?>

									<?php if ( get_sub_field( 'add_button' ) == 1 ) : ?>
										<?php $button_link = get_sub_field( 'button_link' ); ?>
										<?php if ( $button_link ) : ?>
											<a class="button primary rounded" href="<?php echo $button_link['url']; ?>" target="<?php echo $button_link['target']; ?>"><?php echo $button_link['title']; ?></a>
										<?php endif; ?>
									<?php endif; ?>
								</div>
									
							</div>
							<div class="cell small-12 xmedium-6 fifty-content-right-cell">
								<?=$ffContentRight;?>
							</div>
						</div>
					</div>
				</div>
			</div>		
			
		
		<?php elseif(get_row_layout() == 'three_image_block_layout'): ?>

			<section class="three-img-block-section">
				<div class="grid-container">
					<div class="grid-x grid-padding-x three-img-block-grid-container align-middle align-center">
						<div class="cell small-12 large-10">
							<div class="grid-x grid-padding-x align-middle align-center text-center cell-background">
								<?php if ( have_rows( 'image_block_wrapper') ) : ?>
									<div class="swiper-container">
										<div class="swiper-wrapper">
											<?php while ( have_rows( 'image_block_wrapper' ) ) : the_row(); ?>
												<div class="swiper-slide">	
													<?php $image_title = get_sub_field( 'title' ); ?>
													<?php $block_link = get_sub_field( 'block_link' ); ?>
													<?php $image = get_sub_field( 'image' ); ?>
													<a href="<?php echo $block_link['url']; ?>" target="<?php echo $block_link['target'];?>" title="<?=$block_link['title'];?>">
														<div class="image-block-image"><img class="cell" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
														<div class="image-block-dec card">
															<div class="inner-card-content">
																<span class="image-title"><?php echo $image_title; ?></span>
																<?php the_sub_field( 'block_description' ); ?>														
															</div>
														</div>
														
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
		<?php elseif (get_row_layout() == 'image_slider'): $image_slider++; ?>
			<?php 
				$slideshow_title = get_sub_field('slideshow_title');
				$enable_arrows = get_sub_field('enable_arrows');
				$enable_dots = get_sub_field('enable_dots');		        		       
				$enable_scrollbar = get_sub_field('enable_scrollbar');
		        		        
/*
				$enable_captions = get_sub_field('enable_captions');
		        $arrows  = ($enable_arrows ? "true" : "false"); // returns true
		        $dots  = ($enable_dots ? "true" : "false"); // returns true		       
		        $adapt = ($adaptive_height ? "true" : "false"); // returns true
		        $wrap  = ($wrap_around ? "true" : "false"); // returns true
				$the_cell_width = ($cell_width == "specify" ? get_sub_field('specify_width'): $cell_width ); 
*/
				
				?>
			<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="image-slide-<?=$image_slider?>">	
				<div class="grid-x <?=$grid_attr?>">
					<div class="cell <?=$cell_attr?> sub-page-swiper-cell">					
					<?php if($slideshow_title): ?><h2><?php echo get_sub_field('slideshow_title');?></h2><?php endif; ?>				
						<?php  $images = get_sub_field('slides'); 						
							if( $images ): ?>
							<?php $slc = 0; ?>
							<div class="sub-page-carousel swiper-container" id="img-slider-<?=$image_slider?>" >
									<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
									<?php foreach( $images as $image ): $slc++; ?>
										<div class="swiper-slide">						               
										<img src="<?php echo $image['url']; ?>" style="width:100%" alt="<?php echo $image['alt']; ?>" />
										
											<?php if($enable_captions):?>
												<?php if($image['caption']): ?>
													<div class="slide-caption animated fadeInUp text-center" id="slide-caption-<?=$randId?>"><?php echo $image['caption']; ?></div>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
								
								<?php if($enable_dots): ?>
									<!-- If we need pagination -->
									<div class="swiper-pagination"></div>
								<?php endif; ?>	
							

								<?php if($enable_scrollbar): ?>								 
									<!-- If we need scrollbar -->
									<div class="swiper-scrollbar"></div> 
								<?php endif; ?>
									
							</div>
								<!-- If we need navigation buttons -->
								<?php if($enable_arrows): ?>
									<div class="swiper-button-prev content-btn-prev"></div>
									<div class="swiper-button-next content-btn-next"></div>
								<?php endif; ?>	
							<?php endif; ?>
					</div>
				</div>
			</div>
			
			<script type="text/javascript">	
				window.addEventListener( 'load', function() {				
					var carouselImg<?=$image_slider?> = jQuery('#img-slider-<?=$image_slider?>');
						var mySwiper = new Swiper('#img-slider-<?=$image_slider?>', {						   
							// Optional parameters
							direction: 'horizontal',
							loop: true,
							autoHeight: true,
							slidesPerView: 1,
							spaceBetween: 10,
							
							 // If we need pagination
						    pagination: {
						      el: '.swiper-pagination',
						      clickable: true,	      
						    },
						    // Navigation arrows
						    navigation: {
						      nextEl: '.swiper-button-nextcontent-btn-next',
						      prevEl: '.swiper-button-prev.content-btn-prev',
						    },
						
						    // And if we need scrollbar
						    scrollbar: {
						      el: '.swiper-scrollbar',
						      draggable: true,
						    },						    
						    
						});

						
				});				
			</script>	
									
		

		<?php elseif (get_row_layout()== 'horizontal_divider'): $horizontal_divider++; ?>
				<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="hr-<?=$horizontal_divider?>">	
					<div class="grid-x <?=$grid_attr?>">
						<div class="cell <?=$cell_attr?>">	
							<hr/>
						</div>
					</div>
				</div>
		<?php elseif ( get_row_layout() == 'full_width_widgets'):?>
			<?php $select = get_sub_field('select_widget');?>
			<?php if ($select === 'viewMoreBlock') : ?>
				<div class="view-more-widget <?=$container_attr?>">
					<div class="grid-x <?=$grid_attr?>">
						<div class="cell <?=$cell_attr?>">
							<?php if ( have_rows( 'view_more_widget', 'option' ) ) : ?>
								<div class="grid-x <?=$grid_attr?>">
									<?php while ( have_rows( 'view_more_widget', 'option' ) ) : the_row(); ?>
										<div class="cell small-12 xmedium-6 view-more-widget-links-cell">
											<div class="view-more-link-wrapper">
												<div class="grid-x grid-padding-x">
													<span class="cell small-12 view-more-widget-title"><?php the_sub_field( 'widget_title' ); ?></span>
													<?php if ( have_rows( 'view_more_links' ) ) : ?>
													
														<?php while ( have_rows( 'view_more_links' ) ) : the_row(); ?>
															<?php $links = get_sub_field( 'links' ); ?>
															<?php if ( $links ) { ?>
																<div class="cell small-12">
																	<a class="other-links" href="<?php echo $links['url']; ?>" target="<?php echo $links['target']; ?>"><?php echo $links['title']; ?></a>
																</div>
															<?php } ?>
														<?php endwhile; ?>
													<?php endif; ?>
												</div>	
											</div>
										</div>
										<div class="small-12 xmedium-6 show-for-xmedium">
											<?php $view_more_image = get_sub_field( 'view_more_image' ); ?>
											<?php if ( $view_more_image ) { ?>
												<img src="<?php echo $view_more_image['url']; ?>" alt="<?php echo $view_more_image['alt']; ?>" />
											<?php } ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endif; ?>						
		<?php endif; ?>				

    <?php endwhile;?>

<?php endif;?>