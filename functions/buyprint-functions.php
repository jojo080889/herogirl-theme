<?php

function comicpress_buyprint_edit_post() { 
	global $post, $comicpress_options;
	if (in_comic_category()) { ?>
		<div class="inside" style="overflow: hidden">
			<?php _e('Is this print for sale?','comicpress'); ?><br />
			<br />
		<?php 
		
		$currentbuyprintoption = get_post_meta( $post->ID, "buyprint", true );
		?>
			<div style="float:left;">
				<input name="buyprint" id="buyprint-available" type="radio" value="available" <?php if ($currentbuyprintoption == 'available' || empty($currentbuyprintoption)) { echo " checked"; } ?> /> Available 
				<input name="buyprint" id="buyprint-sold" type="radio" value="sold" <?php if ($currentbuyprintoption == 'sold') { echo " checked"; } ?> /> Sold 
				<input name="buyprint" id="buyprint-outofstock" type="radio" value="outofstock" <?php if ($currentbuyprintoption == 'outofstock') { echo " checked"; } ?> /> Out of Stock 
				<input name="buyprint" id="buyprint-notavail" type="radio" value="notavail" <?php if ($currentbuyprintoption == 'notavail') { echo " checked"; } ?> /> Not Available <br />
				Print Cost (US/Canada)<input name="buy_print_us_amount" id="buy_print_us_amount" type="text" value="<?php get_post_meta($post->ID , "buy_print_us_amount", true); ?>" />  <br />
				Shiping Cost (US/Canada)<input name="buy_print_us_ship'" id="buy_print_us_ship" type="text" value="<?php get_post_meta($post->ID , "buy_print_us_ship'", true); ?>" />  <br />
				Print Cost (International)<input name="buy_print_int_amount" id="buy_print_us_amount" type="text" value="<?php get_post_meta($post->ID , "buy_print_int_amount", true); ?>" />  <br />
				Shiping Cost (International)<input name="buy_print_int_ship'" id="buy_print_int_ship" type="text" value="<?php get_post_meta($post->ID , "buy_print_int_ship'", true); ?>" /> 
			</div>
		</div>
	<?php 
	}
}


function comicpress_handle_edit_post_buyprint_save($post_id) {
	global $comicpress_options;
	
	if (empty($_POST['buyprint'])) {
		$postbuyprint = 'available';
	} else {
		$postbuyprint = $_POST['buyprint'];
	}
	update_post_meta($post_id, 'buyprint', $postbuyprint);
	if (!empty($_POST['buy_print_int_amount'])) update_post_meta($post_id, 'buy_print_int_amount', wp_filter_nohtml_kses($_POST['buy_print_int_amount']));
	if (!empty($_POST['buy_print_us_amount'])) update_post_meta($post_id, 'buy_print_us_amount', wp_filter_nohtml_kses($_POST['buy_print_us_amount']));
	if (!empty($_POST['buy_print_int_ship'])) update_post_meta($post_id, 'buy_print_int_ship', wp_filter_nohtml_kses($_POST['buy_print_int_ship']));
	if (!empty($_POST['buy_print_us_ship'])) update_post_meta($post_id, 'buy_print_us_ship', wp_filter_nohtml_kses($_POST['buy_print_us_ship']));
}

function comicpress_buyprint_admin_function() {
	add_meta_box(
			'buyprint-for-this-post',
			__('Buy Print Information', 'comicpress'),
			'comicpress_buyprint_edit_post',
			'post',
			'normal',
			'low'
			);
}

global $comicpress_options;
if ($comicpress_options['enable_buy_print']) {
	add_action('admin_menu', 'comicpress_buyprint_admin_function');
	add_action('save_post', 'comicpress_handle_edit_post_buyprint_save' , 1, 1);
}

?>