<?php if (comicpress_check_child_file('searchform') == false) { ?>
<form method="get" id="searchform" action="<?php bloginfo('wpurl'); ?>/">
	<div>
		<label id="search_label" for="s-search"><i class="fa fa-search"></i></label>
		<input type="text" name="s" id="s-search" placeholder="Search" />
		<button type="submit"></button>
	</div>
	<div class="clear"></div>
</form>
<?php } ?>