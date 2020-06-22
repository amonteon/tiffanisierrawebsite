<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>

<?php 
	$mobileNavStyle = get_theme_mod("offcanvas_select_setting_id"); 
	$tabletNavStyle = get_theme_mod("offcanvas_select_setting_tablet_id"); 
	$mobileTransition = get_theme_mod("offcanvas_transition_id");
	$tabletTransition = get_theme_mod("offcanvas_transition_tablet_id");
	$logo = get_field('mobile_logo','options');
	$officeName = get_field('office_name','options');
	$secondOfficeName = get_field('second_office_name','options');
	$secondPhone = get_field('second_office_phone_number','options');
	$phone = get_field('phone_number','options');
?> 


<div class="off-canvas" data-mobile="<?php echo $mobileNavStyle." ".$mobileTransition ; ?>" data-tablet="<?php echo $tabletNavStyle." ".$tabletTransition; ?>" id="off-canvas" data-off-canvas data-transition="overlap">
	<?php 
		$phone = get_field('phone_number','option');
		$off_canvas_cta = get_field('off_canvas_cta','options');
		$off_canvas_cta_link = get_field('off_canvas_cta_link','options');
	?>
	<div class="grid-y" style="height:100%">
		<div class="auto cell middle-cell">	
			<div class="off-cv-wrapper"> 
				<?php joints_top_nav(); ?>
			</div>
		</div>
		
		<div class="cell small-4 bottom-cell contact-info-cell">
		<hr>
			<div class="grid-x grid-padding-x align-middle" style="height:100%;">	
				<div class="cell small-12 cell-info">
					<div class="grid-x">
						<div class="small-7 cell">
							<span><strong>For Speaking Booking</strong></span>
							<span>Call Shelly Harrison</span>
						</div>
						<div class="small-5 cell">
							<div class="off-canvas-cta-button">
								<a href="<?=$off_canvas_cta_link?>" class="button yellow rounded"><?=$off_canvas_cta?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12 cell-social">
					<div class="grid-x">
						<div class="small-6 cell social-title-cell">
							<span><strong>Follow Me!</strong></span>
						</div>
						<div class="small-6 cell">
							<div class="off-cv-social-wrapper">
								<?php echo do_shortcode('[offcanvasSocial]'); ?>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>