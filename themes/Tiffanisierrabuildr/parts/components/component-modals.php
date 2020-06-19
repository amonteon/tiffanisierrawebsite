<?php if(have_rows('modals_diag','options')): ?>
	
	<?php while (have_rows('modals_diag','options')): the_row(); ?>

		<?php 
			$title = get_sub_field('title','options');
			$background_image = get_sub_field('background_image', 'options');
			$content = get_sub_field('content','options');			
			$unique_id = get_sub_field('unique_id','options'); 
			$text_color = get_sub_field('text_color','options');
		?>
		<?php if($unique_id == "contact-floating-button") : ?>
			<?php if( !(is_page_template('template-contact.php') || is_page_template('template-specials.php') || is_home() || is_front_page() ) ) :?>	
				<div class="contact-floating-button-btn"><button class="button" data-open="exampleModal1"><i class="fal fa-envelope"></i><?=$content?></button></div>
			<?php endif; ?>
		<?php else : ?>
			<div style="display: none;" class="modal-popout-wrapper" id="<?=$unique_id;?>">		
				<div class="modal-popout" style="background-image:url(<?=$background_image['url'];?>); background-repeat: no-repeat; background-size: cover; color:<?=$text_color?>;">		
					<?=$content?>
				</div>
			</div>
		<?php endif; ?>

	<?php endwhile; ?>	
		
<?php endif; ?>