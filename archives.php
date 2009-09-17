<?php
/*
Template Name: Archives
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
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

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>