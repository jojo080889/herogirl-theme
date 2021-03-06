<?php
/**
 * Syndication - Feed Count Capturing & adding comic to feed.
 * Author: Philip M. Hofer (Frumph)
 * In Testing
 */

function comicpress_the_title_rss($title = '') {
	switch ($count = get_comments_number()) {
		case 0:
			$title_pattern = __('%s (No Comments)', 'comicpress');
			break;
		case 1:
			$title_pattern = __('%s (1 Comment)', 'comicpress');
			break;
		default:
			$title_pattern = sprintf(__('%%s (%d Comments)', 'comicpress'), $count);
			break;
	}
	
	return sprintf($title_pattern, $title);
}

/**
 * Handle making changes to ComicPress before the export process starts.
 */
function comicpress_export_wp() {
	remove_filter('the_title_rss', 'comicpress_the_title_rss');
}

global $comicpress_options;
if ($comicpress_options['enable_comment_count_in_rss']) {
	add_filter('the_title_rss', 'comicpress_the_title_rss');
	add_action('export_wp', 'comicpress_export_wp');
}

//Insert the comic image into the RSS feed
if (!function_exists('comicpress_comic_feed')) {
	function comicpress_comic_feed() { 
		global $post, $comicpress_options; ?>
		<p><a href="<?php the_permalink(); ?>"><?php echo comicpress_display_comic_image('rss,comic',$comicpress_options['enable_post_thumbnail_rss'],$post); ?></a></p><?php
	}
}

// removed the in_comic_category so that if it has a post-image it will add it to the rss feed (else rss comic thumb)
if (!function_exists('comicpress_insert_comic_feed')) {
	function comicpress_insert_comic_feed($content) {
		global $post, $wp_query;
		if (is_feed() && in_comic_category()) {
			return comicpress_comic_feed() . $content;
		} else {
			return $content;
		}
	}
}

add_filter('the_content','comicpress_insert_comic_feed');
add_filter('the_excerpt','comicpress_insert_comic_feed');

?>
