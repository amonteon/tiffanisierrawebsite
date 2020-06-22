<?php 
	// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
	
	
	if(is_home()):
		// This can be found @ Admin > Appearance > Customize > Sub Pages > Choose Sub Page Template
		$template_type = get_theme_mod("tiffanibuildr_archive_type"); 
		$container_attr = "";
		switch ($template_type) {
	    case "two_col_grid":
	      	$grid_attr ="";
	        $cell_attr = "small-12 medium-12 large-12";      
	        break;
	    case "full_width_grid_10":
	    	$grid_attr ="align-center grid-padding-x"; 
	        $cell_attr = "small-12 medium-12 large-10";               
	        break; 
	    case "full_width_grid":
	        $cell_attr = "small-12 medium-12 large-10";
	        $grid_attr =  "grid-padding-x align-center";       
	        break;
	    case "full_width_grid_nc":
	        $cell_attr = "small-12 medium-12 large-12";
	        $grid_attr =  "";
	        $container_attr = "";       
			break;}	 
			
	else:

		$template_type = get_theme_mod("tiffanibuildr_subpage_type"); 
		$container_attr = "";
		$cell_attr = "";
		$fullwidthVisual = 0; 
		$fullwidthText = 0; 
		$faqAccordion = 0;
		
		switch ($template_type) {
		
		/****
			USE this variables when making a new flexible field
		****/
			
	    case "full_width_grid_10":
	    	$grid_attr ="align-center"; 
	        $cell_attr = "small-12 medium-12 xmedium-12 large-10";  
	        $container_attr = "";             
	        break; 
	    case "full_width_grid":
	        $cell_attr = "small-12 medium-12 large-12";
	        $grid_attr =  "grid-padding-x"; 
	        $container_attr = "grid-container";       
	        break;
	    case "full_width_grid_nc":
	        $cell_attr = "small-12 medium-12 large-12";
	        $grid_attr =  "";
	        $container_attr = "";       
			break;
		}	
	
	endif;
	
	$breadcrumbs_shortcode = get_field('breadcrumbs_shortcode','options'); 
?>	

<div class="<?=$container_attr?>">
	<div class="grid-x">
		<div class="cell <?=$cell_attr?>">
			<?php echo do_shortcode($breadcrumbs_shortcode); ?>
		</div>
	</div>
</div>
