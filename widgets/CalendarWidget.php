<?php
/*
Widget Name: ComicPress Calendar
Widget URI: http://comicpress.org/
Description: Display a calendar of this months posts.
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://frumph.net/
*/


class ComicPressCalendarWidget extends WP_Widget {
	
	function ComicPressCalendarWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Display a calendar showing this months posts. (this calendar does not drop lines if there is no title given.)','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Calendar','comicpress'), $widget_ops);
		}
	}

	function widget($args, $instance) {
		global $post, $wp_query;
		extract($args, EXTR_SKIP);

		echo $before_widget;

		if (!empty($instance)) { extract($instance); } ?>
		<center>
			<div id="wp-calendar-head"></div>
			<div id="wp-calendar-wrap">
				<?php if (!empty($thumbnail)) { ?>
					<div class="wp-calendar-download">
					<?php if (!empty($link)) { ?>
						<a href="<?php echo esc_attr($link); ?>"><img src="<?php echo esc_attr($thumbnail); ?>" class="wp-calendar-thumb" alt="" /></a>
					<?php } else { ?>
						<img src="<?php echo esc_attr($thumbnail); ?>" class="wp-calendar-thumb" alt="" />
					<?php } ?>
						<div class="wp-calendar-download-links">
							<?php if (!empty($small) || !empty($medium) || !empty($large)) { ?>
								<?php _e('DOWNLOAD','comicpress'); ?>
								<?php
								  foreach (array(
								    'small' => array(__('Download Small', 'comicpress'), __('S', 'comicpress')),
								    'medium' => array(__('Download Medium', 'comicpress'), __('M', 'comicpress')),
								  	'large' => array(__('Download Large', 'comicpress'), __('L', 'comicpress'))
								 	) as $field => $text) {
								 		if (!empty(${$field})) {
								 			?><a href="<?php echo esc_attr(${$field}); ?>" title="<?php echo esc_attr($text[0]); ?>"><?php echo esc_html($text[1]); ?></a><?php
								 		}
								 	}
							} ?>
						</div>
					</div>
				<?php } ?>
			<?php get_calendar(); ?>
			</div>
			<div id="wp-calendar-foot"></div>
		</center>
		<?php

		echo $after_widget;
	}

	function update($new_instance, $old_instance = array()) {
		$instance = array();
		foreach (array('thumbnail', 'small', 'medium', 'large', 'link') as $field) {
			if (isset($new_instance[$field])) {	$instance[$field] = strip_tags($new_instance[$field]); }
		}

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'thumbnail' => '', 'small' => '', 'medium' => '', 'large' => '', 'link' => '') );

		$thumbnail = strip_tags($instance['thumbnail']);
		$small = strip_tags($instance['small']);
		$medium = strip_tags($instance['medium']);
		$large = strip_tags($instance['large']);
		$link = $instance['link'];

		foreach (array(
			'thumbnail' => __('Thumbnail URL (178px by 130px):','comicpress'),
			'link' => array('label' => __('Add link on thumbnails:','comicpress'), 'after' => '<hr />'),
			'small' => __('Wallpaper URL (Small):','comicpress'),
			'medium' => __('Wallpaper URL (Medium):','comicpress'),
			'large' => __('Wallpaper URL (Large):','comicpress'),
		) as $field => $label) {
			unset($after);
			if (is_array($label)) { extract($label); }
			?><p>
				<label for="<?php echo $this->get_field_id($field); ?>"><?php echo esc_html($label) ;?>
				<input class="widefat"
							 id="<?php echo $this->get_field_id($field); ?>"
							 name="<?php echo $this->get_field_name($field); ?>"
							 type="text"
							 value="<?php echo esc_attr($instance[$field]); ?>" />
				</label>
			</p><?php

			if (isset($after)) { echo $after; }
		}
	}
}

register_widget('ComicPressCalendarWidget');


function ComicPressCalendarWidget_init() {    
	new ComicPressCalendarWidget(); 
} 

add_action('widgets_init', 'ComicPressCalendarWidget_init');

