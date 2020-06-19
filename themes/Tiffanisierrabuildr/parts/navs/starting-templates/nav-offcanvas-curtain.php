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
$styles = "position:fixed;";	
$class = "is-fixed";
?>
	
<div data-sticky-container>
	<div class="<?=$class?> sticky-wrapper-navigation" data-sticky data-options="marginTop:0; stickyOn:small;" style="<?=$styles?> width:100%;">	

		<?php if($logo):?>
		<div class="curtain-menu-button-home">
			<a href="<?php echo home_url(); ?>">
				<img class="altLogo" data-interchange="[<?=$alt_logo['url'];?>, small], [<?=$alt_logo['url'];?>, medium], [<?=$alt_logo['url'];?>, large]" height="<?=$alt_logo['height'];?>" width="<?=$alt_logo['width'];?>" alt="<?=$alt_logo['alt'];?>"/ >
				<img class="logo" data-interchange="[<?=$logo['url'];?>, small], [<?=$logo['url'];?>, medium], [<?=$logo['url'];?>, large]" height="<?=$logo['height'];?>" width="<?=$logo['width'];?>" alt="<?=$logo['alt'];?>"/ >
			</a>
		</div>
		<?php else:?>
		<div class="curtain-menu-button-home">
			<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>	  
		</div>	
		<?php endif;?>
					
		<!-- the trigger -->
		<div class="curtain-menu-button" data-curtain-menu-button>
	
		  <div class="curtain-menu-button-toggle">
		    <div class="bar1"></div>
		    <div class="bar2"></div>
		  </div>
		</div>
		
		<div class="curtain-menu">
		  <div class="curtain"></div>
		  <div class="curtain"></div>
		  <div class="curtain"></div>
		  <div class="curtain-menu-wrapper">
		  	<?php joints_curtain_nav(); ?>
		  </div>
		</div>
	</div>
</div>