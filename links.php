<?php
/*
Template Name: Links
*/
?>
<?php get_header();  ?>

<div id="content-wrapper-top"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>

	<?php if (is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
<?php if (is_cp_theme_layout('3c,v')) {  ?>
	<div id="area-wrapper">
<?php } ?>
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } 
			$bookmarks = wp_list_bookmarks('echo=0');
			$bookmarks = preg_replace('#<li ([^>]*)>#', '<li>', $bookmarks);
			$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks);
	 ?>
	
	<?php while (have_posts()) : the_post() ?>
	<div class="<?php comicpress_blogpost_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page">
			<h2 class="pagetitle"><?php the_title() ?></h2>
			<div id="linkspage">
			<ul>
				<?php echo $bookmarks; ?>
			</ul>
			</div>
			<br class="clear-margins" />
		</div>
		<div class="post-page-foot"></div>
	</div>
	<?php endwhile; ?>
		</div>
	</div>
	
<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

<?php if (is_cp_theme_layout('3c,v')) {  ?>
		<div class="clear"></div>
	</div>
<?php } ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>
</div>
<div id="content-wrapper-bottom"></div>
<?php get_footer() ?>