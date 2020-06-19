<?php
/*
Template Name: Thank You Page
*/

get_header(); ?>




<?php 
	$bgColorOne =  get_field( 'background_gradient_color_one', 'option' );
	$bgColorTwo =  get_field( 'background_gradient_color_two', 'option' );
	$bgColorThree =  get_field( 'background_gradient_color_three', 'option' );
?>
<div class="content thank-you-wrapper" id="content" style="background: linear-gradient(135deg, <?=$bgColorOne;?>, <?=$bgColorTwo;?>, <?=$bgColorThree;?>); ">
	
	<div class="grid-container align-middle text-center">
		<div class="inner-content grid-x grid-padding-x text-center align-center align-middle">	
	
			<main class="main small-12 medium-12 large-10 cell" role="main">
				
				<article class="thank-you-content">
					<section class="entry-content">
							<div class="page-heading">
							<h1 class="page-title"> 
								<?php the_title(); ?> 	
							</h1>
							<?php while( have_posts() ) : the_post(); ?>
								<div class="thank-you-content"><?php echo the_content();?></div>
							<?php endwhile; ?>
						</div>
						<div class="view-more-widget <?=$container_attr?>">
					<div class="grid-x <?=$grid_attr?>">
						<div class="cell <?=$cell_attr?>">
							<?php if ( have_rows( 'view_more_widget', 'option' ) ) : ?>
								<div class="grid-x <?=$grid_attr?>">
									<?php while ( have_rows( 'view_more_widget', 'option' ) ) : the_row(); ?>
										<div class="cell small-12 xmedium-6 view-more-widget-links-cell">
											<div class="view-more-link-wrapper">
												<div class="grid-x grid-padding-x">
													<span class="cell small-12 view-more-widget-title"><?php the_sub_field( 'widget_title' ); ?></span>
													<?php if ( have_rows( 'view_more_links' ) ) : ?>
													
														<?php while ( have_rows( 'view_more_links' ) ) : the_row(); ?>
															<?php $links = get_sub_field( 'links' ); ?>
															<?php if ( $links ) { ?>
																<div class="cell small-12">
																	<a class="other-links" href="<?php echo $links['url']; ?>" target="<?php echo $links['target']; ?>"><?php echo $links['title']; ?></a>
																</div>
															<?php } ?>
														<?php endwhile; ?>
													<?php endif; ?>
												</div>	
											</div>
										</div>
										<div class="small-12 xmedium-6 show-for-xmedium">
											<?php $view_more_image = get_sub_field( 'view_more_image' ); ?>
											<?php if ( $view_more_image ) { ?>
												<img src="<?php echo $view_more_image['url']; ?>" alt="<?php echo $view_more_image['alt']; ?>" />
											<?php } ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
					</section> <!-- end article section -->
			
				</article> <!-- end article -->
	
			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->
	<?php get_footer(); ?>
</div> <!-- end .grid-container -->

