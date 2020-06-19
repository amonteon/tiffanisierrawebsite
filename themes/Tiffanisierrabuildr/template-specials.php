<?php
/*
Template Name: Specials Page
*/

get_header(); ?>

<?php get_template_part('parts/components/component', 'banner');?>

<div class="content" id="content">

	<div class="grid-container">	
		<div class="inner-content request-consultation-inner grid-x align-center">	

		    <main class="main small-12 large-8 cell" role="main">
			   
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loops/loop', 'page' ); ?>
				
					<!--  load flexible content -->

					
			<!	------------------------------------------------------------------------------------------------------------			>
							
							
							
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
						
						if( have_rows('flexible_page_sections') ): $tag = 0; ?>
								
						<?php while ( have_rows('flexible_page_sections') ) : the_row(); $tag++;?>
					
					        <?php if ( get_row_layout() == 'column_grid_images'): $column_grid_images++; ?>
								<?php 
								$smallUp  = get_sub_field('small_up');
								$mediumUp  = get_sub_field('medium_up');
								$largeUp  = get_sub_field('large_up');
								?>
								<div class="<?=$container_attr ?> flexible-field-<?=$tag?>" id="column-grid-images-<?=$column_grid_images?>">
									<div class="grid-x <?=$grid_attr?>">
										<div class="cell <?=$cell_attr?>">					
											<div class="grid-x grid-padding-x grid-padding-y small-up-<?=$smallUp;?> xmedium-up-<?=$mediumUp;?> large-up-<?=$largeUp;?> grid-image-cols">	
												<?php 
												$colImgs  = get_sub_field('col_grid_images');
												
												if( $colImgs ): ?>
												   	<?php while ( have_rows( 'col_grid_images' ) ) : the_row(); ?>
														<?php $grid_image = get_sub_field( 'grid_image' ); ?>
														<?php if ( $grid_image ) : ?>
															<div class="cell grid-image-wrapper">
																<img src="<?php echo $grid_image['url']; ?>" alt="<?php echo $grid_image['alt']; ?>"  width="<?=$grid_image['width'];?>" height="<?=$grid_image['height'];?>" class="image-grid-img"/>
															</div>	
														<?php endif; ?>
													<?php endwhile; ?>
												   
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
								
					        <?php elseif( get_row_layout() == 'eight_column_centered' ): $full_width_content++; ?>
								<?php 
								$fullWidthContent = get_sub_field('eight_column_content_area');
								$custom_css_name = get_sub_field('custom_css_name');
								$add_background_image = get_sub_field('add_background_image');
								$change_txt_color = get_sub_field('change_text_color');
								$newTxtColor = get_sub_field('text_color');
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
							
					
								<div id="eight_column_centered-<?=$full_width_content?>" <?php if($dataInterchangeBG || $background_color != "#ffffff"): echo 'class="inner-bg-image eight-col-bg-img flexible-field-'.$tag.'" data-interchange="'.$dataInterchangeBG.'"'; else: echo 'class="fullwidthVisual flexible-field-'.$tag.'"'; endif; ?>>
									<div class="<?=$container_attr ?> ">
										<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?> align-center text-center">
										<div class="cell small-10 large-8">										
											<div class="grid-x entry-content">
												<div class="cell small-12 text-center <?php if($change_txt_color == true):?> addTextStyles <?php endif; ?>" style="color:<?=$newTxtColor;?>">
													<?=$fullWidthContent;?>
												</div>
											</div>
										</div>
									</div>
									</div>		
								</div>
								
							<?php elseif( get_row_layout() == 'full_width_content_text_only' ): $full_width_content_text_only++; ?>
								<?php 
								$fullWidthContent = get_sub_field('full_width_content_area_txt');			
								$custom_css_name = get_sub_field('custom_css_name');
								$add_background_image = get_sub_field('add_background_image');
								$invert_colors = get_sub_field('invert_colors');
								$background_image = get_sub_field('background_image');
								$background_color = get_sub_field('background_color');
								$dataInterchangeBG = "";
											
								if($add_background_image && $background_image ): 
									$dataInterchangeBG = dataInterchangeImgs($background_image);
								endif;						
								
								if($invert_colors): ?>
									<style>					
										#fullwidth-content-text-<?=$full_width_content_text_only?> h1,
										#fullwidth-content-text-<?=$full_width_content_text_only?> h2,
										#fullwidth-content-text-<?=$full_width_content_text_only?> h3,
										#fullwidth-content-text-<?=$full_width_content_text_only?> h4,
										#fullwidth-content-text-<?=$full_width_content_text_only?> h5,
										#fullwidth-content-text-<?=$full_width_content_text_only?> p { 
											color:white;
										}
										#fullwidth-content-text-<?=$full_width_content_text_only?> {
											background-color:<?=$background_color?>
										}
									</style>			
								<?php endif; ?>
								
								<div id="fullwidth-content-text-<?=$full_width_content_text_only?>" <?php if($dataInterchangeBG || $background_color != "#ffffff"): echo 'class="inner-bg-image flexible-field-'.$tag.'" data-interchange="'.$dataInterchangeBG.'"'; else: echo 'class="fullwidthVisual flexible-field-'.$tag.'"'; endif; ?>>
									<div class="<?=$container_attr?>">	
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
								
					        <?php  elseif( get_row_layout() == 'fifty_fifty_content' ): $fifty_fifty_content++; ?>
								<?php 
								$ffContentLeft = get_sub_field('fifty_fifty_content_left');
								$ffContentRight = get_sub_field('fifty_fifty_content_right');
								$custom_css_name = get_sub_field('custom_css_name');					
								?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="fifty-fifty-content-<?=$fifty_fifty_content?>">
									<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
										<div class="cell <?=$cell_attr?>">	
								        	<div class="grid-x grid-padding-x entry-content" >
												<div class="cell small-12 medium-6">
													<?=$ffContentLeft;?>
												</div>
												<div class="cell small-12 medium-6">
													<?=$ffContentRight;?>
												</div>
											</div>
										</div>
									</div>
								</div>		
								
							<?php elseif (get_row_layout() == 'four_eight_content'): $four_eight_content++; ?>
								<?php 
								$feContentLeft = get_sub_field('four_eight_content_left');
								$feContentRight = get_sub_field('four_eight_content_right');
								$four_eight_swap_for_mobile = get_sub_field('four_eight_swap_for_mobile');
								$custom_css_name = get_sub_field('$custom_css_name');	
								
								if($four_eight_swap_for_mobile):
								?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="four-eight-content-<?=$four_eight_content?>">
									<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
										<div class="cell <?=$cell_attr?>">	
								        	<div class="grid-x grid-padding-x entry-content" >
												<div class="cell small-12 xmedium-8 xmedium-order-2">
													<?=$feContentRight;?>
												</div>							
												<div class="cell small-12 xmedium-4 xmedium-order-1">
													<?=$feContentLeft;?>
												</div>
											</div>	
										</div>
									</div>
								</div>			
								<?php else: ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="four-eight-content-<?=$four_eight_content?>">
									<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
										<div class="cell <?=$cell_attr?>">				
								        	<div class="grid-x grid-padding-x entry-content">
												<div class="cell small-12 xmedium-4">
													<?=$feContentLeft;?>
												</div>
												<div class="cell small-12 xmedium-8">
													<?=$feContentRight;?>
												</div>
											</div>	
										</div>
									</div>	
								</div>			
								<?php endif; ?>
								
							<?php elseif (get_row_layout() == 'eight_four_content'): $eight_four_content++; ?>
								<?php 
								$efContentLeft = get_sub_field('eight_four_content_left');
								$efContentRight = get_sub_field('eight_four_content_right');
								$eight_four_swap_for_mobile = get_sub_field('eight_four_swap_for_mobile');
								$custom_css_name = get_sub_field('custom_css_name');
								
								if($eight_four_swap_for_mobile):
								?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="eight-four-content-<?=$eight_four_content?>">
									<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
										<div class="cell <?=$cell_attr?>">	
								        	<div class="grid-x grid-padding-x entry-content">
												<div class="cell small-12 xmedium-4 xmedium-order-2">
													<?=$efContentRight;?>
												</div>			        	
												<div class="cell small-12 xmedium-8 xmedium-order-1">
													<?=$efContentLeft;?>
												</div>
											</div>	
										</div>
									</div>
								</div>
								<?php else: ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="eight-four-content-<?=$eight_four_content?>">
						 			<div class="grid-x <?=$grid_attr?> <?=$custom_css_name?>">
										<div class="cell <?=$cell_attr?>">	       	
								        	<div class="grid-x grid-padding-x entry-content">
												<div class="cell small-12 xmedium-8">
													<?=$efContentLeft;?>
												</div>
												<div class="cell small-12 xmedium-4">
													<?=$efContentRight;?>
												</div>
											</div>	
										</div>
						 			</div>
								</div>					
								<?php endif; ?>	
							
							<?php elseif (get_row_layout() == 'accordion'): $accordion++;?>		
								<?php $accordionTitle = get_sub_field('accordion_title');?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="accordion-content-<?=$accordion?>">
									<div class="grid-x <?=$grid_attr?>">
									<div class="cell <?=$cell_attr?>">	
										<?php if ($accordionTitle):?>
											<h3><?=$accordionTitle;?></h3>
										<?php endif;?>
										<?php if( have_rows('items') ):?>
										<ul class="accordion" data-accordion>
											
											<?php $ic = 0; while ( have_rows('items') ) : the_row(); $ic++;?>
											<?php // set up items for accordions and set the first to is-active
											$itemTitle = get_sub_field('item_title');
											$itemContent = get_sub_field('item_content');
											?>
											  <li class="accordion-item <?php if ($ic==1){ echo 'is-active';}?>" data-accordion-item>
											    <a href="#" class="accordion-title"><?=$itemTitle;?></a>
											    <div class="accordion-content" data-tab-content>
											      <?=$itemContent;?>
											    </div>
											  </li>						
										
										    <?php endwhile;?>
										</ul>	
										<?php endif;?>
									</div>
								</div>
								</div>
							<?php elseif (get_row_layout() == 'tabbed_content'): $tabbed_content++; ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="tabbed-content-<?=$tabbed_content?>">
									<div class="grid-x <?=$grid_attr?>">
										<div class="cell <?=$cell_attr?>">			
											<div class="grid-x entry-content">					
										<div class="cell small-12">
											<?php $tabbedAreaTitle = get_sub_field('tab_content_title');?>
											<h2><?=$tabbedAreaTitle;?></h2>
											
											<?php if( have_rows('tabs') ):?>
												<ul class="tabs" data-tabs id="<?=$tabbedAreaTitle;?>-content">
											    <?php $tabCount = 0; while ( have_rows('tabs') ) : the_row(); $tabCount++;?>
													<?php $tabTitle = get_sub_field('tab');?>
													<li class="tabs-title <?php if ($tabCount == 1):?>is-active<?php endif;?>"><a id="<?='panel'.$tabCount.'-label';?>" href="#panel<?=$tabCount;?>"><?=$tabTitle;?></a></li>
											    <?php endwhile;?>
											    </ul>
											<?php endif;?>	  
											<?php if( have_rows('tabs') ):?>
											    <div class="tabs-content" data-tabs-content="<?=$tabbedAreaTitle;?>-content">
											    <?php $tabCount = 0; while ( have_rows('tabs') ) : the_row(); $tabCount++;?>
											    	<?php $tabContent = get_sub_field('tab_content');?>
											    	<div id="panel<?=$tabCount;?>" class="tabs-panel <?php if ($tabCount == 1):?>is-active<?php endif;?>"><?=$tabContent;?></div>
												    	
												<?php endwhile; ?>
												</div>					
											<?php endif;?>
										</div>
									</div>
										</div>
									</div>
								</div>
									
							<?php elseif (get_row_layout() == 'image_slider'): $image_slider++; ?>
								<?php 
									$slideshow_title = get_sub_field('slideshow_title');
									$enable_arrows = get_sub_field('enable_arrows');
									$enable_dots = get_sub_field('enable_dots');					
							        $enable_captions = get_sub_field('enable_captions');
							        $cell_width = get_sub_field( 'cell_width' );
							        $draggable = get_sub_field('draggable');
							        $wrap_around = get_sub_field('wrap_around');
							        $adaptive_height = get_sub_field('adaptive_height');
							        
							        
							        $arrows  = ($enable_arrows ? "true" : "false"); // returns true
							        $dots  = ($enable_dots ? "true" : "false"); // returns true
							        $drag  = ($draggable ? "true" : "false"); // returns true
							        $adapt = ($adaptive_height ? "true" : "false"); // returns true
							        $wrap  = ($wrap_around ? "true" : "false"); // returns true
									$the_cell_width = ($cell_width == "specify" ? get_sub_field('specify_width'): $cell_width ); ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="image-slide-<?=$image_slider?>">	
									<div class="grid-x <?=$grid_attr?>">
									<div class="cell <?=$cell_attr?>">					
								       <?php if($slideshow_title): ?><h2><?php echo get_sub_field('slideshow_title');?></h2><?php endif; ?>				
										<?php  $images = get_sub_field('slides'); 						
											if( $images ): ?>
											<?php $slc = 0; ?>
											<div class="sub-page-carousel" id="img-slider-<?=$image_slider?>" >
											        <?php foreach( $images as $image ): $slc++; ?>
											           	<div class="carousel-cell" style="width:<?=$the_cell_width?>">						               
											               <img src="<?php echo $image['url']; ?>" style="width:100%" alt="<?php echo $image['alt']; ?>" />
											               
											                <?php if($enable_captions):?>
											                	<?php if($image['caption']): ?>
																	<div class="slide-caption animated fadeInUp text-center" id="slide-caption-<?=$randId?>"><?php echo $image['caption']; ?></div>
																<?php endif; ?>
											                 <?php endif; ?>
											           	</div>
											        <?php endforeach; ?>
												</div>
											<?php endif; ?>
									</div>
								</div>
								</div>	
								<script type="text/javascript">	
									window.addEventListener( 'load', function() {				
										var carouselImg<?=$image_slider?> = jQuery('#img-slider-<?=$image_slider?>');
										 carouselImg<?=$image_slider?>.flickity({ 
											imagesLoaded: true,	cellAlign: "center", 
											contain: true, pageDots: <?=$dots?>, 
											prevNextButtons: <?=$arrows?>, lazyLoad: true, 
											draggable: <?=$drag?>,wrapAround: <?=$wrap?>, 
											adaptiveHeight: <?=$adapt?> }).addClass('active');;											
										 carouselImg<?=$image_slider?>.on( 'change.flickity', function() {
										  carouselImg<?=$image_slider?>.flickity('reloadCells');
										});			
									});				
								</script>		
														
							<?php elseif (get_row_layout() == 'content_slider'): $content_slider++; ?>
											<?php 
									$slideshow_title = get_sub_field('slideshow_title');
									$enable_arrows = get_sub_field('enable_arrows');
									$enable_dots = get_sub_field('enable_dots');					
							        $enable_captions = get_sub_field('enable_captions');
							        $cell_width = get_sub_field( 'cell_width' );
							        $draggable = get_sub_field('draggable');
							        $wrap_around = get_sub_field('wrap_around');
							        $adaptive_height = get_sub_field('adaptive_height');
							        
							        
							        $arrows  = ($enable_arrows ? "true" : "false"); // returns true
							        $dots  = ($enable_dots ? "true" : "false"); // returns true
							        $drag  = ($draggable ? "true" : "false"); // returns true
							        $adapt = ($adaptive_height ? "true" : "false"); // returns true
							        $wrap  = ($wrap_around ? "true" : "false"); // returns true
									$the_cell_width = ($cell_width == "specify" ? get_sub_field('specify_width'): $cell_width ); ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="content-slider-<?=$content_slider?>">	
									<div class="grid-x <?=$grid_attr?>">
									<div class="cell <?=$cell_attr?>">	
							
										<?php if($slideshow_title): ?><h2><?php echo get_sub_field('slideshow_title');?></h2><?php endif; ?>
						
										<?php if( have_rows('slides') ):?>
											<?php $randId = rand(1,999); ?>
											<div class="slider-<?=$randId?> sub-page-carousel"  id="content-sliders-<?=$content_slider?>">
												<?php $slc = 0; while ( have_rows('slides') ) : the_row(); 
													$slideContent = get_sub_field('slide_content');	 ?>
													<div class="carousel-cell" style="width:<?=$the_cell_width?>">	
														<?=$slideContent;?>
													</div>
												<?php $slc++; endwhile;?>
											</div>		
										<?php endif;?>
									</div>
								</div>	
								</div>
								<script type="text/javascript">	
									window.addEventListener( 'load', function() {				
										var carouselCont<?=$content_slider?> = jQuery('#content-sliders-<?=$content_slider?>');
										 carouselCont<?=$content_slider;?>.flickity({ 
											imagesLoaded: true,	cellAlign: "center", 
											contain: true, pageDots: <?=$dots?>, 
											prevNextButtons: <?=$arrows?>, lazyLoad: true, 
											draggable: <?=$drag?>,wrapAround: <?=$wrap?>, 
											adaptiveHeight: <?=$adapt?> }).addClass('active');;											
										 carouselCont<?=$content_slider?>.on( 'change.flickity', function() {
										  carouselCont<?=$content_slider?>.flickity('reloadCells');
										});			
									});				
								</script>			
								
							<?php elseif(get_row_layout() == 'video_content'): $video_content++; ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="video-content-<?=$video_content?>">	
									<div class="grid-x <?=$grid_attr?>">
									<div class="cell <?=$cell_attr?>">	
										<?php if(have_rows('videos')): $ctr = 0; ?>
											<div class="grid-x grid-padding-x" data-equalizer data-equalize-on="medium">
											<?php while(have_rows('videos')): the_row(); $ctr++; ?>
												<?php 
													$title = get_sub_field('title');
													$link = get_sub_field('link');
													$image = get_sub_field('image');										
												?>
												<div class="cell small-12 xsmall-6 medium-6 large-4 float-left">
												  <div data-equalizer-watch>
													<div class="text-center" style="line-height: 1.2; padding-bottom:20px;">
														<a href="<?php echo $link?>" data-fancybox="videos">
														<p><img src="<?php echo $image['url']?>" height="<?php echo $image['height']?>" width="<?php echo $image['width']?>"></p>
														<span><?php echo $title; ?></span>
														</a>
													</div>
												  </div>
												</div>
											<?php endwhile; ?>
										</div>
										<?php endif; ?>
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
							<?php elseif (get_row_layout()== 'contact_form_widget'): $contact_form_widget_ctr++; ?>
								<?php $contact_form_widget = get_sub_field('contact_form_widget'); ?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>" id="contact-form-widget-<?=$contact_form_widget_ctr?>">	
									<div class="grid-x <?=$grid_attr?>">
									<div class="cell <?=$cell_attr?>">				
										<div class="grid-x entry-content contact-form-widget-wrapper ">
									<div class="cell small-12">
										<div class="widget-contact-form-container"><?php echo do_shortcode($contact_form_widget);?></div>
									</div>
								</div>	
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
									<section class="full-width-contact-form-widget">
										<div class="contact-bg-img" data-interchange="<?=$interchangeImgs;?>"></div>
										<div class="grid-container contact-grid-container">
											<div class="grid-x <?=$grid_attr;?> contact-grid-container">
												<div class="cell small-11 medium-11 large-10 contact-form-wrapper">	
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
								
							<?php elseif ( get_row_layout() == 'documents_grid' ) : ?>
								<section class="documents-grid-section">
									<div class="<?=$container_attr?>">
										<div class="grid-x <?=$grid_attr?>">
											<div class="cell <?=$cell_attr?>">
												<?php if ( have_rows( 'documents' ) ) : ?>
													<?php while ( have_rows( 'documents' ) ) : the_row(); ?>
													<div class="grid-x document-wrapper align-middle">
														<div class="cell small-10 medium-7 large-9">
															<a href="<?php echo $attach_file['url']; ?>" download title="<?php echo $attach_file['filename']; ?>">
																<div class="file-icon"><?php the_sub_field( 'file_icon' ); ?></div>
																<div class="file-title"><?php the_sub_field( 'file_title' ); ?></div>
															</a>
														</div>
														<div class="cell small-8 medium-5 large-3 download-file-wrap">
															<?php $attach_file = get_sub_field( 'attach_file' ); ?>
															<?php if ( $attach_file ) { ?>
																<a href="<?php echo $attach_file['url']; ?>" download class="button hollow rounded secondary download-btn" title="<?php echo $attach_file['filename']; ?>">Download</a>
															<?php } ?>
														</div>
													</div>
													<?php endwhile; ?>
												<?php else : ?>
													<?php // no rows found ?>
												<?php endif; ?>	
											</div>
										</div>
									</div>		
								</section>
								
							<?php elseif (get_row_layout()== 'widgets'):?>
								<div class="<?=$container_attr?> flexible-field-<?=$tag?>">	
									<div class="grid-x <?=$grid_attr?>">
										<div class="cell <?=$cell_attr?>">			
											<div class="flexible-widgets twocol-widget">
									<div class="grid-x entry-content">
										<?php if(have_rows('widgets')): $ctr = 0; ?>
											<?php while(have_rows('widgets')): the_row(); $ctr++; ?>
												<div class="cell small-12 medium-6 widgeter widgeter-<?=$ctr?>">
													<?php $add_widget = get_sub_field('add_widget'); ?>							
													
													<?php if($add_widget == "4") :								
														$relatedGallery = get_sub_field('related_gallery');
														$gal_featured_image = get_sub_field('gal_featured_image'); ?>
																	
														
													    <?php if( $relatedGallery ): ?>
													    <div class="widgetBoxWrap grid-x align-middle widget-gallery text-center">
													    <div class="cell small-12 widgetBox wYesBg  custTextWidget widgetBg text-center ">
													 		
														    <?php foreach( $relatedGallery as $post): // variable must be called $post (IMPORTANT) ?>
														    <?php setup_postdata($post); ?>
														        <?php $altTitle = get_field('alt_title');   ?>							     
																
																<?php if( have_rows('patient_galleries') ): ?>
																<div class="grid-y">
																	<?php while ( have_rows('patient_galleries') ) : the_row(); ?>
																		<?php $showOnArchive  = get_sub_field('show_in_archive');?>						
																			<?php if( $showOnArchive): ?>
																								
																				<div class="cell auto"><a href="<?php echo get_permalink(); ?>"><img class="alignnone" src="<?=$gal_featured_image['url'];?>" 
																				alt="<?=$gal_featured_image['alt'];?>" width="<?=$gal_featured_image['width'];?>" height="<?=$gal_featured_image['height'];?>"/></a></div><div class="cell shrink"><a href="<?php echo get_permalink(); ?> " class="button primary expanded">VIEW THE GALLERY </a></div>				
																					
																			<?php endif; ?>				
																	<?php endwhile; ?>	
																</div>		
																<?php endif; ?>
															    <?php endforeach; ?>
														    
														    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
													    </div>
													  </div>
													  <?php endif; ?>
						
														
													<?php else: ?>
														<?php echo do_shortcode($add_widget);?>
													<?php endif; ?>
												</div>
											<?php endwhile; ?>
										<?php endif; ?>	
									</div>
								</div>	
										</div>
									</div>
								</div>
							<?php elseif (get_row_layout()== 'full_custom_widget'):
									$full_custom_widget = get_sub_field('custom_widget'); 
									$before_and_after_cta = get_sub_field('before_and_after_cta_name');
									$before_and_after_cta_link = get_sub_field('before_and_after_cta_link');
								?>
					
								<?php echo do_shortcode($full_custom_widget);					
									if($before_and_after_cta_link != "/" && $before_and_after_cta ):
								?>
									<script type="text/javascript">
										jQuery("#widget-banda-button a").attr("href","<?=$before_and_after_cta_link;?>");
										jQuery("#widget-banda-button a").html('<?=$before_and_after_cta?>')
									</script>
									<?php endif; ?>		
					
							<?php elseif (get_row_layout()== 'two_by_two'): ?>
							<?php 
								$section_title = get_sub_field('section_title');
								$enable_dark_mode = get_sub_field('enable_dark_mode');	
								$mode = "light-mode";
								
								if($enable_dark_mode):
									$mode = "dark-mode";
								endif;
							
								if(have_rows('two_by_two_content')): $ctr_two = 0; ?>
								<div class="two-by-two-section <?=$mode?>">
									<div class="<?=$container_attr?>">
										<div class="grid-x <?=$grid_attr?>">
											<div class="cell <?=$cell_attr?>">	
												<div class="grid-x">
													<?php while(have_rows('two_by_two_content')): the_row(); $ctr_two++; 
														$title = get_sub_field('title');
														$two_by_content = get_sub_field('two_by_content');
													?>
														<div class="cell small-12 medium-6 large-6 grid-cell grid-cell-<?=$ctr_two?>">
															<?=$two_by_content?>
														</div>								
													<?php endwhile; ?>
												</div>	
											</div>
										</div>					
									</div>
								</div>
										
									
							<?php endif; ?>				
													
					
					        <?php endif;?>
					
					    <?php endwhile;?>
					
					<?php endif;?>
							
							
							
							
							
							
							
			<!	------------------------------------------------------------------------------------------------------------			>				

			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->
		    <?php get_sidebar();  ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

</div> <!-- end .grid-container -->

<?php get_footer(); ?>