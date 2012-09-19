<?php

function _comicpress_pre_handle_comic_path_results($return, $results, $type, $post_to_use) {
	global $wpmu_version;

	if (!empty($wpmu_version) || defined('VHOST') ) {
		$globals = ComicPressMediaHandling::_bundle_global_variables();

		$comic = $globals[$type] . '/'. basename(reset($results));

		if (($wpmu_path = get_option('fileupload_url')) !== false) {
			$comic = $wpmu_path . '/'. $comic;
		}
		return $comic;
	}
	return false;
}

function _comicpress_expand_filter_callback($value, $matches) {
	global $wpmu_version;

	if (!empty($wpmu_version) || defined('VHOST') ) {
		if (strtolower($matches[1]) == 'wordpress') {
			if ($path = get_option('upload_path')) {
				return $path;
			}
		}
	}
	return $value;
}

add_filter('comicpress_pre_handle_comic_path_results', '_comicpress_pre_handle_comic_path_results', 10, 4);
// add_filter('comicpress_expand_filter_callback', '_comicpress_expand_filter_callback', 10, 2);
