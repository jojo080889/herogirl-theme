<?php if (comicpress_check_child_file('searchform') == false) { ?>
<form method="get" id="searchform-transcript" action="<?php bloginfo('wpurl'); ?>/">
	<div>
		<input type="text" value="<?php _e('Search Transcripts...','comicpress'); ?>" name="s" id="s-transcript" onfocus="this.value=(this.value=='<?php _e('Search Transcripts...','comicpress'); ?>') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php _e('Search Transcripts...','comicpress'); ?>' : this.value;" /><input type="hidden" name="key" value="transcript" />
		<button type="submit">&raquo;</button>
	</div>
	<div class="clear"></div>
</form>
<?php } ?>
