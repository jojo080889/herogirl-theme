<?php 
header("Content-type: text/css");
require_once '../../../wp-load.php';
$comicpress_options = get_option('comicpress_options');

if (!empty($comicpress_options['design_options']['body_background'])) { ?>
body {
	background: #<?php echo $comicpress_options['design_options']['body_background']; ?>;
}
<?php } ?>