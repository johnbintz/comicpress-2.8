<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>

<head profile="http://gmpg.org/xfn/11">
	<title><?php 
    bloginfo('name'); 
    if (is_home () ) {
      echo " - "; bloginfo('description');
    } elseif (is_category() ) {
      echo " - "; single_cat_title();
    } elseif (is_single() || is_page() ) { 
      echo " - "; single_post_title();
    } elseif (is_search() ) { 
      echo " search results: "; echo wp_specialchars($s);
    } else { 
      echo " - "; wp_title('',true);
    }
  ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>" type="text/css" media="screen" />
<?php global $graphicnav_directory; if (file_exists(get_template_directory() . '/images/nav/' .$graphicnav_directory. '/navstyle.css')) { ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/images/nav/<?php echo $graphicnav_directory; ?>/navstyle.css" type="text/css" media="screen" />
<?php } ?>
	<link rel="SHORTCUT ICON" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico"/>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name') ?> RSS2 Feed" href="<?php bloginfo('rss2_url') ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name') ?> Atom Feed" href="<?php bloginfo('atom_url') ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scroll.js"></script>
	<meta name="ComicPress" content="<?php echo comicpress_current_theme_version(); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); global $disable_page_restraints; ?>
</head>

<body <?php if (function_exists('body_class')) { body_class(); } ?>>
<?php do_action('comicpress-header'); ?>

<?php get_sidebar('above'); ?> 

<?php if ($disable_page_restraints != 'yes') {
	if (is_cp_theme_style('standard,v')) { ?>
	<div id="page"><!-- Defines entire site width - Ends in Footer -->
<?php } else { ?>
	<div id="page-wide">
	<?php } 
} ?>

<div id="header">
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="headerpwad">
			<?php the_project_wonderful_ad('header'); ?>
		</div>
	<?php } ?>
	<h1><a href="<?php echo get_settings('home') ?>"><?php bloginfo('name') ?></a></h1>
	<div class="description"><?php bloginfo('description') ?></div>
	<?php get_sidebar('header'); ?>
	<div class="clear"></div>
</div>
<?php get_sidebar('menubar'); ?>
