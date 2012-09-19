<?php
/*
Template Name: Buy Print
Template Author: Philip M. Hofer (Frumph)
Template URL: http://frumph.net
Template Author Email: philip@frumph.net
Template Version: 2.15
*/
get_header();
if (isset($_REQUEST['comic'])) $comicnum = (int)intval($_REQUEST['comic']);
include(get_template_directory() . '/layout-head.php');
$comicpress_options = comicpress_load_options();
 
$buy_print_int_amount = get_post_meta($comicnum , "buy_print_int_amount", true);
if (empty($buy_print_int_amount)) $buy_print_int_amount = $comicpress_options['buy_print_int_amount'];
$buy_print_us_amount = get_post_meta($comicnum , "buy_print_us_amount", true);
if (empty($buy_print_us_amount)) $buy_print_us_amount = $comicpress_options['buy_print_us_amount'];
$buy_print_int_ship = get_post_meta($comicnum , "buy_print_int_ship", true);
if (empty($buy_print_int_ship)) $buy_print_int_ship = $comicpress_options['buy_print_int_ship'];
$buy_print_us_ship = get_post_meta($comicnum , "buy_print_us_amount", true);
if (empty($buy_print_us_ship)) $buy_print_us_ship = $comicpress_options['buy_print_us_ship'];
$buyprint = get_post_meta($comicnum , "buyprint", true);
if (empty($buyprint)) $buyprint = 'Available';

if (!empty($comicnum)):
$this_post = & get_post( $comicnum ); 
?>
	<div <?php post_class(); ?>>
		<?php comicpress_display_post_thumbnail(); ?>
		<div class="post-head"></div>
		<div class="post-content">
			<?php if (!$comicpress_options['disable_page_titles']) { ?>
				<h2 class="page-title"><?php the_title(); ?></h2>
			<?php } ?>
			<?php _e('Comic ID','comicpress'); ?> - #<?php echo $comicnum; ?><br />
			<?php _e('Title:','comicpress'); ?>	<?php echo get_the_title($this_post); ?><br />
			<?php _e('Status:','comicpress'); ?> <?php echo $buyprint; ?><br />
			<br />
			<div class="print-thumbnail">
			<?php 
				echo comicpress_display_comic_image("archive,comic", false, $this_post, get_the_title($this_post));
			?>
			</div>
			<table>
			<tr>
				<td align="left">
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1" />
						<input type="hidden" name="cmd" value="_cart" />
						<input type="hidden" name="item_name" value="<?php _e('Print','comicpress'); ?>" />
						<input type="hidden" name="return" value="<?php echo bloginfo('wpurl'); ?>" />
						<input type="hidden" name="amount" value="<?php echo $buy_print_us_amount;?>" />
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo get_the_title($this_post); ?>" />
						<input type="hidden" name="business" value="<?php echo $comicpress_options['buy_print_email']; ?>" />
					<?php if ($comicpress_options['buy_print_add_shipping']) { ?>
						<input type="hidden" name="shipping" value="<?php echo $buy_print_us_ship; ?>" />
						US/Canada<br />
						$<?php echo $buy_print_us_amount ?> + $<?php echo $buy_print_us_ship; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						US/Canada<br />
						$<?php echo $buy_print_us_amount; ?><br />
					<?php } ?>					
						<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/buynow_paypal.png" name="submit32" alt="<?php _e('Make payments with PayPal - it is fast, free and secure!','comicpress'); ?>" /> 
						</form>
				</td>
				<td width="40">
				</td>
				<td align="left">
					<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="add" value="1" />
						<input type="hidden" name="cmd" value="_cart" />
						<input type="hidden" name="item_name" value="<?php _e('Print','comicpress'); ?>" />
						<input type="hidden" name="return" value="<?php echo bloginfo('wpurl'); ?>" />
						<input type="hidden" name="amount" value="<?php echo $buy_print_int_amount ; ?>" />
						<input type="hidden" name="item_number" value="<?php _e('Comic ID','comicpress'); ?> (<?php echo $comicnum; ?>) - <?php echo get_the_title($this_post); ?>" />
						<input type="hidden" name="business" value="<?php echo $comicpress_options['buy_print_email']; ?>" />
					<?php if ($comicpress_options['buy_print_add_shipping']) { ?>
						<input type="hidden" name="shipping" value="<?php echo $buy_print_int_ship; ?>" />
						International<br />
						$<?php echo $buy_print_int_amount; ?> + $<?php echo $buy_print_int_ship; ?> <?php _e('shipping','comicpress'); ?><br />
					<?php } else { ?>
						International<br />
						$<?php echo $buy_print_int_amount; ?><br />
					<?php } ?>
						<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/buynow_paypal.png" name="submit32" alt="<?php _e('Make payments with PayPal - it is fast, free and secure!','comicpress'); ?>" />
					</form>
				</td>
			</tr>
			</table>
			<br />
			<div class="print-text">
			<?php echo $comicpress_options['buy_print_text']; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="post-foot"></div>
	</div>
	
<?php else: ?>
	
		<?php while (have_posts()) : the_post() ?>

		<div <?php post_class(); ?>>
			<?php comicpress_display_post_thumbnail(); ?>
			<div class="post-head"></div>
			<div class="post-content">
				<?php if (!$comicpress_options['disable_page_titles']) { ?>
					<h2 class="pagetitle"><?php the_title() ?></h2>
				<?php } ?>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<div class="clear"></div>
				<?php edit_post_link(__('Edit this page.','comicpress'), '', '') ?>
			</div>
			<div class="post-foot"></div>
		</div>

		<?php endwhile; ?>

		<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>
		
<?php endif; ?>	

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
