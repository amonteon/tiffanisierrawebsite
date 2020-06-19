<article id="post-<?php the_ID(); ?>" <?php post_class('animated fadeIn'); ?> role="article">					
	<header class="">
		
		<?php /* get_template_part( 'parts/content', 'byline' ); */ ?>
	</header> <!-- end article header -->
	<?php
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	if (function_exists('vp_get_thumb_url')):
		// Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size 
		$thumb=vp_get_thumb_url($post->post_content, 'medium' , $post->ID ); 

	endif;
	?>				
	<section class="entry-content blog-wrapper" itemprop="articleBody">
		<div class="grid-x grid-padding-x">
			<?php if($feat_image): ?>
			<div class="cell small-6"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a></div>
			<div class="cell small-6 align-self-middle">
				<a class="blog-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h4><?php the_title(); ?></h4></a>
				<span class="blog-date"><?php echo get_the_date(); ?></span>			
			</div>			
			<div class="cell small-12">
				<a class="blog-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h4><?php the_title(); ?></h4></a>
				<div class="blog-exceprt"><?php echo get_the_excerpt(); ?></div>
				<a href="<?php the_permalink() ?>" class="tiny">Read more »</a>
			</div>
			<?php elseif ($thumb):?>			
			    <div class="cell small-12 medium-4">
				    <a href="<?php the_permalink();?>" >
					    <img class="alignnone" src="<?php echo $thumb; ?>"  />
					</a>
				</div>
				<div class="cell small-12 medium-8 align-self-middle">
					<a class="blog-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h4><?php the_title(); ?></h4></a>
				</div>
				<div class="cell small-12">			
					<div class="blog-exceprt"><?php echo get_the_excerpt(); ?>... </div>
					<a href="<?php the_permalink() ?>" class="tiny">Read more </a>
				</div>						
			<?php else:?>   	
				<div class="cell small-12 medium-12">
					<a class="blog-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h4><?php the_title(); ?></h4></a>
				</div>			
				<div class="cell small-12 medium-12">
					<?php echo get_the_excerpt(); ?>...<br><a href="<?php the_permalink() ?>"class="tiny">Read more </a>
				</div>	
			<?php endif;?>	
			
			</div>	
					
	</section> <!-- end article section -->

	<hr>			
			    						
</article> <!-- end article -->
