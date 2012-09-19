<?php $comicpress_options = get_option('comicpress_options'); ?>
<div id="comicpress-design">

	<form method="post" id="myForm-post" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div class="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Design','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_design_options"><?php _e('Enable Design Options?','comicpress'); ?></label></th>
					<td>
						<input id="enable_design_options" name="enable_design_options" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']); ?> />
					</td>
					<td>
						<?php _e('The Design options are a set of fields where you can input the colors you want to set your site up with. This area is intended for those people who do *not* express any interest in knowing how to work with CSS.','comicpress'); ?>
					</td>
				</tr>
			</table>
			

			<?php if ($comicpress_options['enable_design_options']) { ?>
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Body','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="body_background"><?php _e('Background Color','comicpress'); ?></label></th>
					<td>
						#<input type="text" size="8" name="body_background" id="body_background" value="<?php echo $comicpress_options['design_options']['body_background']; ?>" /><br />
						<?php _e('The background HEX color of the entire site.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="body_background_image"><?php _e('Background Image URL','comicpress'); ?></label></th>
					<td>
						<input type="text" size="60" name="body_background_image" id="body_background_image" value="<?php echo $comicpress_options['design_options']['body_background_image']; ?>" /><br />
						<input id="body_background_image_tile" name="body_background_image_tile" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_tile']); ?> /> Tile
						<input id="body_background_image_repeatx" name="body_background_image_repeatx" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_repeatx']); ?> /> RepeatX
						<input id="body_background_image_repeaty" name="body_background_image_repeaty" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_repeaty']); ?> /> RepeatY
						<input id="body_background_image_norepeat" name="body_background_image_norepeat" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_norepeat']); ?> /> No Repeat
						<input id="body_background_image_center" name="body_background_image_center" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_center']); ?> /> Center
						<input id="body_background_image_top" name="body_background_image_top" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_top']); ?> /> Top
						<input id="body_background_image_bottom" name="body_background_image_bottom" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_design_options']['body_background_image_bottom']); ?> /> Bottom
						<?php _e('','comicpress'); ?>
					</td>
				</tr>
			</table>
			
			<?php } ?>
		</div>

		<div class="comicpress-options-save">
			<div class="comicpress-major-publishing-actions">
				<div class="comicpress-publishing-action">
						<input name="comicpress_save_design" type="submit" class="button-primary" value="Save Settings" />
						<input type="hidden" name="action" value="comicpress_save_design" />
					</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>