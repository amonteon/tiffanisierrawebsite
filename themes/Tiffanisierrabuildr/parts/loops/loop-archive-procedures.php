<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">	
					
	<section class="entry-content" itemprop="articleBody">
        <div class="small-12 noPad columns imgWrap">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
            <p> <?php echo get_the_excerpt(); ?></p>
        </div>	
        <hr>
	</section>			    						
</article> <!-- end article -->