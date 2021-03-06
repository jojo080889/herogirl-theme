<?php
/*
Widget Name: Graphical Navigation
Widget URI: http://comicpress.org/
Description: You can place graphical navigation buttons on your comic.
Author: Philip M. Hofer (Frumph)
Version: 1.2
Author URI: http://frumph.net/

*/

class widget_comicpress_graphical_navigation extends WP_Widget {
	
	function widget_comicpress_graphical_navigation() {
		$widget_ops = array('classname' => 'widget_comicpress_graphical_navigation', 'description' => __('Displays Graphical Navigation Buttons. This widget is for when you are not using the advanced storyline enabled widget.','comicpress') );
		$this->WP_Widget('comicpress_graphicalnavigation', __('ComicPress Navigation','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $wp_query, $post, $comicpress_options;
		Protect();
		$this_permalink = get_permalink();
		
		$temp_query = $wp_query->is_single;
		$wp_query->is_single = true;
		$prev_comic = get_previous_comic_permalink(false);
		$prev_in_chapter = get_previous_comic_permalink(true);
		$next_comic = get_next_comic_permalink(false);
		$next_in_chapter = get_next_comic_permalink(true);
		$wp_query->is_single = $temp_query;
		$temp_query = null;
		
		$first_comic = get_first_comic_permalink();
		$last_comic = get_last_comic_permalink();
		
		$prev_story = get_previous_storyline_start_permalink();
		$next_story = get_next_storyline_start_permalink(); 
		
		$latest_comic = get_permalink( get_terminal_post_in_category(get_all_comic_categories_as_cat_string(), false) );
		UnProtect();
?>

<div id="comic_navi_wrapper">
	<div class="comic_navi">
	<div class="comic_navi_left">
			<?php if ($instance['first']) {
				if (!empty($first_comic) && ($first_comic != $this_permalink)) { ?>
					<a href="<?php echo $first_comic; ?>" class="navi navi-first" title="<?php echo $instance['first_title']; ?>"><?php echo $instance['first_title']; ?><span><i class="fa fa-backward"></i></span></a>
				<?php } else { ?>
					<div class="navi navi-first navi-void"><?php echo $instance['first_title']; ?><span><i class="fa fa-backward"></i></span></div>
				<?php } 
			}
			
			if ($instance['story_prev'] && (get_option('comicpress-enable-storyline-support') == 1) ) { 
				if (!empty($prev_story)) { ?>
					<a href="<?php echo $prev_story; ?>" class="navi navi-prevchap" title="<?php echo $instance['story_prev_title']; ?>"><?php echo $instance['story_prev_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-prevchap navi-void"><?php echo $instance['story_prev_title']; ?></div>
				<?php } 
			} 
			if ($instance['prev_in'] && (get_option('comicpress-enable-storyline-support') == 1)) {
				if (!empty($prev_in_chapter)) { ?>
					<a href="<?php echo $prev_in_chapter; ?>" class="navi navi-prev-in" title="<?php echo $instance['prev_in_title']; ?>"><?php echo $instance['prev_in_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-prev-in navi-void"><?php echo $instance['prev_in_title']; ?></div>
				<?php } 
			} 
			if ($instance['previous']) {
				if (!empty($prev_comic)) { ?>
					<a href="<?php echo $prev_comic; ?>" class="navi navi-prev" title="<?php echo $instance['previous_title']; ?>"><?php echo $instance['previous_title']; ?><span><i class="fa fa-step-backward"></i></span></a>
				<?php } else { ?>
					<div class="navi navi-prev navi-void"><?php echo $instance['previous_title']; ?><span><i class="fa fa-step-backward"></i></span></div>
				<?php } 
			} 
?>
		</div>
		<div class="comic_navi_center">
		<?php
			if ($instance['archives'] && !empty($instance['archive_path'])) { ?>
				<a href="<?php echo $instance['archive_path']; ?>" class="navi navi-archives navi-archive" title="<?php echo $instance['archives_title']; ?>"><?php echo $instance['archives_title']; ?></a>
			<?php } 
			if ($instance['random']) { ?>
				<a href="<?php echo bloginfo('url'); ?>/?randomcomic" class="navi navi-random" title="<?php echo $instance['random_title']; ?>"><?php echo $instance['random_title']; ?><span><i class="fa fa-random"></i></span></a>
			<?php }
			if ($instance['comictitle']) { ?>
				<span class="navi-comictitle"><a href="<?php the_permalink(); ?>">"<?php the_title(); ?>"</a></span>
			<?php } 
			if ($instance['comments']) { ?>
				<a href="<?php the_permalink(); ?>#comment" class="navi navi-comments" title="<?php echo $instance['comments_title']; ?>"><span class="navi-comments-count"><?php comments_number('0', '1', '%'); ?></span><?php echo $instance['comments_title']; ?></a>
			<?php }
			if ($comicpress_options['enable_buy_print'] && $instance['buyprint']) {
				$buyprint = get_post_meta( get_the_ID(), "buyprint", true);
				if (empty($buyprint) || $buyprint == 'available') { 
					if (strpos($comicpress_options['buy_print_url'], '?') !== false) {
						$bpsep = '&';
					} else {
						$bpsep = '?';
					}
				?>
					<a href="<?php echo $comicpress_options['buy_print_url']; ?><?php echo $bpsep; ?>comic=<?php echo get_the_ID(); ?>" class="navi navi-buyprint" title="<?php echo $instance['buyprint_title']; ?>"><?php echo $instance['buyprint_title']; ?></a>
				<?php } /* else { ?>
					<div class="navi navi-buyprint navi-void"><?php echo $instance['buyprint_title']; ?></div>
				<?php } */
			} 
			if ($instance['sharethis']) {
				$url = get_permalink($post->ID);
				$title = $post->post_title;
				$title = str_replace(' ', '%20', $title);

				$rss = get_bloginfo('rss2_url');
				$blogname = urlencode(get_bloginfo('name')." ".get_bloginfo('description'));
				// Grab the excerpt, if there is no excerpt, create one
				$excerpt = urlencode(strip_tags(strip_shortcodes($post->post_excerpt)));
				if ($excerpt == "") {
					$excerpt = urlencode(substr(strip_tags(strip_shortcodes($post->post_content)),0,250));
				}
				// Clean the excerpt for use with links
				$excerpt	= str_replace('+','%20',$excerpt);
			?>
				<script type="text/javascript">
					function sharethis() {
						var sharewin = document.getElementById('navi-share-box');
						if ( sharewin.style.display == 'block' ) {
							sharewin.style.display = 'none';
						} else {
							sharewin.style.display = 'block';
						}
					}
				</script>
				<div id="navi-share-box">
					<a href="http://reddit.com/submit?url=<?php echo $url; ?>&title=<?php echo $title; ?>" title="Reddit">Reddit</a>
					<a href="http://digg.com/submit?phase=2&url=<?php echo $url; ?>&title=<?php echo $title; ?>" title="Digg">Digg</a>
					<a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>" title="Facebook">Facebook</a>
					<a href="http://www.myspace.com/Modules/PostTo/Pages/?l=3&u=<?php echo $url; ?>&t=<?php echo $title; ?>&c=" title="MySpace">MySpace</a>
					<a href="http://del.icio.us/post?url=<?php echo $url; ?>" title="Delicious">Delicious</a>
					
					<a href="http://www.stumbleupon.com/submit?url=<?php echo $url; ?>&title=<?php echo $title; ?>" title="Stumbleupon">Stumbleupon</a>
					<a href="http://buzz.yahoo.com/submit/?submitUrl=<?php echo $url; ?>&submitHeadline=<?php echo $title; ?>" title="Buzz Up!">Buzz Up!</a>
					<a href="http://www.mixx.com/submit?page_url=<?php echo $url; ?>" title="Mixx">Mixx</a>
					<a href="http://www.technorati.com/faves?add=<?php echo $url; ?>" title="Technorati">Technorati</a>
					<a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo $url; ?>&title=<?php echo $title; ?>" title="Google Bookmarks">Google Bookmarks</a>
					<a href="http://bookmarks.yahoo.com/toolbar/savebm?opener=tb&u=<?php echo $url; ?>&t=<?php echo $title; ?>" title="Yahoo Bookmarks">Yahoo Bookmarks</a>
					
					<a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u=<?php echo $url; ?>&t=<?php echo $title; ?>" title="Yahoo MyWeb">Yahoo MyWeb</a>
					<a href="https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url=<?php echo $url; ?>&title=<?php echo $title; ?>" title="Windows Live">Windows Live</a>
					<a href="http://www.propeller.com/submit/?U=<?php echo $url; ?>&T=<?php echo $title; ?>" title="Propeller">Propeller</a>
					<a href="http://friendfeed.com/share?url=<?php echo $url; ?>&title=<?php echo $title; ?>" title="FriendFeed">FriendFeed</a>
					<a href="http://www.newsvine.com/_tools/seed&save?popoff=0&u=<?php echo $url; ?>&h=<?php echo $title; ?>" title="Newsvine">Newsvine</a>
					<a href="http://www.xanga.com/private/editorx.aspx?t=<?php echo $title; ?>&u=<?php echo $url; ?>&s=" title="Xanga">Xanga</a>
					
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>&summary=<?php echo $excerpt; ?>&source=" title="LinkedIn">LinkedIn</a>
					<a href="http://blinklist.com/index.php?Action=Blink/addblink.php&Url=<?php echo $url; ?>&Title=<?php echo $title; ?>" title="Blinklist">Blinklist</a>
					<a href="http://furl.net/storeIt.jsp?u=<?php echo $url; ?>&t=<?php echo $title; ?>" title="Furl">Furl</a>
				</div>
				<a href="javascript:sharethis()" class="navi" id="navi-share" title="<?php echo $instance['sharethis_title']; ?>"><?php echo $instance['sharethis_title']; ?></a>
			<?php }
			if ($instance['subscribe']) { ?>
				<a href="<?php bloginfo('rss2_url') ?>" class="navi navi-subscribe" title="<?php echo $instance['subscribe_title']; ?>"><?php echo $instance['subscribe_title']; ?></a>
			<?php } ?>
		</div>
		<div class="comic_navi_right">
			<?php
			if ($instance['next']) {
				if (!empty($next_comic)) { ?>
					<a href="<?php echo $next_comic; ?>" class="navi navi-next" title="<?php echo $instance['next_title']; ?>"><?php echo $instance['next_title']; ?><span><i class="fa fa-step-forward"></i></span></a>
				<?php } else { ?>
					<div class="navi navi-next navi-void"><?php echo $instance['next_title']; ?><span><i class="fa fa-step-forward"></i></span></div>
				<?php }
			}
			if ($instance['next_in'] && (get_option('comicpress-enable-storyline-support') == 1) ) {
				if (!empty($next_in_chapter)) { ?>
					<a href="<?php echo $next_in_chapter; ?>" class="navi navi-next-in" title="<?php echo $instance['next_in_title']; ?>"><?php echo $instance['next_in_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-next-in navi-void"><?php echo $instance['next_in_title']; ?></div>
				<?php }
			} 
			if ($instance['story_next'] && (get_option('comicpress-enable-storyline-support') == 1) ) { 
				if (!empty($next_story) && !is_home()) { ?>
					<a href="<?php echo $next_story; ?>" class="navi navi-nextchap" title="<?php echo $instance['story_next_title']; ?>"><?php echo $instance['story_next_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-nextchap navi-void"><?php echo $instance['story_next_title']; ?></div>
				<?php }
			}
			if ($instance['last']) {
				if (!empty($last_comic) && ($last_comic != $this_permalink)) {
					if ($instance['lastgohome']) { ?>
						<a href="/" class="navi navi-last" title="<?php echo $instance['last_title']; ?>"><?php echo $instance['last_title']; ?><span>Last</span></a>
					<?php } else { ?>
						<a href="<?php echo $last_comic; ?>" class="navi navi-last" title="<?php echo $instance['last_title']; ?>"><?php echo $instance['last_title']; ?><span><i class="fa fa-forward"></i></span></a>						
					<?php } ?>
				<?php } else { ?>
					<div class="navi navi-last navi-void"><?php echo $instance['last_title']; ?><span><i class="fa fa-forward"></i></span></div>
				<?php }
			} ?>
	</div>
	</div>
		<?php if ($instance['sharethis']) { ?>

		<?php } ?>
</div>
		<?php // } 
	}
	
	function update($new_instance, $old_instance) {
		$comicpress_options = get_option('comicpress_options');
		$instance = $old_instance;
		foreach (array(
			'first',
			'last',
			'story_prev',
			'story_next',
			'prev_in',
			'next_in',
			'previous',
			'next',
			'random',
			'archives',
			'comments',
			'buyprint',
			'sharethis',
			'subscribe',
			'comictitle'
			) as $key) {
				$instance[$key] = (bool)( $new_instance[$key] == 1 ? true : false );
		}
		
		$instance['archive_path'] = strip_tags($new_instance['archive_path']);		
		$instance['first_title'] = strip_tags($new_instance['first_title']);
		$instance['last_title'] = strip_tags($new_instance['last_title']);
		$instance['story_prev_title'] = strip_tags($new_instance['story_prev_title']);
		$instance['story_next_title'] = strip_tags($new_instance['story_next_title']);
		$instance['prev_in_title'] = strip_tags($new_instance['prev_in_title']);
		$instance['next_in_title'] = strip_tags($new_instance['next_in_title']);
		$instance['previous_title'] = strip_tags($new_instance['previous_title']);
		$instance['random_title'] = strip_tags($new_instance['random_title']);
		$instance['archives_title'] = strip_tags($new_instance['archives_title']);
		$instance['comments_title'] = strip_tags($new_instance['comments_title']);
		$instance['next_title'] = strip_tags($new_instance['next_title']);
		if ($comicpress_options['enable_buy_print']) {
			$instance['buyprint_title'] = strip_tags($new_instance['buyprint_title']);
		}
		$instance['sharethis_title'] = strip_tags($new_instance['sharethis_title']);
		$instance['subscribe_title'] = strip_tags($new_instance['subscribe_title']);
		return $instance;
	}
	
	function form($instance) {
		$comicpress_options = get_option('comicpress_options');
		$instance = wp_parse_args( (array) $instance, array( 
			'first' => true,
			'last' => true,
			'story_prev' => false,
			'story_next' => false,
			'prev_in' => false,
			'next_in' => false,
			'previous' => true,  
			'random' => false, 
			'archives' => false, 
			'comments' => false, 
			'next' => true, 
			'archive_path' => '', 
			'buyprint' => false,
			'first_title' => 'First',
			'last_title' => 'Latest',
			'story_prev_title' => 'Previous Chapter',
			'story_next_title' => 'Next Chapter',
			'prev_in_title' => 'Prev In Chapter',
			'next_in_title' => 'Next In Chapter',
			'previous_title' => 'Previous',  
			'random_title' => 'Random', 
			'archives_title' => 'Archives', 
			'comments_title' => 'Comments', 
			'next_title' => 'Next', 
			'buyprint_title' => 'Buy Print',
			'comictitle' => false,
			'sharethis' => 'Share',
			'subscribe' => 'Subscribe',
			'subscribe_path' => ''
		 ) );
		
		?>
	
		<input id="<?php echo $this->get_field_id('first'); ?>" name="<?php echo $this->get_field_name('first'); ?>" type="checkbox" value="1" <?php checked(true, $instance['first']); ?> /> <label for="<?php echo $this->get_field_id('first'); ?>"><strong><?php _e('First','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo attribute_escape($instance['first_title']); ?>" /></label><br />	
		<br />
		<input id="<?php echo $this->get_field_id('last'); ?>" name="<?php echo $this->get_field_name('last'); ?>" type="checkbox" value="1" <?php checked(true, $instance['last']); ?> /> <label for="<?php echo $this->get_field_id('last'); ?>"><strong><?php _e('Last','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('last_title'); ?>" name="<?php echo $this->get_field_name('last_title'); ?>" type="text" value="<?php echo attribute_escape($instance['last_title']); ?>" /></label><br />
		<br />
		
		<input id="<?php echo $this->get_field_id('previous'); ?>" name="<?php echo $this->get_field_name('previous'); ?>" type="checkbox" value="1" <?php checked(true, $instance['previous']); ?> /> <label for="<?php echo $this->get_field_id('previous'); ?>"><strong><?php _e('Previous','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('previous_title'); ?>" type="text" value="<?php echo attribute_escape($instance['previous_title']); ?>" /></label><br />	
		<br />
		<input id="<?php echo $this->get_field_id('next'); ?>" name="<?php echo $this->get_field_name('next'); ?>" type="checkbox" value="1" <?php checked(true, $instance['next']); ?> /> <label for="<?php echo $this->get_field_id('next'); ?>"><strong><?php _e('Next','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('next_title'); ?>" name="<?php echo $this->get_field_name('next_title'); ?>" type="text" value="<?php echo attribute_escape($instance['next_title']); ?>" /></label><br />
		<br />

<?php
		if (get_option('comicpress-enable-storyline-support') == 1) {
			?>
		<input id="<?php echo $this->get_field_id('story_prev'); ?>" name="<?php echo $this->get_field_name('story_prev'); ?>" type="checkbox" value="1" <?php checked(true, $instance['story_prev']); ?> /> <label for="<?php echo $this->get_field_id('story_prev'); ?>"><strong><?php _e('Previous Chapter','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('story_prev_title'); ?>" name="<?php echo $this->get_field_name('story_prev_title'); ?>" type="text" value="<?php echo attribute_escape($instance['story_prev_title']); ?>" /></label><br />	
		<br />
		<input id="<?php echo $this->get_field_id('story_next'); ?>" name="<?php echo $this->get_field_name('story_next'); ?>" type="checkbox" value="1" <?php checked(true, $instance['story_next']); ?> /> <label for="<?php echo $this->get_field_id('story_next'); ?>"><strong><?php _e('Next Chapter','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('story_next_title'); ?>" name="<?php echo $this->get_field_name('story_next_title'); ?>" type="text" value="<?php echo attribute_escape($instance['story_next_title']); ?>" /></label><br />
		<br />
		
		<input id="<?php echo $this->get_field_id('prev_in'); ?>" name="<?php echo $this->get_field_name('prev_in'); ?>" type="checkbox" value="1" <?php checked(true, $instance['prev_in']); ?> /> <label for="<?php echo $this->get_field_id('prev_in'); ?>"><strong><?php _e('Previous In Chapter','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('prev_in_title'); ?>" name="<?php echo $this->get_field_name('prev_in_title'); ?>" type="text" value="<?php echo attribute_escape($instance['prev_in_title']); ?>" /></label><br />	
		<br />
		<input id="<?php echo $this->get_field_id('next_in'); ?>" name="<?php echo $this->get_field_name('next_in'); ?>" type="checkbox" value="1" <?php checked(true, $instance['next_in']); ?> /> <label for="<?php echo $this->get_field_id('next_in'); ?>"><strong><?php _e('Next In Chapter','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('next_in_title'); ?>" name="<?php echo $this->get_field_name('next_in_title'); ?>" type="text" value="<?php echo attribute_escape($instance['next_in_title']); ?>" /></label><br />
		<br />
<?php } ?>

		<input id="<?php echo $this->get_field_id('comictitle'); ?>" name="<?php echo $this->get_field_name('comictitle'); ?>" type="checkbox" value="1" <?php checked(true, $instance['comictitle']); ?> /> <label for="<?php echo $this->get_field_id('comictitle'); ?>"><strong><?php _e('Comic Title','comicpress'); ?></strong></label><br />
		<br />
		
		<input id="<?php echo $this->get_field_id('archives'); ?>" name="<?php echo $this->get_field_name('archives'); ?>" type="checkbox" value="1" <?php checked(true, $instance['archives']); ?> /> <label for="<?php echo $this->get_field_id('archives'); ?>"><strong><?php _e('Archives','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('archives_title'); ?>" name="<?php echo $this->get_field_name('archives_title'); ?>" type="text" value="<?php echo attribute_escape($instance['archives_title']); ?>" /><br />	
		Archive URL: <input class="widefat" id="<?php echo $this->get_field_id('archive_path'); ?>" name="<?php echo $this->get_field_name('archive_path'); ?>" type="text" value="<?php echo attribute_escape($instance['archive_path']); ?>" /><br />
		<br />

		<input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="checkbox" value="1" <?php checked(true, $instance['comments']); ?> /> <label for="<?php echo $this->get_field_id('comments'); ?>"><strong><?php _e('Comments','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($instance['comments_title']); ?>" /></label><br />	
		<br />

		<input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="checkbox" value="1" <?php checked(true, $instance['random']); ?> /> <label for="<?php echo $this->get_field_id('random'); ?>"><strong><?php _e('Random','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('random_title'); ?>" name="<?php echo $this->get_field_name('random_title'); ?>" type="text" value="<?php echo attribute_escape($instance['random_title']); ?>" /></label><br />	
		<br />
		<?php if ($comicpress_options['enable_buy_print']) { ?>
			<input id="<?php echo $this->get_field_id('buyprint'); ?>" name="<?php echo $this->get_field_name('buyprint'); ?>" type="checkbox" value="1" <?php checked(true, $instance['buyprint']); ?> /> <label for="<?php echo $this->get_field_id('buyprint'); ?>"><strong><?php _e('Buy Print','comicpress'); ?></strong></label>
			<input class="widefat" id="<?php echo $this->get_field_id('buyprint_title'); ?>" name="<?php echo $this->get_field_name('buyprint_title'); ?>" type="text" value="<?php echo attribute_escape($instance['buyprint_title']); ?>" /></label><br />	
			<br />
		<?php } ?>

		<input id="<?php echo $this->get_field_id('sharethis'); ?>" name="<?php echo $this->get_field_name('sharethis'); ?>" type="checkbox" value="1" <?php checked(true, $instance['sharethis']); ?> /> <label for="<?php echo $this->get_field_id('sharethis'); ?>"><strong><?php _e('Share','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('sharethis_title'); ?>" name="<?php echo $this->get_field_name('sharethis_title'); ?>" type="text" value="<?php echo attribute_escape($instance['sharethis_title']); ?>" /><br />
		<br />

		<input id="<?php echo $this->get_field_id('subscribe'); ?>" name="<?php echo $this->get_field_name('subscribe'); ?>" type="checkbox" value="1" <?php checked(true, $instance['subscribe']); ?> /> <label for="<?php echo $this->get_field_id('subscribe'); ?>"><strong><?php _e('Subscribe','comicpress'); ?></strong></label>
		<input class="widefat" id="<?php echo $this->get_field_id('subscribe_title'); ?>" name="<?php echo $this->get_field_name('subscribe_title'); ?>" type="text" value="<?php echo attribute_escape($instance['subscribe_title']); ?>" /><br />	
		<br />
		
		<hr>
<?php
	}
}
register_widget('widget_comicpress_graphical_navigation');


function widget_comicpress_graphical_navigation_init() {    
	new widget_comicpress_graphical_navigation(); 
} 

add_action('widgets_init', 'widget_comicpress_graphical_navigation_init');

?>