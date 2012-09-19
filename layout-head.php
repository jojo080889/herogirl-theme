<?php global $comicpress_options; ?>
<?php if (comicpress_check_child_file('layout-head') == false) { ?>

<div id="content-wrapper-head"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>
	
	<?php if (is_cp_theme_layout('v3cr')) { ?>
		<div id="pagewrap-left">
	<?php } ?>

	<?php if (is_cp_theme_layout('v,v3c')) { ?>
		<?php if (is_page('chat') || is_page('forum')) { ?>
			<div id="content" class="widecolumn">
		<?php } else { ?>
			<div id="content" class="narrowcolumn">
		<?php } ?>
			<?php get_sidebar('overblog'); ?>
	<?php } ?>

<?php
	if (!is_paged()) {
		if (is_home()) {
			if (!$comicpress_options['disable_comic_frontpage']) {
				$wp_query->in_the_loop = true; $comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
				while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
					comicpress_display_comic_area();
				endwhile;
			}
		} else {
			if (is_single() && in_comic_category()) {
				comicpress_display_comic_area();
			}
		}
	}
?>

<?php if (is_cp_theme_layout('3c,standard,3c2r')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

<?php if (is_cp_theme_layout('3c,rgn')) get_sidebar('left'); ?>

<?php if (is_cp_theme_layout('v3cr')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<?php if (is_page('chat') || is_page('forum')) { ?>
			<div id="content" class="widecolumn">
		<?php } else { ?>
			<div id="content" class="narrowcolumn">
		<?php } ?>
			<?php get_sidebar('overblog'); ?>
	<?php } ?>
<?php } ?>
	
