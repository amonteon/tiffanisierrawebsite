<?php 
	$add_a_video_banner = get_field('add_a_video_banner');
	$type_of_banner = get_field('type_of_banner');
	$background_images = get_field('background_images');
	$overlay_color = get_field('overlay_color');
	$overlay_opacity = get_field('overlay_opacity');
	$type_of_parallax = get_field('type_of_parallax');
	$tagline = get_field('tagline');
	$min_height_desktop = get_field('min_height_desktop');
	$min_height_tablet_1024 = get_field('min_height_tablet_1024');
	$min_height_tablet_768 = get_field('min_height_tablet_768px');
	$min_height_mobile_640 = get_field('min_height_mobile_640');
	$min_height_mobile_320 = get_field('min_height_mobile_320');	
	
	
	
	if ($background_images):
	/* loop through the images in the banner background images gallery field and save them as an array 
	** for use in our data-interchange background src.  
	** dataInterchangeImgs() can be found on assets/functions/theme-support.php --- line 75
	*/
		$dataInterchange = dataInterchangeImgs($background_images);
	endif;
	

	 if($background_images): $ctr=0; $theimg = array(); 					
		foreach( $background_images as $image ): $ctr++; 							 
			$theImg[$ctr] = $image['url']; 
			$theAlt[$ctr] = $image['alt'];
			$theWidth[$ctr] = $image['width'];
			$theHeight[$ctr] = $image['height'];								
		endforeach;	
	endif; 	
	
	$parallaxType = "";
	if($type_of_parallax):		
			if($type_of_parallax == "none"):
				$parallaxType = "";
			elseif($type_of_parallax == "perspective"):
				$parallaxType = "banner-parallax";
			elseif($type_of_parallax == "fixed"):
				$parallaxType = "parallax-fixed";
			endif;		
	endif;

?>
<style>
	/*
	-----------------------------------------------------------------------------------------------------------------------------
	-- reversed the logic of and order of inline media queries for front-page banner height settings to a mobile first pattern --
	-----------------------------------------------------------------------------------------------------------------------------
	small: 0 and up,
	smedium: 420px and up,
	medium: 640px and up,
	xmedium: 769px and up,
	large: 1025px and up,
	xlarge: 1200px and up,
	xxlarge: 1440px and up,
	largest: 1600px and up,
	-----------------------------------------------------------------------------------------------------------------------------
	*/
	.banner-wrapper, #fp-frontpage-banner , .tagline p:last-of-type{margin-bottom: 0;}
	
	
	<?php if($overlay_opacity != "" || $overlay_opacity != 0): ?>
	.banner-wrapper:before {
		content:"";
		position: absolute;			
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=<?=$overlay_opacity?>)";
		opacity:calc(<?=$overlay_opacity?> / 100);
		-moz-opacity:calc(<?=$overlay_opacity?> / 100);
		-khtml-opacity:calc(<?=$overlay_opacity?> / 100);
		filter: alpha(opacity=<?=$overlay_opacity?>);
		background-color:<?=$overlay_color?>;	
		height:100%;
		width:100%;
		top:0;
		left:0;
		right:0;
		bottom:0;
		margin:auto;
		z-index:2;		
	}
	
	
	.ie .banner-wrapper:before {
		zoom:1;
		display: none;
	}
	
	<?php endif; ?>
		
</style>

<?php if($add_a_video_banner): ?>
	<section class="fp-sections" id="fp-frontpage-banner">		
			<div class="static-banner-wrapper banner-wrapper <?=$parallaxType?>" data-speed="0.2" <?php if($dataInterchange):?> data-interchange="<?=$dataInterchange?>" <?php endif; ?> alt="<?=$thealt[1]?>">		
			</div>
			<div class="grid-x grid-padding-x tagline align-middle align-left text-left" >
				<div class="cell small-8 medium-7 large-9">
					<?php if($tagline): echo $tagline; endif; ?>
				</div>
				<div class="cell small-8 medium-7 large-8">
					<?php if ( have_rows( 'subheader_bullet_points' ) ) : ?>
						<div class="grid-x subheading-wrapper">
							<?php while ( have_rows( 'subheader_bullet_points' ) ) : the_row(); ?>
								<?php if ( have_rows( 'bullet_points' ) ) : ?>
									<?php while ( have_rows( 'bullet_points' ) ) : the_row(); ?>
										<div class="cell small-8 subheading-item" style="background-color:<?php the_sub_field( 'mobile_background_color' ); ?>">
											<?php the_sub_field( 'bullet_point_title' ); ?>
										</div>
									<?php endwhile; ?>
								<?php else : ?>
									<?php // no rows found ?>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<?php $banner_button = get_field( 'banner_button' ); ?>
					<?php if ( $banner_button ) { ?>
						<a class="button primary rounded" href="<?php echo $banner_button['url']; ?>" target="<?php echo $banner_button['target']; ?>"><?php echo $banner_button['title']; ?></a>
					<?php } ?>
					<?php if ( have_rows( 'scroll_down_button' ) ) : ?>
					<?php while ( have_rows( 'scroll_down_button' ) ) : the_row(); ?>
						
						
						<?php $scroll_down_anchor_link = get_sub_field( 'scroll_down_anchor_link' ); ?>
						<?php if ( $scroll_down_anchor_link ) { ?>
							<div class="next-section-arrow">
								<a href="<?php echo $scroll_down_anchor_link['url']; ?>" target="<?php echo $scroll_down_anchor_link['target']; ?>" data-smooth-scroll data-animation-duration="700">
									<?php the_sub_field( 'scroll_down_text' ); ?>
									<div class="circle-container"><?php the_sub_field( 'scroll_down_icon' ); ?></div>
								</a>
							</div>
						<?php } ?>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>	
	</section>
<?php endif; ?>

