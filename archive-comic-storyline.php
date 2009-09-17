<?php
/*
Template Name: Comic Storyline Archive
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
	<?php } ?>
	
<div class="<?php comicpress_blogpost_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
	<?php while (have_posts()) : the_post() ?>
		<div class="entry">
			<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
		<ul id="storyline" class="level-0">
			<?php if (get_option('comicpress-enable-storyline-support') == 1) {
				if (($result = get_option("comicpress-storyline-category-order")) !== false) {
					$categories_by_id = get_all_category_objects_by_id();
					$current_depth = 0;
					$storyline_root = " class=\"storyline-root\"";
					foreach (explode(",", $result) as $node) {
						$parts = explode("/", $node);
						$target_depth = count($parts) - 2;
						$category_id = end($parts);
						$category = $categories_by_id[$category_id];
						$description = $category->description;
						$first_comic_in_category = get_terminal_post_in_category($category_id);
						$first_comic_permalink = get_permalink($first_comic_in_category->ID);
						$archive_image = null;
						foreach (array("archive", "rss", "comic") as $type) {
							if (($requested_archive_image = get_comic_url("archive", $first_comic_in_category)) !== false) {
								$archive_image = $requested_archive_image; break;
							}
						}
						if ($target_depth < $current_depth) {
							echo str_repeat("</ul></li>", ($current_depth - $target_depth));
						}
						if ($target_depth > $current_depth) {
							for ($i = $current_depth; $i < $target_depth; ++$i) {
								$next_i = $i + 1;
								echo "<li><ul class=\"level-${next_i}\">";
							}
						} ?>
						
						<li id="storyline-<?php echo $category->category_nicename ?>"<?php echo $storyline_root; $storyline_root = null ?>>
							<a href="<?php echo get_category_link($category_id) ?>" class="storyline-title"><?php echo $category->cat_name ?></a>
							<div class="storyline-description">
								<?php if (!empty($description)) { ?>
									<?php echo $description ?>
								<?php } ?>
								<?php if (!empty($first_comic_in_category)) { ?>
									Begins with &ldquo;<a href="<?php echo $first_comic_permalink ?>"><?php echo $first_comic_in_category->post_title ?></a>&rdquo;.
								<?php } ?>
							</div>
							<div class="storyline-foot"></div>
						</li>
						
						<?php $current_depth = $target_depth;
					}
					if ($current_depth > 0) {
						echo str_repeat("</ul></li>", $current_depth);
					}
				}
			} else { ?>
				<li><h3>Storyline Support is not currently enabled on this site.</h3><br /><br /><strong>Note to the Administrator:</strong><br /> To enable storyline support and manage storyline categories make sure you are running the latest version of the <a href="http://wordpress.org/extend/plugins/comicpress-manager/">ComicPress Manager</a> plugin and check your storyline settings from it's administration menu.</h3></li>
			<?php } ?>
		</ul>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>
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