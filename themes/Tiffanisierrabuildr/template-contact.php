<?php
/*
Template Name: Contact
*/

get_header(); ?>

<?php get_template_part('parts/components/component', 'banner');?>

<div class="content contact-content" id="content">

	<div class="grid-container contact-grid-container">	

		<div class="inner-content contact-temp-inner grid-x align-center">	

		    <main class="main small-12 large-12 cell" role="main">
				<div class="grid-x">
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
					    	<?php get_template_part( 'parts/loops/loop', 'page' ); ?>
						
							<!--  load flexible content -->
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
							        $cell_attr = "small-12 medium-12 xmedium-12 large-12";  
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
								
								if( have_rows('contact_flexible_page_sections') ): $tag = 0; ?>
										
								<?php while ( have_rows('contact_flexible_page_sections') ) : the_row(); $tag++;?>

							        <?php if( get_row_layout() == 'full_width_content' ): $full_width_content++; ?>
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
												
		
											
											</style>			
									
							
										<div id="full-width-content-<?=$full_width_content?>" <?php if($dataInterchangeBG || $background_color != "#ffffff"): echo 'class="inner-bg-image cell flexible-field-'.$tag.'" data-interchange="'.$dataInterchangeBG.'"'; else: echo 'class="fullwidthVisual cell ' .$custom_css_name. ' flexible-field-'.$tag.'"'; endif; ?>>
											<div class="<?=$container_attr ?> ">
												<div class="grid-x <?=$grid_attr?>">
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

										
							        <?php  elseif( get_row_layout() == 'fifty_fifty_content' ): $fifty_fifty_content++; ?>
										<?php 
										$ffContentLeft = get_sub_field('fifty_fifty_content_left');
										$ffContentRight = get_sub_field('fifty_fifty_content_right');
										$custom_css_name = get_sub_field('custom_css_name');				
										?>
										<div class="cell flexible-field-<?=$tag?>" id="fifty-fifty-content-<?=$fifty_fifty_content?>">
											<div class="grid-container">	
												<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
													<div class="cell <?=$cell_attr?>">	
											        	<div class="grid-x grid-padding-x entry-content" >
															<div class="cell small-12 large-4 cell-contact-left">
																<?=$ffContentLeft;?>
															</div>
															<div class="cell small-12 large-7 cell-contact-right">
																<?=$ffContentRight;?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>				
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
										<?php if ($select === 'contactForm') : ?>
											<?php $contactImage = get_field( 'contact_form_background_image', 'option' ); 
												  $interchangeImgs = dataInterchangeImgs($contactImage);
												  $contactForm = get_field('contact_form_shortcode', 'option');
											?>
											<section class="full-width-contact-form-widget contact-form-wrapper cell">
												<div class="contact-bg-img" data-interchange="<?=$interchangeImgs;?>"></div>
												<div class="grid-container contact-grid-container">
													<div class="grid-x <?=$grid_attr;?> contact-grid-container">
														<div class="cell small-11 medium-11 large-11 contact-form-wrapper">	
															<?=$contactForm;?>
														</div>
													</div>	
												</div>    
											</section>	
										
											
										<?php elseif($select === 'requestConsultation') : ?>
											<?php 
												$consultationContent = get_field('consultation_content', 'option');
												$consultationBgImgs = get_field( 'consultation_background_image', 'option' );
												$interchangeImgs = dataInterchangeImgs($consultationBgImgs);
												$consultationButton = get_field( 'consultation_button_text', 'option' );
											?>
											<section class="request-consultation-section">
												<div class="grid-x consultation-grid-container align-middle align-center" data-interchange="<?=$interchangeImgs;?>" style="background-attachment:fixed;">
												<div class="cell small-12 medium-12 large-12 ">	
													<div class="grid-x grid-container grid-padding-x align-middle align-center entry-content">
														<div class="cell small-12 medium-10 large-8 text-center">
															<?=$consultationContent;?>
															<a class="primary button rounded btn-w-arrow" href="<?php echo $consultationButton['url']; ?>" target="<?php echo $consultationButton['target']; ?>"><?php echo $consultationButton['title']; ?></a>
														</div>
													</div>
												</div>
											</div>	
											</section>			
										<?php elseif($select === 'threeImageBlock') : ?>
											<?php 
												$three_block_featured_image = get_field( 'three_block_featured_image', 'option' );
											?>
											<section class="three-img-block-section">
												<div class="grid-container">
													<div class="grid-x grid-padding-x three-img-block-grid-container align-middle align-center">
														<div class="cell small-12 large-10">
															<div class="grid-x grid-padding-x align-middle align-center text-center">
																<div class="cell small-12 hide-for-medium">
																	<img src="<?php echo $three_block_featured_image['url']; ?>" alt="<?php echo $three_block_featured_image['alt']; ?>" />
																</div>
																<?php if ( have_rows( 'three_image_block_wrapper', 'option' ) ) : ?>
																	<?php while ( have_rows( 'three_image_block_wrapper', 'option' ) ) : the_row(); ?>
																		<div class="cell small-12 medium-4 large-4 ">	
																			<?php $block_link = get_sub_field( 'block_link' ); ?>
																			<?php $image = get_sub_field( 'image' ); ?>
																			<a href="<?php echo $block_link['url']; ?>" target="<?php echo $block_link['target'];?>" title="<?=$block_link['title'];?>">
																				<img class="cell show-for-medium" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
																				<div class="image-block-title"><?php echo $block_link['title']; ?></div>
																			</a>
																		</div>
																	<?php endwhile; ?>
																<?php else : ?>
																	<?php // no rows found ?>
																<?php endif; ?>
															</div>
														</div>		
													</div>	
												</div>
											</section>	
										<?php endif; ?>				
											
									<?php endif; ?>				
														
						
						    <?php endwhile;?>
						
						<?php endif;?>
				<!-- 	End flexible content	 -->
				    
				    <?php endwhile; endif; ?>											
				</div>	
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->
	<?php get_footer(); ?>
</div> <!-- end .grid-container -->

