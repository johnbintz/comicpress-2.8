<?php
/*
Template Name: Comic Storyline with Thumbs
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
<?php 
if (have_posts()) {
	while (have_posts()) : the_post();
		comicpress_display_post();
	endwhile; 
}
?>

<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
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
			$first_comic_in_category = get_terminal_post_in_category($category_id,true);
			$first_comic_permalink = get_permalink($first_comic_in_category->ID);
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
							<?php if (!empty($first_comic_in_category)) { ?>
								<a href="<?php echo $first_comic_permalink ?>" title="<?php _e('First comic in','comicpress'); ?> <?php echo $category->cat_name ?>."><?php echo comicpress_display_comic_image('mini,archive,rss,comic', false, $first_comic_in_category, __('First comic in','comicpress').' '.$category->cat_name); ?></a>
							<?php } ?>
							<a href="<?php echo get_category_link($category_id) ?>" class="storyline-title"><?php echo $category->cat_name ?></a>
							<?php if (!empty($description)) { ?>
								<div class="storyline-description"><?php echo $description ?></div>
							<?php } ?>
							<div class="storyline-foot"></div>
						</li>
						
			<?php $current_depth = $target_depth;
		}
		if ($current_depth > 0) {
			echo str_repeat("</ul></li>", $current_depth);
		}
	}
			} else { ?>
				<li><h3><?php _e('Storyline Support is not currently enabled on this site.','comicpress'); ?></h3><br /><br /><strong><?php _e('Note to the Administrator:','comicpress'); ?></strong><br /> <?php _e('To enable storyline support and manage storyline categories make sure you are running the latest version of the ','comicpress'); ?><a href="http://wordpress.org/extend/plugins/comicpress-manager/">ComicPress Manager</a> <?php _e('plugin and check your storyline settings from it\'s administration menu.','comicpress'); ?></h3></li>
			<?php } ?>
		</ul>
		<br class="clear-margins" />
	</div>
	<div class="post-foot"></div>
</div>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>