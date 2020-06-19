<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
$logo = get_field('logo','options');
$alt_logo = get_field('alt_logo','options');
$tablet_logo = get_field('tablet_logo','options');
$mobile_logo = get_field('mobile_logo','options');
$phone = get_field('phone_number','options');
$alt_number = get_field('alt_number','options');
$fax_number = get_field('fax_number','options');
$email_address = get_field('email_address','options');
$address = get_field('address','options');
$google_map_link = get_field('google_map_link','options');
$google_map_embed = get_field('google_map_embed','options');
$topCTA = get_field('top_cta','options');
$topCTALink = get_field('top_cta_link','options');
$officeName = get_field('office_name','options');
$secondOfficeName = get_field('second_office_name','options');
$secondPhone = get_field('second_office_phone_number','options');

if(is_front_page()):
	$class = '';	
else:
	$styles = "position:fixed;";	
	$class = "is-fixed";	
endif;	

// set up page banner acf fields 
$page_for_posts = get_option( 'page_for_posts', true );
	if (is_home()){
		$post_id = 	$page_for_posts;
	}  else {
		$post_id = $post->ID;
	}

$selectBanner = get_field( 'select_type_of_banner', $post_id );
?>

<div data-sticky-container>
<div class="<?=$class?> wait-js sticky-wrapper-navigation <?php if ($selectBanner === 'black') : ?> black-bg <?php elseif($selectBanner === 'pink'): ?> pink-bg <?php elseif($selectBanner === 'white'): ?> white-bg <?php endif;?> " data-sticky data-options="marginTop:0; stickyOn:small;" style="<?=$styles?> width:100%;">	
		<div class="grid-container nav-container">
			<div class="grid-x grid-padding-x align-middle align-center nav-grid">
				<div class="cell auto large-shrink logo-container show-for-large">
					<a href="<?php echo home_url(); ?>">
						<img class="main-logo" data-interchange="[<?=$mobile_logo['url'];?>, small], [<?=$tablet_logo['url'];?>, medium], [<?=$logo['url'];?>, large]" height="<?=$logo['height'];?>" width="<?=$logo['width'];?>" alt="<?=$logo['alt'];?>"/ >
						<img class="alt-logo"  data-interchange="[<?=$alt_logo['url'];?>, small], [<?=$alt_logo['url'];?>, medium], [<?=$alt_logo['url'];?>, large]" height="<?=$alt_logo['height'];?>" width="<?=$alt_logo['width'];?>" alt="<?=$alt_logo['alt'];?>"/ >
					</a>
				</div>		
					<!-- TOP BAR -->
					<div class="lower-bar wait-js" id="top-bar-menu">
						<div class="grid-container">
							<div class="grid-x align-middle">
								
								
								<div class="cell auto large-shrink logo-container hide-for-large">
									<a href="<?php echo home_url(); ?>">
										<img class="main-logo" data-interchange="[<?=$mobile_logo['url'];?>, small], [<?=$tablet_logo['url'];?>, medium], [<?=$logo['url'];?>, large]" height="<?=$logo['height'];?>" width="<?=$logo['width'];?>" alt="<?=$logo['alt'];?>"/ >
										<img class="alt-logo"  data-interchange="[<?=$alt_logo['url'];?>, small], [<?=$alt_logo['url'];?>, medium], [<?=$alt_logo['url'];?>, large]" height="<?=$alt_logo['height'];?>" width="<?=$alt_logo['width'];?>" alt="<?=$alt_logo['alt'];?>"/ >
									</a>
								</div>
								<div class="cell auto navigation-bar show-for-large">
									<div class="menu-centered">
										<?php joints_top_nav(); ?>
									</div>	
								</div>
								<div class="cell shrink cta">
									<a href="<?=$topCTALink;?>" class="button primary rounded"><?=$topCTA;?></a> 
								</div>
								<div class="cell shrink float-left mobile-hamburger-container default hide-for-large text-left ">		
									<!--  https://jonsuh.com/hamburgers/ for reference -->			
									<button class="hamburger hamburger--squeeze" type="button" data-toggle="off-canvas" >
									  <span class="hamburger-box">
									    <span class="hamburger-inner"></span>
									  </span>
									</button>				
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>