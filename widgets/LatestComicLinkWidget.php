<?php
/*
Widget Name: Go Latest Comic
Widget URI: http://comicpress.org/
Description: Creates a link to the latest Comic
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://frumph.net/

*/	
	
class ComicPressLatestComicLinkWidget extends WP_Widget {

	function ComicPressLatestComicLinkWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays a link to click to go to the latest comic.','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Latest Comic Link','comicpress'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
			<h2 class="latestcomic"><a href="/?latestcomic">Latest Comic</a></h2>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('ComicPressLatestComicLinkWidget');


function ComicPressLatestComicLinkWidget_init() {    
	new ComicPressLatestComicLinkWidget(); 
} 

add_action('widgets_init', 'ComicPressLatestComicLinkWidget_init');
?>