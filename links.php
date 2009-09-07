<?php
/*
Template Name: Links
*/
?>
<?php get_header();  ?>

<?php if (is_cp_theme_layout('gn,v3c,v')) { ?>
	<div id="content-wrapper">
<?php } ?>

<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

<?php if (is_cp_theme_layout('v3c,v')) { ?>
	<div id="content" class="narrowcolumn">
		<div class="column">
<?php } ?>

		<?php if (is_cp_theme_layout('gn')) { ?>
			<div id="pagewrap-right">
		<?php } ?>

	<?php if (is_cp_theme_layout('3c,standard')) { ?>
		<div id="content-wrapper">
	<?php } ?>
	
	<?php get_sidebar('overblog'); ?>
	
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } 
			$bookmarks = wp_list_bookmarks('echo=0');
			$bookmarks = preg_replace('#<li ([^>]*)>#', '<li>', $bookmarks);
			$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks);
	 ?>
	
	<?php while (have_posts()) : the_post() ?>
	
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
		
	<?php endwhile; ?>
			<div class="clear"></div>
		</div>
	</div>
	
<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>

</div> <!-- end pageright-wrapper / content-wrapper -->

<?php get_footer() ?>
<?php get_footer() ?>