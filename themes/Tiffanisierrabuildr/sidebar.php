<?php 
/**
 * The sidebar containing the main widget area
 */
 ?>
<div class="sidebar-wrapper small-12 medium-10 large-4 cell" role="complementary">
	<div id="sidebar1" class="sidebar">
	
		<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
	
			<?php dynamic_sidebar( 'sidebar1' ); ?>
	
		<?php else : ?>
	
		<!-- This content shows up if there are no widgets defined in the backend. -->
							
		<div class="alert help">
			<p><?php _e( 'Please activate some Widgets.', 'jointswp' );  ?></p>
		</div>
	
		<?php endif; ?>
	
	</div>
</div>