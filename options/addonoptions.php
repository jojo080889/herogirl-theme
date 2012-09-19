<?php $comicpress_options = get_option('comicpress_options'); ?>
<div id="comicpress-addons">

	<form method="post" id="myForm-addons" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div class="comicpress-options">

		<table class="widefat">
			<thead>
				<tr>
					<th colspan="3"><?php _e('Custom Header','comicpress'); ?></th>
				</tr>
			</thead>
			<tr class="alternate">
				<th scope="row"><label for="enable_custom_image_header"><?php _e('Use Custom Header','comicpress'); ?></label></th>
				<td>
					<input id="enable_custom_image_header" name="enable_custom_image_header" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_custom_image_header']); ?> />
				</td>
				<td>
					<?php _e('Adds Custom Header option under Dashboard -> Appearance. Allows you to add your own header image and customize or hide the default text.','comicpress'); ?>
				</td>
			</tr>
			<?php if ($comicpress_options['enable_custom_image_header']) { ?>
			<tr>
				<th scope="row"><label for="custom_image_header_width"><?php _e('Width','comicpress'); ?></label></th>
				<td>
					<input type="text" size="5" name="custom_image_header_width" id="custom_image_header_width" value="<?php echo $comicpress_options['custom_image_header_width']; ?>" /><br />
				</td>
				<td>
					<?php _e('Sets the width of the image you want to use for Custom Header. Defaults widths are 780px or 980px depending on the layout. Refer to the width of the layout you chose and any custom changes you have made to site width in the CSS.','comicpress'); ?>
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"><label for="custom_image_header_height"><?php _e('Height','comicpress'); ?></label></th>
				<td>
					<input type="text" size="5" name="custom_image_header_height" id="custom_image_header_height" value="<?php echo $comicpress_options['custom_image_header_height']; ?>" />
				</td>
				<td>
					<?php _e('Sets the height of the image you want to use for Custom Header. Recommended maximum height is 120px, but if your logo/image demands it you can set it higher.','comicpress'); ?>
				</td>
			</tr>
			<?php } ?>
		</table>

		<table class="widefat">
			<thead>
				<tr>
					<th colspan="3"><?php _e('Related Posts','comicpress'); ?></th>
				</tr>
			</thead>
			<tr class="alternate">
				<th scope="row"><label for="enable_related_comics"><?php _e('Put Related Comics in comic posts','comicpress'); ?></label></th>
				<td>
					<input id="enable_related_comics" name="enable_related_comics" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_comics']); ?> />
				</td>
				<td>
					<?php _e('Comics will be related by "tags" that you create for each comic post.  When creating tags for your comics, include *only* the subject material and possibly cast. Do not use tags that can relate to the entire archive or storyline the post is in.','comicpress'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="enable_related_posts"><?php _e('Put Related Posts in blog posts','comicpress'); ?></label></th>
				<td>
					<input id="enable_related_posts" name="enable_related_posts" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_related_posts']); ?> />
				</td>
				<td>
					<?php _e('Blog posts will be related by "tags" that you create for each blog post.  Like the related posts for comics, the related posts for blog post checks with other blog posts comparing the tags. Try to only use 1-5 tags total; the less the better.','comicpress'); ?>
				</td>
			</tr>
		</table>
		
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Members Only Content','comicpress'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_members_only"><?php _e('Enable Members Only options?','comicpress'); ?></label></th>
					<td>
						<input id="enable_members_only" name="enable_members_only" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_members_only']); ?> />
					</td>
					<td>
						<?php _e('When enabled this will allow all of the members only code to be active and working.','comicpress'); ?>
					</td>
				</tr>
				<?php if ($comicpress_options['enable_members_only']) { ?>
				<tr>
					<th scope="row"><label for="enable_members_only_post_comments"><?php _e('Enable Members only comment content?','comicpress'); ?></label></th>
					<td>
						<input id="enable_members_only_post_comments" name="enable_members_only_post_comments" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_members_only_post_comments']); ?> />
					</td>
					<td>
						<?php _e('When enabled this will make all the content of each of the comments available to be seen only by users registered and set as members.','comicpress'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row" colspan="2">
						<label for="members_post_category"><?php _e('Members category','comicpress'); ?></label>
					<?php
							$select = wp_dropdown_categories('show_option_none=Select category&show_count=0&orderby=name&echo=0&selected='.$comicpress_options['members_post_category']);
							$select = preg_replace('#<select([^>]*)>#', '<select name="members_post_category" id="members_post_category">', $select);
							echo $select;
						?>
					</th>
					<td>
						<?php _e('The category that is designated to show members only content.','comicpress'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<p><?php _e('USAGE: Edit the user with <em>Dashboard -> Users -> Authors &amp; Users</em> and flag the user you want to be a member with the option at the bottom.','comicpress'); ?></p>
						<p><?php _e('Inside posts, add [members] content you only want members to see [/members]','comicpress'); ?></p>
						<p><?php _e('When setting a \'members\' category, you *cannot* use an existing comic category, uncategorized, or blog category!','comicpress'); ?></p>
						<p><?php _e('You MUST create a whole new category and called it "members", then you select that category here and create a page called "Members" or something equivelant and associate the Member\'s Only template to it.','comicpress'); ?></p>
						<p><?php _e('This will make it so that that category is only seen as blogposts inside that area and not anywhere else on the site unless the user has the members flag.','comicpress'); ?></p>
					</td>
				</tr>
				<?php } ?>
			</table>

		<table class="widefat">
			<thead>
				<tr>
					<th colspan="3"><?php _e('Buy Print','comicpress'); ?></th>
				</tr>
			</thead>
			<tr class="alternate">
				<th scope="row"><label for="enable_buy_print"><?php _e('Use Buy Print?','comicpress'); ?></label></th>
				<td>
					<input id="enable_buy_print" name="enable_buy_print" type="checkbox" value="1" <?php checked(true, $comicpress_options['enable_buy_print']); ?> />
				</td>
				<td>
					<?php _e('Enables the Buy Print widgets, navigation, functions and template.','comicpress'); ?>
				</td>
			</tr>
			<?php if ($comicpress_options['enable_buy_print']) { ?>
			<tr>
				<th scope="row" colspan="2">
					<label for="buy_print_email"><?php _e('Paypal email address','comicpress'); ?></label>
					<input type="text" size="25" name="buy_print_email" id="buy_print_email" value="<?php echo $comicpress_options['buy_print_email']; ?>" />
				</th>
				<td>
					<span style="color: #d54e21;"><?php _e('* This must be correct, you do not want other people getting your money.','comicpress'); ?></span><br />
					<?php _e('The Email address you registered with Paypal and that your store is associated with.','comicpress'); ?>
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"colspan="2">
					<label for="buy_print_url"><?php _e('URL of the template page','comicpress'); ?></label>
					<input type="text" size="25" name="buy_print_url" id="buy_print_url" value="<?php echo $comicpress_options['buy_print_url']; ?>" />
				</th>
				<td>
					<span style="color: #d54e21;"><?php _e('* This must be correct, the form needs some place to go.','comicpress'); ?></span><br />
					<?php _e('The URL address to which you associated the buy print template.','comicpress'); ?><br />
					<em>
						<?php _e('Examples:','comicpress'); ?>
						"http://yourdomain.com/?p=233",
						"http://yourdomain.com/shop/",
						"/?p=233",
						"/shop/".
					</em>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="buy_print_add_shipping"><?php _e('Add shipping to each item','comicpress'); ?></label></th>
				<td>
					<input id="buy_print_add_shipping" name="buy_print_add_shipping" type="checkbox" value="1" <?php checked(true, $comicpress_options['buy_print_add_shipping']); ?> />
				</td>
				<td>
					<?php _e('Enabling this option will make it so that shipping costs will be added to each item purchased.','comicpress'); ?>
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"><label for="buy_print_us_amount"><?php _e('Print Cost (US/Canada)','comicpress'); ?></label></th>
				<td>
					<input type="text" size="7" name="buy_print_us_amount" id="buy_print_us_amount" value="<?php echo $comicpress_options['buy_print_us_amount']; ?>" />
				</td>
				<td>
					<?php _e('How much does a print cost for people in the United States and Canada?','comicpress'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="buy_print_us_ship"><?php _e('Shipping Cost (US/Canada)','comicpress'); ?></label></th>
				<td colspan="2">
					<input type="text" size="7" name="buy_print_us_ship" id="buy_print_us_ship" value="<?php echo $comicpress_options['buy_print_us_ship']; ?>" />
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"><label for="buy_print_int_amount"><?php _e('Print Cost (International)','comicpress'); ?></label></th>
				<td>
					<input type="text" size="7" name="buy_print_int_amount" id="buy_print_int_amount" value="<?php echo $comicpress_options['buy_print_int_amount']; ?>" />
				</td>
				<td>
					<?php _e('How much does a print cost for people *NOT* in the United States and Canada (International)','comicpress'); ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="buy_print_int_ship"><?php _e('Shipping Cost (International)','comicpress'); ?></label></th>
				<td colspan="2">
					<input type="text" size="7" name="buy_print_int_ship" id="buy_print_int_ship" value="<?php echo $comicpress_options['buy_print_int_ship']; ?>" />
				</td>
			</tr>
			<tr class="alternate">
				<th scope="row"><label for="buy_print_text"><?php _e('Buy Print Text on Template Page','comicpress'); ?></label></th>
				<td>
					<input type="text" size="80" name="buy_print_text" id="buy_print_text" value="<?php echo comicpress_stripslashes($comicpress_options['buy_print_text']); ?>" />
				</td>
				<td>
					<?php _e('What text to display to the user on the buyprint template page.','comicpress'); ?>
				</td>
			</tr>
			<?php } ?>
		</table>

	</div>

	<div class="comicpress-options-save">
			<div class="comicpress-major-publishing-actions">
				<div class="comicpress-publishing-action">
					<input name="comicpress_save_customheader" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_addons" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
