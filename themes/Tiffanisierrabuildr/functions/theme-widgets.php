<?php 

class ACF_Gallery_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'acf_widget_1', // Base ID
      __('ACF Gallery Widget', 'text_domain'), // Name
      array( 'description' => __( 'This is a custom acf gallery widget', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
  **/
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    
    $images = get_field('gallery','widget_' .$args['widget_id']);

	if( $images ):?>
	<?php // show for each breakpoint
	$sfSmall  = get_field('show_for_small','widget_' .$args['widget_id']);
	$sfMedium = get_field('show_for_medium','widget_' .$args['widget_id']);
	$sfLarge  = get_field('show_for_large','widget_' .$args['widget_id']);
	?>
	<div class="grid-x grid-padding-x small-up-<?=$sfSmall;?> medium-up-<?=$sfMedium;?> large-up-<?=$sfLarge;?>">
	<?php foreach( $images as $image ): ?>
	<div class="cell">
	<a class="fancybox" data-fancybox rel="widgetGallery" href="<?php echo $image['url']; ?>">
	     <img style="margin-bottom: 1rem;" src="<?php echo $image['sizes']['thumbnail']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo $image['alt']; ?>" />
	</a>
	</div>
	<?php endforeach; ?>
	</div>
	<?php endif;
    echo get_field('text_field', 'widget_' . $args['widget_id']);
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
  **/
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Custom_Widget

// register Custom_Widget widget
add_action( 'widgets_init', function(){
  register_widget( 'ACF_Gallery_Widget' );
});



// start acf slider widget

class ACF_Slider_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'acf_widget_2', // Base ID
      __('ACF Slider Widget', 'text_domain'), // Name
      array( 'description' => __( 'This is a custom acf slider widget', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
  **/
  public function widget( $args, $instance ) {
    $bgImg         = get_field('background_image','widget_' .$args['widget_id']); 
    $bgColor       = get_field('background_color','widget_' .$args['widget_id']);
    $textColor     = get_field('text_color','widget_' .$args['widget_id']);
    $textAlign     = get_field('text_align','widget_' .$args['widget_id']);
    $custTitle     = get_field('custom_title','widget_' .$args['widget_id']);
    $titleSize     = get_field('title_font_size','widget_' .$args['widget_id']);
    $titleAlign     = get_field('title_align','widget_' .$args['widget_id']);
    ?>

    <?php
    echo $args['before_widget'];?>
        <div class="cell small-12 reviewSliderTop <?php if ($bgImg): echo ' hasBackGround '; endif;?>" style="
		background-color: <?=$bgColor;?>;
		color: <?=$textColor;?>;
		background-image: url(<?=$bgImg['url'];?>);
		background-size: cover;
		background-repeat: no-repeat;
		background-position: top center;
	
	">
		

    <?php 
	    $item = apply_filters( 'widget_title', $instance['title']);
    if ( !empty( $item) ) {
      echo '<h4 class="widgettitle  '; if($titleSize): echo ' customFontSize'; endif; if ($titleAlign == 'center'): echo ' text-center';  elseif ($titleAlign == 'right'): echo ' text-right'; else: echo ' text-left'; endif; echo '" style=" font-size:'.$titleSize.'px;'.'">' . apply_filters( 'widget_title', $instance['title'] ). '</h4>';
    }
    if ($custTitle){
	    echo '<h4 class="text-center">'. $custTitle . '</h4>';
    }
    $slides = get_field('slides','widget_' .$args['widget_id']);
    $extracontent = get_field('extra_bottom_content','widget_' .$args['widget_id']);

	if( $slides ):?>
	<?php 	global $post; ?>
	<div style="clear:both"></div>	
	<div class="sbReviewsSlider" style="
	color: <?=$textColor;?>;
	">
	<?php foreach( $slides as $post ): ?>
	
	<?php $show = get_field('show_content','widget_' .$args['widget_id']);?>
	<?php setup_postdata($post); ?>
	<div class="cell small-12 wSlide <?php if($textAlign == 'center'): echo 'text-center';  elseif ($textAlign == 'right'): echo 'text-right'; else: echo 'text-left'; endif;?>">
			
		<?php if(get_field('rating')):?>	
			 <div class="rating-stars text-center">
			<?php $rating = get_field('rating'); ?>
			<?php $counter = 0; ?>
			<?php $starclass = ""; ?>
			<?php 
				switch ($rating) {
				    case 1:
				        $starclass = "red";
				        break;
				    case 2:
				        $starclass = "orange";
				        break;
				    case 3:
				         $starclass = "orange";
				        break;
				    case 4:
				         $starclass = "gold";
				        break;
				    case 5:
				         $starclass = "gold";
				        break;									        									        
				}									
			?>
			<?php // while($counter != 5) { 									
				  // 	if($rating > $counter) : ?> 
				<!-- <i class="fa fa-star <?=$starclass?>"></i> -->
			<?php // 	else : ?>
				<!--  <i class="fa fa-star-o <?=$starclass?>"></i>									 -->
			<?php // 	endif; ?>
		    <?php // 	$counter++;
				  // 	}										
			?>	
			</div>						
		<?php endif; ?>										
		
		<?php if ($show == 'image' || $show == 'both' && $show != 'excerpt'):?>
		<?php echo get_the_post_thumbnail( $post->ID,'medium' );?>
		<?php endif;?>
		<?php if ($show == 'excerpt' || $show == 'both' && $show != 'image'):?>
			<?php 
			$excerpt = get_the_content();
			$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = strip_tags($excerpt);
			$excerpt = substr($excerpt, 0, 209);
			$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
			$excerpt = '<p><em>&#8220;' . $excerpt . ' ... ' . '&#8221;</em></p>';
		echo $excerpt;?>
		<?php endif;?>
		<?php if ($show == 'image'):?>
		<?php echo '<p class="noPadTop"><a style="color:'.$textColor.';" class="readMore" href="'. get_the_permalink($post->ID) .'">Read More &raquo;</a></p>';?>
		<?php endif;?>
	</div>
	<?php endforeach; ?>	
	
	<?php wp_reset_postdata();?>
	<?php endif;?>
	
	<?php 	
    echo get_field('text_field', 'widget_' . $args['widget_id']);
    echo $args['after_widget'] . '<div class="wextraContent">'. $extracontent . '</div><div class="small-12 cell"><a class="button primary expanded large" href="/reviews/">See More</a></div></div></div><!-- end .sbReviewsSlider -->';
  ?>
  
  <?php 
  }
  /**
   * Back-end widget form.
  **/
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Custom_Widget

// register Custom_Widget widget
add_action( 'widgets_init', function(){
  register_widget( 'ACF_Slider_Widget' );
});



// start acf custom text widget

class ACF_Custom_Text extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'acf_widget_3', // Base ID
      __('ACF Custom Text Widget', 'text_domain'), // Name
      array( 'description' => __( 'This is a custom acf text widget', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
  **/
  public function widget( $args, $instance ) {
    $hasTopContent = get_field('has_top_content','widget_' .$args['widget_id']);
    $bgImgTop      = get_field('background_image_top','widget_' .$args['widget_id']);
    $topContent    = get_field('top_content','widget_' .$args['widget_id']);
    $bgImg         = get_field('background_image','widget_' .$args['widget_id']); 
    $bgClr         = get_field('base_background_color','widget_' .$args['widget_id']); 
	$invert_text   = get_field('invert_text', 'widget_' .$args['widget_id']);
	$align_text    = get_field('align_text', 'widget_' .$args['widget_id']);
	$v_align       = get_field('vertical_align', 'widget_' . $args['widget_id']);
	$min_height    = get_field('min_height', 'widget_' . $args['widget_id']);
	$twContent     = get_field('custom_text_widget','widget_' .$args['widget_id']);
    $xtraClass     = get_field('add_classes','widget_' .$args['widget_id']);
    $interchangeImgsBGs = dataInterchangeImgs($bgImg);
    
    ?>
	<?php if (!$bgImg) : 
		$bgCheckr = 'wNoBg ';
	else:
		$bgCheckr = 'wYesBg ';
	endif;?>
    <div class="widgetBoxWrap grid-x <?php if ($v_align){ echo $v_align;}?> <?php if($xtraClass){echo $xtraClass . ' ';}?>" <?php if ($bgImg) : ?> 
    data-interchange="<?=$interchangeImgsBGs?>"
	style="
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
	min-height: <?=$min_height . 'px';?>;
	height: auto;
    "<?php else:?>
	style="
	min-height: <?=$min_height . 'px'; ?>;	
	height: auto; background-color:<?=$bgClr;?>"
	<?php endif;?>>
    <?php if ($hasTopContent):?>
        <div class="cell widgetBoxTop small-12<?php if($invert_text == true):?> whiteTitle<?php endif;?>" style="<?php if ($bgImgTop):?>background-image: url(<?=$bgImgTop['url'];?>); background-size: cover; background-position:center top; <?php endif;?>">
			<?=$topContent;?>
        </div>
    <?php endif;?>
    <div class="cell small-12 widgetBox <?=$bgCheckr;?> custTextWidget <?php if($xtraClass){echo $xtraClass . ' ';}?><?php if ($bgImg) : ?> widgetBg<?php endif;?><?php if ( $align_text == 'center' ):?> text-center <?php elseif( $align_text == 'right'):?> text-right<?php else:?> text-left<?php endif;?><?php if($invert_text == true):?> whiteTitle<?php endif;?>">
    <?php
    echo $args['before_widget'];
    $items = apply_filters( 'widget_title', $instance['title'] );
    if ( !empty($items)) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }?>
	<?=$twContent;?>
		
	<?php
    echo get_field('text_field', 'widget_' . $args['widget_id']);
    echo $args['after_widget'] ;
  ?>
    </div>
  </div> <!-- end widgetBoxWrap -->

  <?php 
  }

  /**
   * Back-end widget form.
  **/
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Custom_Widget

// register Custom_Widget widget
add_action( 'widgets_init', function(){
  register_widget( 'ACF_Custom_Text' );
});
	

// Start CTA Widget
class CTA_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'acf_widget_6', // Base ID
      __('CTA Widget', 'text_domain'), // Name
      array( 'description' => __( 'This is a CTA/Banner Ad Style widget', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
  **/
  public function widget( $args, $instance ) {
	
	$cta_widget_main_class_name = get_field('cta_widget_main_class_name','widget_' .$args['widget_id']);
	$background_image = get_field('background_image','widget_' .$args['widget_id']);
	$add_featured_content = get_field('add_featured_content','widget_' .$args['widget_id']);
	$featured_content = get_field('featured_content','widget_' .$args['widget_id']);
	$add_featured_image = get_field('add_featured_image','widget_' .$args['widget_id']);
	$content = get_field('content','widget_' .$args['widget_id']);
	$featured_image = get_field('featured_image','widget_' .$args['widget_id']);
	$featured_image_class_name = get_field('featured_image_class_name','widget_' .$args['widget_id']);
	$content_class_name = get_field('content_class_name','widget_' .$args['widget_id']);
	$layout = get_field('layout','widget_' .$args['widget_id']);
	$alignment = get_field('alignment','widget_' .$args['widget_id']);
	$interchangeImgsBG = dataInterchangeImgs($background_image);
	$interchangeImgs = dataInterchangeImgs($featured_image);
	
	
    echo $args['before_widget'];?>
		<div class="call-to-action-widget" id="<?=$cta_widget_main_class_name?>" data-interchange="<?=$interchangeImgsBG?>">					
			<div class="grid-container grid-x align-center">
				<div class="small-12 medium-10 <?=$layout?>">
					<div class="cta-background" >	
						<div class="grid-x <?=$alignment?> grid-internal <?=$cta_widget_main_class_name?>">
							<div class="cell <?=$content_class_name?>">
								<?=$content?>									
							</div>
							<?php if($add_featured_image ): ?>
							<div class="cell <?=$featured_image_class_name?>" >								
								<div class="portrait-photo" data-interchange="<?=$interchangeImgs?>">
								<?php 
									if($add_featured_content): 
										echo $featured_content; 
									endif; 
								?>
								</div>								
							</div>	
							<?php endif; ?>							
						</div>						
					</div>
				</div>				
			</div>			
		</div>
	<?php 	
    echo get_field('text_field', 'widget_' . $args['widget_id']);
    echo $args['after_widget'];
  ?>
  
  <?php 
  }
  /**
   * Back-end widget form.
  **/
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Custom_Widget

// register CTA_Widget widget
add_action( 'widgets_init', function(){
  register_widget( 'CTA_Widget' );
});

// start ACF_Related_Posts widget

class ACF_Related_Posts extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'acf_widget_7', // Base ID
      __('ACF Related Posts Widget', 'text_domain'), // Name
      array( 'description' => __( 'This is a custom acf related posts widget', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
  **/
  public function widget( $args, $instance ) { ?>
	<?php 
	global $post;
	setup_postdata( $post );
	if(is_home()):
		$relatedPosts = get_field('related_posts', get_option('page_for_posts'));
		$add_excerpt = get_field('show_excerpt', get_option('page_for_posts'));
	else:
		$relatedPosts = get_field('related_posts', get_the_ID());
		$add_excerpt = get_field('show_excerpt', get_the_ID());
	endif;
	
	?>
    <?php if( $relatedPosts ): ?>
    <div class="cell small-12 widgetBox acfRelatedPosts">
    <?php
    echo $args['before_widget'];
    if ( !empty($instance['title']) ) {
	
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    
    }?>
	
    
	   
		<?php if($add_excerpt): ?>
			 <div class="hasLinks excerptRelated">
			 	<?php foreach( $relatedPosts as $post): // variable must be called $post (IMPORTANT) ?>
			        <?php $altTitle = get_field('alt_title');?>
			        <?php setup_postdata($post); ?>   
				 	<p>
					 	<strong> 
					 	<?php if ($altTitle):?> <?=$altTitle;?><?php else:?><?php the_title(); ?><?php endif;?>
					 	</strong>
					 </p>
					 <p>
						 <?php the_excerpt(); ?>
					 </p>
					 <p>
						 <a href="<?php the_permalink(); ?>">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
					 </p>
			    <?php endforeach; ?>		 
			    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					 	
			 </div>		
		<?php else: ?> 
		 <div class="hasLinks customDots grid-x grid-padding-x related-post-wrapper">
	    <?php foreach( $relatedPosts as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php $altTitle = get_field('alt_title');?>
	        <?php setup_postdata($post); ?>
	        <div class="cell small-12 medium-12 large-12">
		        <div class="grid-x grid-padding-x align-center">
				   <div class="blog-title-link cell small-12  medium-12 large-12"><a href="<?php the_permalink(); ?> " class="secondary link"><?php if ($altTitle):?> <?=$altTitle;?><?php else:?><?php the_title(); ?><?php endif;?></a></div>
		        </div>
	        </div>
	        
	    <?php endforeach; ?>
	    </div>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>
			
	
	
		
	<?php
    echo get_field('text_field', 'widget_' . $args['widget_id']);
    echo $args['after_widget'];
  ?>
  </div>
  <?php endif; ?>
  <?php 
  }

  /**
   * Back-end widget form.
  **/
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
  **/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Custom_Widget

// register ACF_Related_Posts widget
add_action( 'widgets_init', function(){
  register_widget( 'ACF_Related_Posts' );
});

// remove unused widgets
function unregister_default_wp_widgets() {
 
     unregister_widget('WP_Widget_RSS');
    // unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_Archives');
    // unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Calendar');
}
 
add_action('widgets_init', 'unregister_default_wp_widgets' );
