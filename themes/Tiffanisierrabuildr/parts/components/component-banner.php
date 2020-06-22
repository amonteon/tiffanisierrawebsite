<?php // set up page banner acf fields 
$page_for_posts = get_option( 'page_for_posts', true );
$fallbackbannerBgImgs = '';
if (is_home()){
	$post_id = 	$page_for_posts;
}  else {
	$post_id = $post->ID;
}
	
if(is_home() || is_archive() || is_404()):	
	$bannerBgImgs = get_field('banner_background_imgs','options');
	$bgColor = get_field('background_color','options');
else :
	/* added fallback images from the theme settings to prevent
	 from needing to manually update all imported pages and posts 
	 this is a fail safe, the default image still exists on the page and single post templates when 
	 a new page or post is created.
	*/ 
	$fallbackbannerBgImgs = get_field('banner_background_imgs','options');
	$fallbackbgColor = get_field('background_color','options');	
	// 	set up banner image and color for single posts and pages
	$bannerBgImgs = get_field('banner_background_imgs');
	$bgColor = get_field('background_color');
	
endif;

$minHeight = get_field('banner_min_height');
$altTitle = get_field('alt_title', $post_id);
$geoTag = get_field('geo_tag' , $post_id);
$removeme =  array('Category:','Archives:');
$selectBanner = get_field( 'select_type_of_banner', $post_id );
$addImage = get_field( 'add_image', $post_id );
$bannerImg = get_field( 'banner_image', $post_id );
$dataInterchange;

if ($bannerBgImgs):
/* loop through the images in the banner background images gallery field and save them as an array 
** for use in our data-interchange background src.  
** dataInterchangeImgs() can be found on assets/functions/theme-support.php --- line 75
*/
	$dataInterchange = dataInterchangeImgs($bannerBgImgs);
elseif ($fallbackbannerBgImgs):
	$dataInterchange = dataInterchangeImgs($fallbackbannerBgImgs);
endif;

$navigationType = get_theme_mod("tiffanibuildr_nav_type"); 
if ( $navigationType == 'offcanvas_curtain') { $navStyleClass = 'navStyleCurtain'; } else { $navStyleClass = 'navStyleOffCanvas'; }
 
?>


<section id="page-banner" class="<?=$navStyleClass;?>">
<div class="banner-bg <?php if ($selectBanner === 'black') : ?> black-bg <?php elseif($selectBanner === 'pink'): ?> pink-bg <?php elseif($selectBanner === 'white'): ?> white-bg <?php endif;?>" <?php if ($dataInterchange):?>  style="background-size: cover; background-repeat: no-repeat;" data-interchange="<?=$dataInterchange?>" <?php endif;?>>
		<div class="grid-container">

			<div class="grid-x grid-padding-x align-middle align-center banner-content">
				
					<?php if(is_home()): ?>
						<div class="cell small-12 large-10 text-left">
						<h1 class="page-title"><?php if($altTitle) { echo $altTitle ;} else { echo get_the_title($post_id); }?> <?php if($geoTag) { echo'<small class="sub-header">' . $geoTag . '</small>';}?></h1>
						</div>
					<?php elseif(is_archive()): ?>
						<div class="cell small-12 large-10 text-left">
						<h1 class="page-title"><?php echo str_replace($removeme, "", get_the_archive_title()); ?></h1>
						</div>
					<?php elseif(is_404()): ?>
						<div class="cell small-12 large-10 text-left">
						<h1 class="page-title">Page not found</h1>
						</div>
					<?php  else:?>
						<?php if($addImage): ?>
							<div class="cell small-12 large-6 show-for-large">
							<img src="<?php echo $bannerImg['url']; ?>" alt="<?php echo $bannerImg['alt']; ?>" />
							</div>
							<div class="cell small-12 large-6 text-left header-w-img">
								<h1 class="page-title">
									<?php if($altTitle) { 
										echo $altTitle ;
									} else { 
										the_title();
									}?> 
									<?php if($geoTag) { 
										echo'<small class="sub-header">' . $geoTag . '</small>';
									}?>
								</h1>
								<?php $breadcrumbs_shortcode = get_field('breadcrumbs_shortcode','options'); 						
								if($breadcrumbs_shortcode): ?>						
									<?php get_template_part('parts/components/component', 'breadcrumbs'); ?>	
								<?php endif; ?>
							</div>
							
						<?php else: ?>
							<div class="cell small-12 large-10 text-left">
								<h1 class="page-title">
									<?php if($altTitle) { 
										echo $altTitle ;
									} else { 
										the_title();
									}?> 
									<?php if($geoTag) { 
										echo'<small class="sub-header">' . $geoTag . '</small>';
									}?>
								</h1>
								<?php $breadcrumbs_shortcode = get_field('breadcrumbs_shortcode','options'); 						
								if($breadcrumbs_shortcode): ?>						
									<?php get_template_part('parts/components/component', 'breadcrumbs'); ?>	
								<?php endif; ?>
							</div>

						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>	
	</div>		
</section>

