<?php
/*
Template Name: Archives
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
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
		<div class="<?php comicpress_blogpost_class(); ?>">
			<div class="post-page-head"></div>
			<div class="post-page">
				<div id="archivepage">
					<h2>Archives by Month:</h2>
					<ul><?php wp_get_archives('type=monthly') ?></ul>
					<h2>Archives by Subject:</h2>
					<ul><?php wp_list_categories() ?></ul>
					<br class="clear-margins" />
				</div>
			</div>
			<div class="post-page-foot"></div>
		</div>
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
</div>
<div id="content-wrapper-bottom"></div>
<?php get_footer() ?>