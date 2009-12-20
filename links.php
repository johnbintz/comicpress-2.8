<?php
/*
Template Name: Links
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php while (have_posts()) : the_post() ?>

<div class="<?php comicpress_post_class(); ?>">
	<?php if (function_exists('has_post_thumbnail')) {
		if ( has_post_thumbnail() ) { ?>
			<div class="post-page-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('full'); ?></a>
			</div>
		<?php }
	} ?>
	<div class="post-page-head"></div>
	<div class="post-page">
		<?php if (!$comicpress_options['disable_page_titles']) { ?>
			<h2 class="pagetitle"><?php the_title() ?></h2>
		<?php } ?>
		<div class="entry">
			<?php the_content(); ?>
		</div>
		<br class="clear-margins" />
		<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
	</div>
	<div class="post-page-foot"></div>
</div>

<?php endwhile; ?>

<?php 
$linkcatid = get_term_by('name','menubar','link_category');
$linkcatid = $linkcatid->term_id;
$bookmarks = wp_list_bookmarks('echo=0&categorize=1&exclude_category='.$linkcatid); 
$bookmarks = preg_replace('#<li ([^>]*)>#', '<li>', $bookmarks);
$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks);
?>

<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<div id="linkspage">
		<ul>
			<?php echo $bookmarks; ?>
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="post-page-foot"></div>
</div>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
