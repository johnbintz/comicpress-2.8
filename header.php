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
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<?php comicpress_gnav_display_css(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name') ?> RSS2 Feed" href="<?php bloginfo('rss2_url') ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name') ?> Atom Feed" href="<?php bloginfo('atom_url') ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<meta name="ComicPress" content="<?php echo $comicpress_options['comicpress_version']; ?>" />

<!--[if lt IE 7]>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ie6submenus.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php if (function_exists('body_class')) { body_class(); } ?>>

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
<?php if (comicpress_check_child_file('partials/headerarea') == false) { ?>
<div id="header">
	<?php if (function_exists('the_project_wonderful_ad')) {
		the_project_wonderful_ad('header');
	} ?>
		<h1><a href="<?php bloginfo('wpurl'); ?>"><?php bloginfo('name') ?></a></h1>
			<div class="description"><?php bloginfo('description') ?></div>
<?php get_sidebar('header'); ?>
			<div class="clear"></div>
		</div>
<?php } ?>
<?php get_sidebar('menubar'); ?>
