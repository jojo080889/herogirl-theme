<?php $comicpress_options = get_option('comicpress_options'); ?>
<div id="comicpress-archivesearch">

	<form method="post" id="myForm-archivesearch" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div class="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Archive &amp; Search Results','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<?php _e('Archive results post display','comicpress'); ?>
						<div class="radio">
							<input name="excerpt_or_content_archive" id="content_archive" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "content") { echo " checked"; } ?> /> <label for="content_archive" class="inline-label"><?php _e('Full Content','comicpress'); ?></label>
							<input name="excerpt_or_content_archive" id="excerpt_archive" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_archive'] == "excerpt") { echo " checked"; } ?> /> <label for="excerpt_archive" class="inline-label"><?php _e('Excerpt','comicpress'); ?></label>
						</div>
					</th>
					<td>
						<?php _e('Would you like to have users see the full content or just an excerpt when viewing the archives?','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" colspan="2">
						<?php _e('Search results post display','comicpress'); ?>
						<div class="radio">
							<input  name="excerpt_or_content_search" id="content_search" type="radio" value="content"<?php if ( $comicpress_options['excerpt_or_content_search'] == "content") { echo " checked"; } ?> /> <label for="content_search" class="inline-label"><?php _e('Full Content','comicpress'); ?></label>
							<input name="excerpt_or_content_search" id="excerpt_search" type="radio" value="excerpt"<?php if ( $comicpress_options['excerpt_or_content_search'] == "excerpt") { echo " checked"; } ?> /> <label for="excerpt_search" class="inline-label"><?php _e('Excerpt','comicpress'); ?></label>
						</div>
					</th>
					<td>
						<?php _e('Would you like to have users see the full content or just an excerpt when searching?','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<label for="archive_display_order"><?php _e('Archive Display Order','comicpress'); ?></label>
						<select name="archive_display_order" id="archive_display_order">
							<option class="level-0" value="asc" <?php if ($comicpress_options['archive_display_order'] == "asc") { ?>selected="selected"<?php } ?>>Oldest to Newest</option>
							<option class="level-0" value="desc" <?php if ($comicpress_options['archive_display_order'] == "desc") { ?>selected="selected"<?php } ?>>Newest to Oldest</option>
						</select>
					</th>
					<td>
						<?php _e('Sets the display order of your archives. Newest to Oldest will display your posts starting with the most recent. Oldest to Newest will start with the first entry in the category, tag, or date range (e.g., Selecting May 20XX will start with May 1, not May 31st.)','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="category_thumbnail_postcount"><?php _e('Number of archived comics to display','comicpress'); ?></label></th>
					<td>
						<label>
						<input type="text" size="3" name="category_thumbnail_postcount" id="category_thumbnail_postcount" value="<?php echo $comicpress_options['category_thumbnail_postcount']; ?>" /><br />
						</label>
					</td>
					<td>
						<?php _e('How many images in the comic category would you like to see in the archive page (-1 will display all available).','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="archive_display_comic_thumbs_in_order"><?php _e('Enable comics to be displayed as mini thumbs in order?','comicpress'); ?></label></th>
					<td>
						<input id="archive_display_comic_thumbs_in_order" name="archive_display_comic_thumbs_in_order" type="checkbox" value="1" <?php checked(true, $comicpress_options['archive_display_comic_thumbs_in_order']); ?> />
					</td>
					<td>
						<?php _e('If this is enabled it will display all of the comics in a comic category as mini thumbnails instead of listed posts.','comicpress'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Templates','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="template-comic-year-all-cats"><?php _e('Enable all categories for archive templates?','comicpress'); ?></label></th>
					<td>
						<input id="template-comic-year-all-cats" name="template-comic-year-all-cats" type="checkbox" value="1" <?php checked(true, $comicpress_options['template-comic-year-all-cats']); ?> />
					</td>
					<td>
						<?php _e('Setting this on will make it so that all posts, not just comics will display in the archive templates.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="archive_start_latest_year"><?php _e('Enable archive templates to start with most current year?','comicpress'); ?></label></th>
					<td>
						<input id="archive_start_latest_year" name="archive_start_latest_year" type="checkbox" value="1" <?php checked(true, $comicpress_options['archive_start_latest_year']); ?> />
					</td>
					<td>
						<?php _e('Enabling this option will make the archive templates start with the most current year, instead of the first year.','comicpress'); ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="comicpress-options-save">
			<div class="comicpress-major-publishing-actions">
				<div class="comicpress-publishing-action">
					<input name="comicpress_save_archivesearch" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_archivesearch" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
