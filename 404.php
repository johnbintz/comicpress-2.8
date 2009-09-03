<?php get_header(); ?>

<?php if (is_cp_theme_style('gn,v3c')) get_sidebar('left'); ?>

<?php if (is_cp_theme_style('v3c,v')) { ?>
	<div id="content" class="narrowcolumn">
		<div class="column">
<?php } ?>

<?php if (is_cp_theme_style('gn')) { ?>
	<div id="pagewrap-right">
<?php } ?>

	<?php if (is_cp_theme_style('3c,standard')) { ?>
	<div id="content-wrapper">
	<?php } ?>
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_style('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_style('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } ?>

	<div class="post-page-head"></div>
	<div class="post-page">
		<h2 class="pagetitle">Page Not Found</h2>
		<p><a href="<?php bloginfo('url') ?>">Click here to return to the home page</a> or try a search:</p>
		<p><?php include (get_template_directory() . '/searchform.php') ?></p>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
	</div>
	<div class="clear"></div>
</div>

<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

	<?php if (is_cp_theme_style('gn')) { ?>
		</div>
	<?php } ?>	

	<div class="clear"></div>

</div> <!-- end pageright-wrapper / content-wrapper -->

<?php get_footer() ?>