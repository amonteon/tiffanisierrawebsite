<?php
/**
 * Contents of the Add/Edit sidebar popup in the widgets screen.
 *
 * This file is included in widgets.php.
 */
?>

<form class="wpmui-form">
	<input type="hidden" name="do" value="save" />
	<input type="hidden" name="sb" id="csb-id" value="" />
<?php wp_nonce_field( 'custom-sidebars-edit-sidebar' ); ?>
	<div class="wpmui-grid-8 no-pad-top">
		<div class="col-3">
			<label for="csb-name"><?php _e( 'Name', 'custom-sidebars' ); ?></label>
			<input type="text" name="name" id="csb-name" maxlength="40" placeholder="<?php _e( 'Sidebar name here...', 'custom-sidebars' ); ?>" />
			<div class="hint"><?php _e( 'The name should be unique.', 'custom-sidebars' ); ?></div>
		</div>
		<div class="col-5">
			<label for="csb-description"><?php _e( 'Description', 'custom-sidebars' ); ?></label>
			<input type="text" name="description" id="csb-description" maxlength="200" placeholder="<?php _e( 'Sidebar description here...', 'custom-sidebars' ); ?>" />
		</div>
	</div>
	<hr class="csb-more-content" />
	<div class="wpmui-grid-8 csb-more-content">
		<div class="col-8 hint">
			<strong><?php _e( 'Caution:', 'custom-sidebars' ); ?></strong>
			<?php _e(
				'Before-after title-widget properties define the html code that will wrap ' .
				'the widgets and their titles in the sidebars, more info about them on the '.
				'<a href="http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress" target="_blank">Justin ' .
				'Tadlock Blog</a>. Do not use these fields if you are not sure what you are doing, it can break ' .
				'the design of your site. Leave these fields blank to use the theme sidebars design.', 'custom-sidebars'
			); ?>
		</div>
	</div>
	<div class="wpmui-grid-8 csb-more-content">
		<div class="col-4">
			<label for="csb-before-title"><?php _e( 'Before Title', 'custom-sidebars' ); ?></label>
			<textarea rows="4" name="before_title" id="csb-before-title"></textarea>
		</div>
		<div class="col-4">
			<label for="csb-after-title"><?php _e( 'After Title', 'custom-sidebars' ); ?></label>
			<textarea rows="4" name="after_title" id="csb-after-title"></textarea>
		</div>
	</div>
	<div class="wpmui-grid-8 csb-more-content">
		<div class="col-4">
			<label for="csb-before-widget"><?php _e( 'Before Widget', 'custom-sidebars' ); ?></label>
			<textarea rows="4" name="before_widget" id="csb-before-widget"></textarea>
		</div>
		<div class="col-4">
			<label for="csb-after-widget"><?php _e( 'After Widget', 'custom-sidebars' ); ?></label>
			<textarea rows="4" name="after_widget" id="csb-after-widget"></textarea>
		</div>
	</div>
	<div class="buttons">
		<label for="csb-more" class="wpmui-left">
			<input type="checkbox" id="csb-more" />
			<?php _e( 'Advanced - Edit custom wrapper code', 'custom-sidebars' ); ?>
		</label>

		<button type="button" class="button-link btn-cancel"><?php _e( 'Cancel', 'custom-sidebars' ); ?></button>
		<button type="button" class="button-primary btn-save"><?php _e( 'Create Sidebar', 'custom-sidebars' ); ?></button>
	</div>
</form>