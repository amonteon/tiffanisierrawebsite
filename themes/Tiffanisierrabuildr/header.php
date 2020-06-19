<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 */
?>

<!doctype html>
<?php $navStyleClass = ''; ?>
  <html class="no-js <?=$navStyleClass;?>"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">
		
		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />	
	    <?php } ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">		
		<?php wp_head(); ?>		
		<?php 
			$custom_head_tag_code = get_field('custom_head_tag_code');
			$head_tag_codes = get_field('head_tag_codes','options');
				
				if($custom_head_tag_code):
					echo $custom_head_tag_code;
				elseif($head_tag_codes):
					echo $head_tag_codes;
				endif; ?>
			 <!-- Place your kit's code here -->
          <script src="https://kit.fontawesome.com/b27a47f75a.js" crossorigin="anonymous"></script>	
	</head>

	<body <?php body_class(); ?>>
		<?php 
			$loaderClass = "";  
			$logo = get_field('logo','options');
			$enable_front_page_loader = get_field('enable_front_page_loader','options');
			$background_color_fp_loader = get_field('background_color_fp_loader','options');
			$featured_image_fp_loader = get_field('featured_image_fp_loader','options');
			$fp_loader_msg = get_field('fp_loader_msg','options');
			$fp_loader = get_field('fp_loader','options');
			$fp_loader_color = get_field('fp_loader_color','options');
			$phone = get_field('phone_number','options');
			$alt_number = get_field('alt_number','options');
			$fax_number = get_field('fax_number','options');
			$email_address = get_field('email_address','options');
		?>	
		<?php if(is_front_page() && $enable_front_page_loader):  $loaderClass = "init-loader" ?>
				
				<div id="loader-wrapper" style="background-color:<?=$background_color_fp_loader ?>;">
		    	<div class="loader-container">
			    	<div id="loader" class="text-center animated fadeIn">				    	
				    	<?php if($featured_image_fp_loader): ?>
				    	<img src="<?=$featured_image_fp_loader['url']?>" width="<?=$featured_image_fp_loader['width']?>" height="<?=$featured_image_fp_loader['height']?>"><br> 
				    	<?php else: ?>
				    	<img class="style-svg" src="<?=$logo['url']?>" width="<?=$logo['width']?>" height="<?=$logo['height']?>"><br> 
				    	<?php endif; ?>
				    	<?php if($fp_loader_msg): echo '<br><small style="color:'.$fp_loader_color.';">'.$fp_loader_msg.'</small><br>'; endif; ?>			    	
						<img src="<?=$fp_loader['url']?>" width="<?=$fp_loader['width']?>" height="<?=$fp_loader['height']?>">
						
						<noscript>
						 <div class="text-center"><p>For full functionality of this site, it is necessary to enable JavaScript.<br>
						 Here are the <a href="https://www.enable-javascript.com/" target="_blank">
						 instructions how to enable JavaScript in your web browser</a>.</p><p>
							 If you have questions / concerns about the site<br>
							  please call us at  <a href="tel:+1<?php echo _phone_num($phone)?>"><?=$phone?></a><br> 
							 <?php if($email_address): ?>
							 or send us an email at  <a href="mailto:<?=$email_address;?>"><?=$email_address;?></a>
							 <?php endif; ?>
						 </p></div>
						</noscript>
					 </div>	
		    	</div>				 		 
			</div>		
		<?php endif; ?>	
		<div class="ie-warning">
			<div class="grid-x align-center-middle">
				<div class="cell small-12 text-center">
					<p>We detected that you're using an older version of Internet Explorer. please upgrade IE 11 or later</p>
					<p>Alternatively, you can install and use these secure and newest browsers: <a href="https://www.google.com/chrome/" target="_blank">Chrome</a> | <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Firefox</a> | <a href="https://www.apple.com/safari/" target="_blank">Safari for MacOS</a> | <a href="https://www.microsoft.com/en-us/windows/microsoft-edge" target="_blank">Edge for Windows</a></p> 
				</div>
			</div>			
		</div>	
		<?php $navigationType = get_theme_mod("tiffanibuildr_nav_type"); 
			if ( $navigationType == 'offcanvas_curtain') {
				get_template_part( 'parts/navs/nav', 'offcanvas-curtain' );
			} elseif ( $navigationType == 'offcanvas_tiles') {
				get_template_part( 'parts/navs/navigation', 'bar-tiles' );
			} else	{
				get_template_part( 'parts/navs/navigation', 'bar-default' );
			}	
		?>
		<div class="off-canvas-wrapper">			
			<!-- Load off-canvas container. Feel free to remove if not using. -->	
						
				<?php get_template_part( 'parts/navs/offcanvas', 'mobile-menu' ); ?>		

			<div class="off-canvas-content" data-off-canvas-content>				

				<header class="header" role="banner">				
					 <!-- This navs will be applied to the topbar, above all content 
						  To see additional nav styles, visit the /parts directory -->
						<noscript>
						 <div class="internal-popup-nojs">
							 <div class="text-center cell auto"><p>For full functionality of this site, it is necessary to enable JavaScript.<br>
							 Here are the <a href="https://www.enable-javascript.com/" target="_blank">
							 instructions how to enable JavaScript in your web browser</a>.</p><p>
								 If you have questions / concerns about the site<br>
								  please call us at  <a href="tel:+1<?php echo _phone_num($phone)?>"><?=$phone?></a><br> 
								 <?php if($email_address): ?>
								 or send us an email at  <a href="mailto:<?=$email_address;?>"><?=$email_address;?></a>
								 <?php endif; ?>
							 </p></div>
						 </div>
						</noscript> 
				</header> <!-- end .header -->