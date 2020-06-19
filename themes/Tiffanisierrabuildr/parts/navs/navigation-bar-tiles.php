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

if(is_front_page()):
		
else:
	$styles = "position:fixed;";	
	$class = "is-fixed";	
endif;	
?>

<div data-sticky-container>
	<div class="<?=$class?> wait-js sticky-wrapper-navigation" data-sticky data-options="marginTop:0; stickyOn:small;" style="<?=$styles?> width:100%;">	
		<!-- UPPER BAR -->
		<div class="upper-bar show-for-large">
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell socialinks shrink">
						<?php echo do_shortcode('[socialLinks]');?>
					</div>
					<div class="cell auto" id="location-tel-links">
						<ul class="menu align-center">
							<li><span><?php echo _e('Phone:')?></span> <a href="tel:+1<?php _phone_num($phone);?>"><?=$phone;?></a></li>
							<li><span><?php echo _e('Address:')?></span> <a href="<?=$google_map_link ?>"><?=$address?></a></li>
						</ul>
					</div>
					<div class="cell shrink cta">
						<a href="<?=$topCTALink;?>" class="button"><?=$topCTA;?></a> 
					</div>
				</div>	
			</div>
		</div>		
		<!-- TOP BAR -->
		<div class="lower-bar wait-js" id="top-bar-menu">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell small-3 mob-icon smedium-shrink small-order-2 smedium-order-1 float-left mobile-hamburger-container tiles hide-for-large text-left ">
						<a data-toggle="off-canvas" class="hamburger control"><i class="fa fa-bars" ></i><div class="hide-for-smedium"><?php echo _e('MENU'); ?></div></a>
					</div>
					<div class="cell small-12 smedium-auto small-order-1 logo-container" >
						<a href="<?php echo home_url(); ?>">
							<img data-interchange="[<?=$mobile_logo['url'];?>, small], [<?=$tablet_logo['url'];?>, medium], [<?=$logo['url'];?>, large]" height="<?=$logo['height'];?>" width="<?=$logo['width'];?>" alt="<?=$logo['alt'];?>"/ >
						</a>
					</div>
					<div class="cell small-3 mob-icon small-order-3 text-center hide-for-smedium ">
						<a href="/galleries/" class="control"> 
							<i class="fa fa-camera"></i><div><?php echo _e('GALLERY'); ?></div>
						</a>
					</div>
					<div class="cell small-3 mob-icon small-order-4 text-center hide-for-smedium ">
						<a href="/pricing/" class="control"> 
							<i class="fa fa-usd"></i><div><?php echo _e('PRICING'); ?></div>
						</a>
					</div>				
					<div class="cell small-3 smedium-shrink small-order-5 mob-icon mobile-phone-number-container tiles float-right hide-for-large text-right">
						<a href="tel:+1<?php echo _phone_num($phone)?>" class="phone control"><i class="fa fa-phone"></i><div class="hide-for-smedium"><?php echo _e("CALL"); ?></div></a>
					</div>
					<div class="cell small-9 navigation-bar large-order-2  show-for-large" id="nav-bar-container">
						<?php joints_top_nav(); ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>