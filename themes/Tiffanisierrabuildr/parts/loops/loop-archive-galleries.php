<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">	
					
	<section class="entry-content" itemprop="articleBody">

		<?php // start awesome custom gallery 		
		if( have_rows('patient_galleries') ):
		// define the counters
		$set = 0;
		$ctr = 0;

	    while ( have_rows('patient_galleries') ) : the_row(); $set++;
		$images         = get_sub_field('gallery');
		$lastCtr        = count($images);
		$startGallery   = '<div class="grid-x grid-padding-x archive-galleries">';
		$endGallery     = '</div>';
		$showOnArchive  = get_sub_field('show_in_archive');
		$cats = get_categories(); 
		?>
		<?php if ($showOnArchive == 1):?>
			<?php if ( $images ): $endRowCount  = 0;?>
				<?php foreach( $images as $image ): $ctr++;?>
					<?php if ( $ctr == 1 ):?>
						<?php 
							// start the .galleryBox row and the .startSmallImgs row
							if ( $ctr == 1 ){ echo $startGallery; }
						?>
							<?php foreach ($cats as $cat) : ?>
							<div class="cell small-12 large-4">
								<?php $cat_id= $cat->term_id; ?>
								<a href="<?php the_permalink();?>">
			                    	<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['url']; ?>" class="fullimg" alt="<?php echo $image['alt']; ?>" /> 	
								</a>
								<span class="gallery-category-name"><?php echo $cat->name; ?></span>
								<a class="gallery-link" href="<?php the_permalink();?>"> View Gallery</a>
		                </div>
							 <?php endforeach; ?>
							
							
		                
						<?php // close the .galleryBox row and the .startSmallImgs row 	
							if ( $ctr == $lastCtr  && $ctr == 1) {
								echo '<hr/>' . $endGallery;
							}
						?>
					<?php endif;?>
				<?php endforeach; ?>		
			
			<?php endif; ?>
		<?php endif;?>	
		<?php 
	    endwhile; $set = 0;
	endif;?>			    						
</article> <!-- end article -->