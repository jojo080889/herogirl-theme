<?php
/*
Template Name: Archives
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php 
if (have_posts()) {
	while (have_posts()) : the_post();
		comicpress_display_post();
	endwhile; 
}
?>

<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
		<div id="archivepage">
			<h2><?php _e('Archives by Month:','comicpress'); ?></h2>
			<ul><?php wp_get_archives('type=monthly') ?></ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="post-foot"></div>
</div>

<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
		<div id="archivepage">
			<h2><?php _e('Archives by Subject:','comicpress'); ?></h2>
			<ul><?php wp_list_categories() ?></ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="post-foot"></div>
</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>