<?php $comicpress_options = get_option('comicpress_options'); ?>
<div id="comicpress-general">

	<form method="post" id="myForm-general" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div class="comicpress-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Main','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_page_restraints"><?php _e('Disable page restraints','comicpress'); ?></label></th>
					<td>
						<input id="disable_page_restraints" name="disable_page_restraints" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_page_restraints']); ?> />
					</td>
					<td>
						<?php _e('Allows the width of your site to either be Dynamic (fills browser window) or Fixed (width is specified, e.g., 980px, 780px, etc.)  If Dynamic is enabled #page and #page-wide will not load. This allow you to use the entire browser for your canvas instead of the 780px/980px that the two elements limit you to by default.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="rascal_says"><?php _e('Enable Rascal the ComicPress Mascot','comicpress'); ?></label></th>
					<td>
						<input id="rascal_says" name="rascal_says" type="checkbox" value="1" <?php checked(true, $comicpress_options['rascal_says']); ?> />
					</td>
					<td>
						<?php _e('Enable this option to make a comic bubble appear over the comic and write out what you put in the hovertext, along with a friendly face. You can add the hovertext when uploading your comic with ComicPress Manager. To change the graphics for this will need to be well-versed in CSS.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_comment_note"><?php _e('Disable the comment notes','comicpress'); ?></label></th>
					<td>
						<input id="disable_comment_note" name="disable_comment_note" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_comment_note']); ?> />
					</td>
					<td>
						<?php _e('Disabling this will remove the note text that displays with more options for adding to comments (html).','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_comment_javascript"><?php _e('Enable Comment Javascript','comicpress'); ?></label></th>
					<td>
						<input id="enable_comment_javascript" name="enable_comment_javascript" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comment_javascript']); ?> />
					</td>
					<td>
						<?php _e('Enable this option if you want the comment form to appear directly under who is being replied to. (reduces pageview/hit)','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_blogheader"><?php _e('Disable blog header','comicpress'); ?></label></th>
					<td>
						<input id="disable_blogheader" name="disable_blogheader" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_blogheader']); ?> />
					</td>
					<td>
						<?php _e('Checkmark this and your site will not display the contents of #blogheader.','comicpress'); ?>
					</td>
				</tr>
				<?php if (!$comicpress_options['disable_blogheader']) { ?>
				<tr>
					<th scope="row"><label for="blogheader_text"><?php _e('Text for the blogheader, leave blank for none.','comicpress'); ?></label></th>
					<td colspan="2">
						<input id="blogheader_text" name="blogheader_text" type="text" width="180" value="<?php echo $comicpress_options['blogheader_text']; ?>" />
					</td>
				</tr>
				<?php } ?>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('RSS','comicpress'); ?></th>
					</tr>
				</thead>			
				<tr class="alternate">
					<th scope="row"><label for="enable_comment_count_in_rss"><?php _e('Enable the comment count to show in feed title.','comicpress'); ?></label></th>
					<td>
						<input id="enable_comment_count_in_rss" name="enable_comment_count_in_rss" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comment_count_in_rss']); ?> />
					</td>
					<td>
						<?php _e('Will show how many comments there are in the title of the post in the feed.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_post_thumbnail_rss"><?php _e('Enable the post thumbnails in the RSS feed?','comicpress'); ?></label></th>
					<td>
						<input id="enable_post_thumbnail_rss" name="enable_post_thumbnail_rss" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_post_thumbnail_rss']); ?> />		
					</td>
					<td>
						<?php _e('If enabled will show the post thumbnail of the post in the RSS feed.','comicpress'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Navigation','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_numbered_pagination"><?php _e('Enable numbered pagination','comicpress'); ?></label></th>
					<td>
						<input id="enable_numbered_pagination" name="enable_numbered_pagination" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_numbered_pagination']); ?> />
					</td>
					<td>
						<?php _e('Previous Entries and Next Entries buttons are replaced by a bar of numbered pages. Numbered pagination appears on the Home page, the author(s) page, the blog template, and comments/single when there are more then the set number of comments per page. Uses the same styling as the Menubar.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="comic_clicks_next"><?php _e('Click comic to go next','comicpress'); ?></label></th>
					<td>
						<input id="comic_clicks_next" name="comic_clicks_next" type="checkbox" value="1" <?php checked(true, $comicpress_options['comic_clicks_next']); ?> />
					</td>
					<td>
						<?php _e('Allows users to click the comic itself to go to the next comic (unless on the latest comic). This allows you to offer a more convenient option for your archive readers to proceed to the next comic, and the next, etc. Any enabled hover options will continue to function even with this enabled.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_default_comic_nav"><?php _e('Disable the default comic post navigation','comicpress'); ?></label></th>
					<td>
						<input id="disable_default_comic_nav" name="disable_default_comic_nav" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_default_comic_nav']); ?> />
					</td>
					<td>
						<?php _e('The default comic post navigation is above each comic blog post.','comicpress'); ?>
					</td>
				</tr>
				<?php
					$current_gnav_directory = $comicpress_options['graphicnav_directory'];
					if (empty($current_gnav_directory)) $current_gnav_directory = 'default';
					$dirs_to_search = array_unique(array(get_template_directory(),get_stylesheet_directory()));
					$gnav_directories = array();
					foreach ($dirs_to_search as $gnav_dir) {
						if (is_dir($gnav_dir . '/images/nav')) {
							$thisdir = null;
							$thisdir = array();
							$thisdir = glob($gnav_dir. '/images/nav/*');
							$gnav_directories = array_merge($gnav_directories, $thisdir); 		
						}
					}
				?>
				<tr>
					<th scope="row" colspan="2"><label for="graphicnav_directory"><?php _e('Graphic Navigation Directory','comicpress'); ?></label>

							<select name="graphicnav_directory" id="graphicnav_directory">
								<?php
									foreach ($gnav_directories as $gnav_dirs) {
										if (is_dir($gnav_dirs)) {
											$gnav_dir_name = basename($gnav_dirs); ?>
											<option class="level-0" value="<?php echo $gnav_dir_name; ?>" <?php if ($current_gnav_directory == $gnav_dir_name) { ?>selected="selected"<?php } ?>><?php echo $gnav_dir_name; ?></option>
									<?php }
									}
								?>
							</select>

					</th>
					<td>
						<?php _e('Choose a directory to get the graphic navigation styling from. To create your own custom graphic navigation menu buttons just create a directory under <i>images/nav/</i> and place your image files inside of it and create a navstyle.css file to determine the style of your navigation display.','comicpress'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Sidebars','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_widgetarea_use_sidebar_css"><?php _e('Enable main Sidebar CSS for all sidebars','comicpress'); ?></label></th>
					<td>
						<input id="enable_widgetarea_use_sidebar_css" name="enable_widgetarea_use_sidebar_css" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_widgetarea_use_sidebar_css']); ?> />
					</td>
					<td>
						<?php _e('Uses default CSS styling of the sidebars for all sidebar areas. If disabled it will use the .customwidgetarea user-made styling and only Sidebar-left and Sidebar-right will use sidebar styling.','comicpress'); ?><br />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_lrsidebars"><?php _e('Disable left and right sidebars','comicpress'); ?></label></th>
					<td>
						<input id="disable_lrsidebars" name="disable_lrsidebars" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_lrsidebars']); ?> />
					</td>
					<td>
						<?php _e('Your site will not display the default left/right sidebars. Minimalists dream. WARNING: Not recommended for use with Graphic Novel layouts.','comicpress'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Footer','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_footer_text"><?php _e('Disable the default text in the footer','comicpress'); ?></label></th>
					<td>
						<input id="disable_footer_text" name="disable_footer_text" type="checkbox" value="1" <?php checked(true, $comicpress_options['disable_footer_text']); ?> />
					</td>
					<td>
						<?php _e('Default text in the footer will not display. Enable this if you do not want any text in the footer. If you wish to add you own custom content, you may do so via Appearance -> Widgets-> Footer.', 'comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_scroll_to_top"><?php _e('Enable the scroll to top link in the footer?','comicpress'); ?></label></th>
					<td>
						<input id="enable_scroll_to_top" name="enable_scroll_to_top" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_scroll_to_top']); ?> />
					</td>
					<td>
						<?php _e('When this link is clicked on long pages it will scroll back to the top.','comicpress'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Debug','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_comicpress_debug"><?php _e('Enable the dashboard ComicPress debug?','comicpress'); ?></label></th>
					<td>
						<input id="enable_comicpress_debug" name="enable_comicpress_debug" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_comicpress_debug']); ?> />
					</td>
					<td>
						<?php _e('Default enabled, this will do some sanity checks on your ComicPress installation and report the findings on your dashboard.', 'comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_full_post_check"><?php _e('Enable checking EVERY post for category problems?','comicpress'); ?></label></th>
					<td>
						<input id="enable_full_post_check" name="enable_full_post_check" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_full_post_check']); ?> />
					</td>
					<td>
						<?php _e('Enable this if you would like to check ALL of your posts to see if there are any category problems and inconsistancies.', 'comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_page_load_info"><?php _e('Enable the page load info in the footer?','comicpress'); ?></label></th>
					<td>
						<input id="enable_page_load_info" name="enable_page_load_info" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_page_load_info']); ?> />
					</td>
					<td>
						<?php _e('Will display information on how many queries and how fast it took to load the page in the footer.', 'comicpress'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="fix_for_index_paging"><?php _e('Enable fix for index paging file not found with permalinks?','comicpress'); ?></label></th>
					<td>
						<input id="fix_for_index_paging" name="fix_for_index_paging" type="checkbox" value="1" <?php checked(true, $comicpress_options['fix_for_index_paging']); ?> />
					</td>
					<td>
						<?php _e('Enabling this will add a filter to the index page query that will set the number of posts displayed appropriately for paging if it does not work for you.', 'comicpress'); ?>
					</td>
				</tr>
			</table>

		</div>

		<div class="comicpress-options-save">
			<div class="comicpress-major-publishing-actions">
				<div class="comicpress-publishing-action">
					<input name="comicpress_save_general" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_general" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
