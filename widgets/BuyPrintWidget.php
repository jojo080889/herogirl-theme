<?php
/*
Widget Name: Buy Print
Widget URI: http://comicpress.org/
Description: Places a button that works with the Buy This template.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/
$comicpress_options = get_option('comicpress_options');

if ($comicpress_options['enable_buy_print']) {
	
	class ComicPressBuyPrintWidget extends WP_Widget {
		
		function ComicPressBuyPrintWidget($skip_widget_init = false) {
			if (!$skip_widget_init) {
				$widget_ops = array('classname' => __CLASS__, 'description' => __('Adds a button that goes to the buy print template page.','comicpress') );
				$this->WP_Widget(__CLASS__, __('ComicPress Buy This Print','comicpress'), $widget_ops);
			}
		}
		
		function init() {
			add_filter('comicpress_buy_print_structure', array(&$this, 'buy_print_structure'));
		}
		
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			
			echo $before_widget;
			$title = apply_filters('widget_title', $instance['title']);
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
			
			$buyprint = get_post_meta(get_the_ID(), "buyprint", true);
			
			if ($buyprint !== 'sold' && $buyprint !== 'outofstock') {
				echo apply_filters('comicpress_buy_print_structure', '');
			}
			
			echo $after_widget;
		}
		
		function buy_print_structure($content = '') {
			$comicpress_options = comicpress_load_options(); ?>
			<div class="buythis"><form method="post" action="<?php echo $comicpress_options['buy_print_url']; ?>">
			<input type="hidden" name="comic" value="<?php echo get_the_ID(); ?>" />
			<button class="buythisbutton" type="submit" value="submit" name="submit"></button></form></div>
			<div class="clear"></div>
			<?php
		}
		
		function update($new_instance, $old_instance = array()) {
			$instance = array();
			foreach (array('title') as $field) {
				if (isset($new_instance[$field])) { $instance[$field] = strip_tags($new_instance[$field]); }
			}
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
	
	register_widget('ComicPressBuyPrintWidget');
	
	
	function ComicPressBuyPrintWidget_init() {    
		new ComicPressBuyPrintWidget(); 
	} 
	
	add_action('widgets_init', 'ComicPressBuyPrintWidget_init');
	
}
?>