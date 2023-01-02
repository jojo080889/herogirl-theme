<?php global $comicpress_options; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php
	bloginfo('name');
	if (is_home () ) {
		echo " - "; bloginfo('description');
	} elseif (is_category() ) {
		echo " - "; single_cat_title();
	} elseif (is_single() || is_page() ) {
		echo " - "; single_post_title();
	} elseif (is_search() ) {
		echo __(" search results: ",'comicpress'); echo wp_specialchars($s);
	} else {
		echo " - "; wp_title('',true);
	}
  ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link href='http://fonts.googleapis.com/css?family=Fauna+One|Cherry+Swash:400,700' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<?php if ($comicpress_options['enable_design_options']) { ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/style.php" />
<?php } ?>
	<?php comicpress_gnav_display_css(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name') ?> RSS2 Feed" href="<?php bloginfo('rss2_url') ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name') ?> Atom Feed" href="<?php bloginfo('atom_url') ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
	<meta name="ComicPress" content="<?php global $comicpress_version; echo $comicpress_version; ?>" />
	<?php if ( is_singular() && $comicpress_options['enable_comment_javascript'] ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js?ver=2.4.1"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/persistent_navi.js"></script>

<!--[if lt IE 7]>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ie6submenus.js"></script>
<![endif]-->

<?php wp_head(); ?>

<!-- jquery/prototype conflict resolution -->
<script type="text/javascript">
jQuery.noConflict();
</script>
</head>

<body <?php if (function_exists('body_class')) { body_class(); } ?>>
<!-- FB like code -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Project Wonderful Ad Box Loader -->
<!-- Put this after the <body> tag at the top of your page -->
<script type="text/javascript">
   (function(){function pw_load(){
      if(arguments.callee.z)return;else arguments.callee.z=true;
      var d=document;var s=d.createElement('script');
      var x=d.getElementsByTagName('script')[0];
      s.type='text/javascript';s.async=true;
      s.src='//www.projectwonderful.com/pwa.js';
      x.parentNode.insertBefore(s,x);}
   if (window.attachEvent){
    window.attachEvent('DOMContentLoaded',pw_load);
    window.attachEvent('onload',pw_load);}
   else{
    window.addEventListener('DOMContentLoaded',pw_load,false);
    window.addEventListener('load',pw_load,false);}})();
</script>
<!-- End Project Wonderful Ad Box Loader -->

<?php do_action('comicpress-header'); ?>
<?php get_sidebar('above'); ?>
<div id="page-head"></div>
<?php if (!$comicpress_options['disable_page_restraints']) {
	if (is_cp_theme_layout('standard,v')) { ?>
<div id="page-wrap"><!-- Wraps outside the site width -->
	<div id="page"><!-- Defines entire site width - Ends in Footer -->
<?php } else { ?>
<div id="page-wide-wrap"><!-- Wraps outside the site width -->
	<div id="page-wide"><!-- Defines entire site width - Ends in Footer -->
		<?php }
} ?>

<div id="header">
	<?php if (function_exists('the_project_wonderful_ad')) {
		the_project_wonderful_ad('header');
	} ?>
	<span class="icon">
		<img src="<?php bloginfo('template_directory'); ?>/images/herogirl-logo.png" />
	</span>
	<a href="<?php bloginfo('url'); ?>" class="blog-name">
		Herogirl
	</a>
	<div class="description"><?php bloginfo('description') ?></div>
	<?php get_sidebar('header'); ?>
	<div class="clear"></div>
</div>

<?php get_sidebar('menubar'); ?>