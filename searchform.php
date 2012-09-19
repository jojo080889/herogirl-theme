<?php if (comicpress_check_child_file('searchform') == false) { ?>
<form method="get" id="searchform" action="<?php bloginfo('wpurl'); ?>/">
	<div>
		<label id="search_label" for="s-search">Search...</label>
		<input type="text" name="s" id="s-search" onfocus="document.getElementById('search_label').style.display = 'none'" onblur="if (this.value == '') { document.getElementById('search_label').style.display = 'inline'; }" />
		<button type="submit">&raquo;</button>
	</div>
	<div class="clear"></div>
</form>
<?php } ?>