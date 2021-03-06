<?php

if (!function_exists('comicpress_display_post_title')) {
	function comicpress_display_post_title($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if ($comicpress_options['disable_post_titles'] && (!in_comic_category() && !is_page())) return;
		if ($comicpress_options['disable_page_titles'] && is_page()) return;
		if (is_page()) {
			$post_title = "<h2 class=\"page-title\">";
		} else {
			$post_title = "<h2 class=\"post-title\">";
		}
		if (is_home() || is_search() || is_archive() || $is_comic && !is_page()) $post_title .= "<a href=\"".get_permalink()."\">";
		$post_title .= get_the_title();
		if (is_home() || is_search() || is_archive() || $is_comic && !is_page()) $post_title .= "</a>";
		$post_title .= "</h2>\r\n";
		echo apply_filters('comicpress_display_post_title',$post_title);
	}
}

if (!function_exists('comicpress_display_post_thumbnail')) {
	function comicpress_display_post_thumbnail($is_comic = false) {
		global $post;
		if (function_exists('has_post_thumbnail') && !$is_comic) {
			if ( has_post_thumbnail() ) {
				$post_thumbnail = "<div class=\"post-image\"><a href=\"".get_permalink()."\" rel=\"bookmark\" title=\"Permanent Link to ".get_the_title()."\">".get_the_post_thumbnail($post->ID,'full')."</a></div>\r\n";
				echo apply_filters('comicpress_display_post_thumbnail',$post_thumbnail);
			}
		} 
	}
}

if (!function_exists('comicpress_display_author_gravatar')) {
	function comicpress_display_author_gravatar($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if (is_page()) return;
		if (((!$is_comic && $comicpress_options['enable_post_author_gravatar']) || ($is_comic && $comicpress_options['enable_comic_post_author_gravatar']))) {
			$author_get_gravatar = str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64));
			$author_gravatar = "<div class=\"post-author-gravatar\">".$author_get_gravatar."</div>\r\n";
			echo apply_filters('comicpress_display_author_gravatar', $author_gravatar);
		}
	}
}

if (!function_exists('comicpress_display_post_calendar')) {
	function comicpress_display_post_calendar($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if (is_page()) return;
		if ((!$is_comic && $comicpress_options['enable_post_calendar']) || ($is_comic && $comicpress_options['enable_comic_post_calendar'])) { 
			$post_calendar = "<div class=\"post-calendar-date\"><div class=\"calendar-date\"><span>".get_the_time('M')."</span>".get_the_time('d')."</div></div>\r\n";
			echo apply_filters('comicpress_display_post_calendar',$post_calendar);
		}
	}
}

if (!function_exists('comicpress_display_post_author')) {
	function comicpress_display_post_author() {
		global $post,$authordata;
		$post_author = "<span class=\"post-date\">".get_the_time('F jS, Y')."</span> <span class=\"post-author\">  ".__(' by ','comicpress')."<a href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a></span>\r\n";
		echo apply_filters('comicpress_display_post_author',$post_author);
	}
}

if (!function_exists('comicpress_display_post_category')) {
	function comicpress_display_post_category($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if (!$comicpress_options['disable_categories_in_posts']) {
			if (get_option('comicpress-enable-storyline-support') == 1 && $is_comic) {
				$post_category = "<ul class=\"storyline-cats\"><li class=\"storyline-root\">". get_the_category_list(' &raquo; </li><li>', 'multiple')."</li></ul>\r\n";
			} else {
				$post_category = "<div class=\"post-cat\">". __('Posted In: ','comicpress') .get_the_category_list(', ', 'multiple')."</div>\r\n";
			}
			echo apply_filters('comicpress_display_post_category',$post_category);
		}
	}
}

if (!function_exists('comicpress_display_post_tags')) {
	function comicpress_display_post_tags() {
		global $post, $comicpress_options;
		if (!$comicpress_options['disable_tags_in_posts']) {
			$post_tags = "<div class=\"post-tags\">".get_the_tag_list(__('&#9492; Tags: ','comicpress'), ', ', '<br />')."</div>\r\n";
			echo apply_filters('comicpress_display_post_tags',$post_tags);
		}
	}
}

if (!function_exists('comicpress_display_comment_link')) {
	function comicpress_display_comment_link() {
		global $post, $wp_query;
		if ('open' == $post->comment_status && !is_singular()) { ?>
			<div class="comment-link">
				<?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">1</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">%</span> '.__('Comments ','comicpress')); ?>
			</div>
			<?php
		}
	}
}

if (!function_exists('comicpress_display_related_posts')) {
	function comicpress_display_related_posts($is_comic = false) {
		global $post, $comicpress_options;
		if ($is_comic && $comicpress_options['enable_related_comics']) {
			echo ComicPressRelatedPosts::display_related_comics();
		} 
		if (!$is_comic && $comicpress_options['enable_related_posts']) {
			echo ComicPressRelatedPosts::display_related_posts();
		}
	}
}

