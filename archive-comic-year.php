<?php
/*
Template Name: Comic Year Archive
*/
get_header(); 
remove_filter('pre_get_posts','comicpress_members_filter');
include(get_template_directory() . '/layout-head.php');

global $comicpress_options;
if (isset($_GET['archive_year'])) { 
	$archive_year = (int)$_GET['archive_year']; 
} else { 
	if ($comicpress_options['archive_start_latest_year']) {
		$latest_comic = get_terminal_post_in_category(get_all_comic_categories_as_cat_string(),false); 
	} else {
		$latest_comic = get_terminal_post_in_category(get_all_comic_categories_as_cat_string(),true); 
	}
	$archive_year = get_post_time('Y', false, $latest_comic, true); 
}
if (empty($archive_year)) $archive_year = date('Y');

$is_comic = false;
?> 
<?php while (have_posts()) : the_post() ?>
<div <?php post_class(); ?>>
	<?php comicpress_display_post_thumbnail($is_comic); ?>
	<div class="post-head"></div>
	<div class="post-content">
		<div class="post-info">
			<div class="post-text">
				<h2><?php the_title(); ?> <?php echo $archive_year; ?></h2>
			</div>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php comicpress_display_the_content($is_comic); ?>
			<div class="clear"></div>
		</div>
		<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">'.__('Pages:','comicpress').'</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
		<?php edit_post_link(__('Edit this page.','comicpress'), '', ''); ?>
	</div>
	<div class="post-foot"></div>
</div>
<?php endwhile; ?>
<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
		<div class="archive-yearlist">| 
			<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC");
				foreach ( $years as $year ) {
				if ($year != (0) ) { ?>	
				<a href="<?php echo add_query_arg('archive_year', $year) ?>"><strong><?php echo $year ?></strong></a> |
			<?php } } ?>
		</div>

		<table class="month-table">
		<?php
			if ($comicpress_options['template-comic-year-all-cats']) {
				query_posts('showposts=-1&year='.(int)$archive_year);
			} else {
				query_posts('showposts=-1&cat='.get_all_comic_categories_as_cat_string().'&year='.(int)$archive_year);
			} 
			while (have_posts()) : the_post() ?>
				<tr><td class="archive-date"><?php the_time('M j') ?></td><td class="archive-title"><a href="<?php echo get_permalink($post->ID) ?>" rel="bookmark" title="<?php _e('Permanent Link:','comicpress'); ?> <?php the_title() ?>"><?php the_title() ?></a></td></tr>
			<?php endwhile; ?>
		</table>
		<div class="clear"></div>
	</div>
	<div class="post-foot"></div>
</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>