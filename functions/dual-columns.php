<?php 

if (!function_exists('comicpress_dual_columns')) {
	function comicpress_dual_columns() { 
		global $wp_query, $blog_postcount; 
		$comicpress_options = get_option('comicpress_options');
?>
		<div id="dualcolumns">
			<div class="column_one">
				<div class="column_one_header"></div>
<?php
				$wp_query->in_the_loop = true;
				$blog_query = new WP_Query();
				$blog_query->query('showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&author='.$comicpress_options['author_column_one'].'&paged='.$paged);
				while ($blog_query->have_posts()) : $blog_query->the_post();
					comicpress_display_post();
				endwhile;
?>
			</div>
			<div class="column_two">
				<div class="column_two_header"></div>
<?php
				$wp_query->in_the_loop = true;
				$blog_query = new WP_Query();
				$blog_query->query('showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&author='.$comicpress_options['author_column_two']);
				while ($blog_query->have_posts()) : $blog_query->the_post();
					comicpress_display_post();
				endwhile;
?>
			</div>
			<div class="clear"></div>
		</div>
	<?php }
}
?>