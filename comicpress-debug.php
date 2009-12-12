<?php

function comicpress_notice_debug() {
	global $current_user, $comiccat, $blogcat, $comic_folder;

	if( substr( $_SERVER[ 'PHP_SELF' ], -19 ) != '/wp-admin/index.php' )
		return;

	$comicpress_options = comicpress_load_options();
	
	$error = array();
	$post_cat_link = get_bloginfo('wpurl') . '/wp-admin/categories.php';
	
	// Check Categories
	if ($comiccat == $blogcat) {
		$error[] = array('header', __('Primary Comic and Blog categories are not configured properly.','comicpress'));
		$error[] = __('ComicPress requires 2 categories to be added to the ','comicpress') . '<a href="'.$post_cat_link.'">' . __('post categories.','comicpress') . '</a>' . 
			__(' It is necessary to have 2 more categories in addition to the uncategorized category, a Blog and Comic primary categories.  These two additional categories will be the root categories that seperate the difference between the comic and blog posts.  When you post a new comic you will be posting it into the comic category or heirarchal children of the comic category.   When posting a new blog post you need to set it into the blog category or child of the blog category.   Uncategorized will act as a blog post category (do not rename uncategorized).  You can configure the categories to set as the primary blog and comic category from within the comicpress-config.php file or use ComicPress Manager - ComicPress Config','comicpress');
	}	
	
	// Check Comics Folder
	if (!is_dir(ABSPATH . '/' . $comic_folder)) {
		$error[] = array('header', __('Comics Folder is not configured and is unable to be found.','comicpress'));
		$error[] = __('ComicPress stores the files it uses inside a specific directory and that directory is set within the comicpress-config.php or you can configure it from within ComicPress Manager.  When this error is present it means that the theme is unable to find the appropriate directory to read the comics from.','comicpress');
	}		
	
	if (!empty($error)) {
	?>
	<div class="error">
		<h2>ComicPress Debug</h2>
		ComicPress doesn't seem to be fully installed at this time, check out these messages.<br />
		<br />
		<?php
			foreach ($error as $info) {
				unset($text);
				if (is_array($info)) {
					list($type, $text) = $info;
				} else {
					if (is_string($info)) {
						$text = $info;
						$type = 'paragraph';
					}
				}
				if (!empty($text) && !empty($type)) {
					switch ($type) {
						case 'header': echo "<h3>${text}</h3>"; break;
						case 'raw': echo $text; break;
						default: echo "<p>${text}</p>"; break;
					}
				}	  	  
			}
		?>
		<br />
		<br />
	</div>
<?php 
	}
}

add_action( 'admin_notices', 'comicpress_notice_debug' );

?>