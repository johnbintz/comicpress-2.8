<?php global $comicpress_options; ?>
<?php if (comicpress_check_child_file('layout-head') == false) { ?>

<div id="content-wrapper-head"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>
	
	<?php if (is_cp_theme_layout('v3cr')) { ?>
		<div id="pagewrap-left">
	<?php } ?>

	<?php if (is_cp_theme_layout('v,v3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } ?>

<?php 
	if (!$comicpress_options['disable_comic_frontpage'] && is_home()) {
		Protect();
		if ($comicpress_options['enable_random_comic_frontpage'] && is_home()) {
			$comic_query = 'showposts=1&orderby=rand&cat='.get_all_comic_categories_as_cat_string();
		} else {
			$comic_query = 'showposts=1&cat='.get_all_comic_categories_as_cat_string();
		}
		$posts = query_posts($comic_query);
		if (have_posts()) {
			while (have_posts()) : the_post();
				global $frontpage_postnum;
				$frontpage_postnum = $post->ID;
				$wp_query->is_single = true;
				comicpress_display_comic_area();
			endwhile;
		}
		Restore();
		UnProtect();
		wp_reset_query();
	}
	if (is_single() & in_comic_category()) {
		comicpress_display_comic_area();
	}
?>

<?php if (is_cp_theme_layout('3c,standard,3c2r')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c,rgn')) get_sidebar('left'); ?>

<?php if (is_cp_theme_layout('v3cr')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } ?>
<?php } ?>
	
