<?php
/**
 * The template for displaying the footer. 
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */			
// set up addtional footer acf fields 
$additionalFooter = get_field('footer_toggler','options');
$addtionalFooterContent = get_field('footer_content','options');
$footerbg = get_field('footer_background_images','options');
$contentLeft  = get_field('content_left','options');
$contentMiddle  = get_field('content_middle','options');
$contentRight = get_field('content_right','options');
$contentTitle = get_field('content_title','options');
$site_details = get_field('footer_site_details', 'options');

$helloBarBgColor = get_field('background_color_hello_bar', 'options');
$helloBarTxtColor = get_field('text_color_hello_bar', 'options');
$helloBarContent = get_field('content_hello_bar', 'options');

	if ($footerbg):
	/* loop through the images in the banner background images gallery field and save them as an array 
	** for use in our data-interchange background src.  
	** dataInterchangeImgs() can be found on assets/functions/theme-support.php --- line 75
	*/
		$dataInterchange = dataInterchangeImgs($footerbg);
	endif;

?>								
			<?php if( is_page_template('template-contact.php') ) : ?>	
				<footer class="footer" role="contentinfo">
					<div class="inner-footer grid-x grid-container grid-x-padding">						
						<div class="small-12 text-center cell additional-footer-custom">
							<div class="contact-footer-content">
									<?=$site_details;?>	
							</div>
						</div>				
					</div> <!-- end #inner-footer -->
			<?php else: ?>
				<?php if( !is_front_page() ): ?>
				 <button onclick="topFunction()" id="myBtn" title="Go to top" data-smooth-scroll>Top</button>
				<?php endif; ?>
				<footer class="footer" role="contentinfo" style="background-size: cover; background-repeat: no-repeat;" 
				<?php if($dataInterchange):?> data-interchange="<?=$dataInterchange?>" <?php endif; ?>>

				<div class="inner-footer grid-container">	
					<div class="inner-footer grid-x grid-padding-x align-center">
						<div class="cell small-12 text-left footer-title"><h2><?=$contentTitle;?></h2></div>					
						<div class="text-left cell small-12 xmedium-4 large-4 footer-left">
							<?=$contentLeft;?>			
						</div>
						<div class="text-left cell small-12 xmedium-4 large-4 footer-middle">
							<?=$contentMiddle;?>	
						</div>
						<div class="text-center cell small-12 xmedium-4 large-4 footer-right">
							<?=$contentRight;?>	
						</div>		
					</div>
				</div>
				<div class="grid-x grid-container grid-x-padding align-center">					
					<div class="small-12 text-left large-left cell additional-footer">
						<div class="additional-footer-content">
							<?=$site_details;?>
						</div>
					</div>				
				</div> <!-- end #inner-footer -->
			<?php endif;?>
				
			</footer> <!-- end .footer -->
			
			</div>  <!-- end .off-canvas-content -->
		<?php if ( get_field( 'enable_hello_bar', 'option' ) == 1 ) : ?>
			<div class="reveal top-hello-bar modal-popout-wrapper" data-closable id="hello-bar" style="max-width: 100%;">		
					<div class="reveal-container modal-popout" style="background-color:<?=$helloBarBgColor;?> ; color:<?=$helloBarTxtColor;?>;" >	
						<div class="grid-container align-middle">
							<div class="grid-x align-middle align-center text-center">	
								<div class="cell small-11"><?=$helloBarContent;?> </div>
								<button class="close-button button rounded" data-close aria-label="Close modal" type="button">
								    <span aria-hidden="true" style="color:<?=$helloBarTxtColor;?>;">Close</span>
								 </button>	
							</div>
						</div>
					</div>
				</div>
		<?php endif; ?>
		</div> <!-- end .off-canvas-wrapper -->
		<?php get_template_part( 'parts/components/component', 'modals' );?>
		<?php wp_footer(); ?>		
	</body>
	
</html> <!-- end page -->