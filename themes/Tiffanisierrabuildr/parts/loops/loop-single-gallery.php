<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
    <section class="entry-content" itemprop="articleBody">

<?php /* the_content(); */ ?>
<?php 
	$featured_widgets  = get_field('featured_widgets');		
	if( have_rows('patient_galleries') ): $count = 0; ?>
	<div class="grid-x grid-padding-x">		
	<?php while ( have_rows('patient_galleries') ) : the_row(); $count++; ?>	
		<div class="cell small-12 medium-12 large-6 float-left">
						
	<?php
		$images  = get_sub_field('gallery');
		$text = get_sub_field('text');
		$title = get_sub_field('title');
		$patient = get_sub_field( 'patient_name' );
		$randId = rand(); 
		if ( $images ): $ctr = 0; $totalimages = 0;  ?>
		<div class="galleryBox">
			<div class="grid-x align-center-middle">
				<?php foreach( $images as $image ): ?>
						<?php $totalimages++; ?>
				<?php endforeach;?>					
				<?php foreach( $images as $image ): $ctr++;?>				
						
					<?php if($ctr == 1): ?>				
						<div class="cell small-12 medium-12 imgWrap galSlideCell<?=$randId?>" >			
							<div class="main-gal-img">
								
		                	<a href="<?php echo $image['url']; ?>" rel="photoGallery<?=$count?>" data-fancybox="group<?=$count?>" data-caption="*Individual Results May Vary"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="fullimg" style="padding:0; margin:0; " alt="<?php echo $image['alt']; ?>" /></a>	
							</div>
		                </div>		              					
					<?php endif?>
					<?php if($ctr == 1):  ?>												
						</div>	
						<div class="grid-x  startSmallImgs imgWrapSub"> 		
					<?php endif; ?>
					<?php if($totalimages > 1): ?>			
						 <div class="small-6 xmedium-4 large-auto float-left cell imgWrap">
						 
		                	<a data-link="<?php echo $image['url']; ?>" class="imgGalItem photoGallery<?=$randId?> <?php if($ctr == 1) echo "is-active" ?>" rel="<?=$randId?>" data-groups="<?=$count?>">
		                    	<img src="<?php echo $image['sizes']['medium']; ?>" class="fullimg" alt="<?php echo $image['alt']; ?>" />
							</a>
														<?php if($ctr > 1): ?>
								<a href="<?php echo $image['url']; ?>" data-fancybox="group<?=$count?>" style="max-height: 0px; visibility: hidden; opacity: 0;"></a>
							<?php endif; ?>
		                </div>
		                
					<?php endif;?>	 
					<?php endforeach;?>
					
					</div>
					<span class="procedure-name"><?= $title; ?></span>
						<div class="text-left gallery-disclaimer cell small-12">* Individual Results May Vary</div>
					  <?php if($text): ?> 
		                	<?php if($totalimages <= 1){ $nclass = "the-text"; } else { $nclass = ""; } ?>
		                	<div class="grid-x align-center">
								<div class="cell small-12 xmedium-12 large-12 text-left <?=$nclass?> imgWrapSub" style="padding-top:10px; clear:both; padding-left:0; min-height:40px;">
										<?=$text?>
								</div>
		                	</div>
					<?php endif; ?>	

				</div>	
				<?php endif; ?>	
		</div>
			
			<?php if($count % 2):?>
				<div class="cell small-12 hide-for-medium"></div>	
			<?php endif; ?>
			
		<?php endwhile;	?>
	</div>
	<?php endif;?>		
	</section> <!-- end article section -->												
</article> <!-- end article -->