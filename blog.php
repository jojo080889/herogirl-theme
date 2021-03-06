<?php
/*
Template Name: Blog
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
	<?php
	if (!$comicpress_options['split_column_in_two']) {
		$blog_query = 'showposts='.$comicpress_options['blog_postcount'].'&cat="-'.exclude_comic_categories().'"&paged='.$paged; 
		
		$posts = query_posts($blog_query);
		if (have_posts()) {
			
			while (have_posts()) : the_post();
				
				comicpress_display_post();	
			
			endwhile;
			
		}
		comicpress_pagination();
	} else {
		comicpress_dual_columns();
	} ?>
<?php get_sidebar('underblog'); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>