<?php global $comicpress_options; ?>
<div id="footer">
<?php
	if (function_exists('the_project_wonderful_ad')) {
		the_project_wonderful_ad('footer');
	} 
	get_sidebar('footer');
	if (!$comicpress_options['disable_footer_text']) { 
		echo comicpress_footer_text();
	}
	if ($comicpress_options['enable_page_load_info']) { ?>
		<p><?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds.</p>
	<?php } else { ?>
		<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. //-->
	<?php } ?>
</div>
 
<?php 
if (!$comicpress_options['disable_page_restraints']) { ?>
	</div><!-- Ends "page/page-wide" -->
</div><!-- Ends "page-wrap" -->
<?php } ?>
<div id="page-foot"></div>

<?php wp_footer() ?>
</body>
</html>