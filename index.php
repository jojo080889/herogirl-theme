<?php 
get_header();
include(get_template_directory() . '/layout-head.php');

if (!$comicpress_options['disable_comic_frontpage'] && !$comicpress_options['disable_comic_blog_frontpage'] && !is_paged() )  {
	$wp_query->in_the_loop = true; $comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
	while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
		comicpress_display_post();
	endwhile;
} 

if (function_exists('the_project_wonderful_ad')) {
	the_project_wonderful_ad('blog');
} 

get_sidebar('blog');

if (!$comicpress_options['disable_blogheader']) { ?>
	<div id="blogheader"><?php echo $comicpress_options['blogheader_text']; ?></div>
<?php 
}
 
if (!$comicpress_options['disable_blog_frontpage']) {
	Protect();
	if (!$comicpress_options['split_column_in_two']) {
		$paged = get_query_var('paged');
		$blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&paged='.$paged;
//		apply_filters('pre_get_posts','comicpress_blogpostcount_filter');
		query_posts($blog_query);
		if (have_posts()) { ?>
			<div class="blogindex-head"></div>
			<div class="blogindex">
			<?php while (have_posts()) : the_post();
				comicpress_display_post();
			endwhile; ?>
			</div>
			<div class="blogindex-foot"></div>
		<?php }
		comicpress_pagination();
	} else {
		comicpress_dual_columns();
	}
	UnProtect();
}

get_sidebar('underblog');

include(get_template_directory() . '/layout-foot.php');
get_footer();
?>