if (!function_exists('comicpress_display_blog_navigation')) {
	function comicpress_display_blog_navigation($is_comic = false) {
		global $post, $wp_query;
		if (is_single() && !$is_comic && !is_page() && !is_archive() && !is_search()) { ?>
			<div class="blognav">
			<div class="nav-single">
			<?php previous_post_link('%link',__(' &lsaquo; Previous ','comicpress'), TRUE); ?>
			<?php next_post_link('%link',__('| Next &rsaquo; ','comicpress'), TRUE); ?>
			</div>
			</div>
			<div class="clear"></div>
		<?php }
	}
}

if (!function_exists('comicpress_display_comic_navigation')) {
	function comicpress_display_comic_navigation($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if (!$comicpress_options['disable_default_comic_nav'] && $is_comic) { 
			$first_comic = get_first_comic_permalink(); 
			$last_comic = get_last_comic_permalink();
			$temp_single = $wp_query->is_single;
			$wp_query->is_single = true;
			if (!is_search() && !is_archive() && !is_page()) { ?>
				<div class="nav">
				<?php if ( get_permalink() != $first_comic ) { ?><div class="nav-first"><a href="<?php echo $first_comic ?>"><?php _e('&lsaquo;&lsaquo; First','comicpress'); ?></a></div><?php } ?>
				<div class="nav-previous"><?php previous_comic_link('%link', __('&lsaquo; Previous','comicpress')); ?></div>
				<div class="nav-next"><?php next_comic_link('%link', __('Next &rsaquo;','comicpress')) ?></div>
				<?php if ( get_permalink() != $last_comic ) { ?><div class="nav-last"><a href="<?php echo $last_comic ?>"><?php _e('Last &rsaquo;&rsaquo;','comicpress'); ?></a></div><?php } ?>
				</div>
				<div class="clear"></div>
			<?php }
			$wp_query->is_single = $temp_single; $temp_single = null;
		}
	}
}

if (!function_exists('comicpress_display_the_content')) {
	function comicpress_display_the_content($is_comic = false) {
		global $post, $wp_query, $comicpress_options;
		if (is_archive() || is_search()) {
			if ($is_comic) { ?>
				<div class="comicarchiveframe">
				<a href="<?php the_permalink() ?>"><?php echo comicpress_display_comic_image("archive,rss,comic", true); ?></a>
				</div>			
			<?php }
			if ($comicpress_options['excerpt_or_content_archive'] != 'excerpt') {
				the_content(__('&darr; Read the rest of this entry...','comicpress'));
			} else { 
				the_excerpt();
			} 				
		} else {
			if (!is_single()) { global $more; $more = 0; } 
			the_content(__('&darr; Read the rest of this entry...','comicpress'));
			if ($comicpress_options['transcript_in_posts'] && $is_comic) {
				the_transcript('styled');
			}
			if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));
		}
	}
}

if (!function_exists('comicpress_display_post')) {
	function comicpress_display_post() {
		global $post, $wp_query, $comicpress_options;
		$is_comic = 0;
		if (in_comic_category()) $is_comic = 1; ?>
		<?php comicpress_display_blog_navigation($is_comic); ?>
		<?php comicpress_display_comic_navigation($is_comic); ?>
		<div <?php post_class(); ?>>
			<?php comicpress_display_post_thumbnail($is_comic); ?>
			<div class="post-head"></div>
			<div class="post-content">
				<div class="post-info">
					<?php comicpress_display_author_gravatar($is_comic); ?>
					<?php comicpress_display_post_calendar($is_comic); ?>
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<div class="post-text">
		<?php 
		comicpress_display_post_title($is_comic);
		if (!is_page()) {
			comicpress_display_post_author($is_comic);
			if (!is_archive() && !is_search()) {edit_post_link(__('Edit','comicpress'), ' <span class="pipe">|</span> <span class="post-edit">', '</span>'); }
			if (function_exists('the_ratings')) { the_ratings(); } 
		} ?>
					</div>
				</div>
				<div class="clear"></div>
				<div class="entry">
					<?php comicpress_display_the_content($is_comic); ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<?php if (!is_page()) { ?>
				<div class="post-extras">
					<?php comicpress_display_post_tags(); ?>
					<?php comicpress_display_comment_link(); ?>
					<?php
						if ($is_comic) { 
							if (function_exists('comicpress_related_comics_shortcode') && $comicpress_options['enable_related_comics']) echo comicpress_related_comics_shortcode(); 
						} else {
							if (function_exists('comicpress_related_posts_shortcode') && $comicpress_options['enable_related_posts']) echo comicpress_related_posts_shortcode();
						}	
					?>
					<div class="clear"></div>
				</div>
				<?php } ?>
				<?php if (is_page()) { edit_post_link(__('Edit this page.','comicpress'), '', ''); } ?>
			</div>
			<div class="post-foot"></div>
		</div>
		<?php
	}
}

?>