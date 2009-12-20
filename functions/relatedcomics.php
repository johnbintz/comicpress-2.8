<?php
/**
 * Related comics
 * Displays a list of comic links that are related to this current one using shortcode.
 *
 * Usage:  [related_comics]
 *
 */

function related_comics_shortcode( $atts = '' ) {
	extract(shortcode_atts(array(
					'limit' => '5',
					), $atts));

	global $wpdb, $post, $table_prefix, $category_tree;

	if ($post->ID) {
		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
		if (empty($tagslist)) return;
		if (empty($limit)) $limit = 5;
		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
				FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
				GROUP BY tr.object_id
				ORDER BY count DESC, p.post_date_gmt DESC
				LIMIT $limit;";

		$related = $wpdb->get_results($q);
		if ( $related ) {
			$retval = '
					<div class="related_posts">
					'.__('Related Comics &not;','comicpress');
			$retval .= '
					<ul><li>';
			$comic_categories = array();
			foreach ($category_tree as $node) {
				$comic_categories[] = end(explode("/", $node));
			}
			$in_comic_cat = 0;
			$retval .= '
					<table class="month-table">';
			foreach($related as $r) :
				if (count(array_intersect($comic_categories, wp_get_post_categories($r->ID))) > 0)
					$retval .= '
							<tr><td class="archive-date" align="right">'.date('M j, Y',strtotime($r->post_date)).'</td><td class="archive-title"><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></td></tr>';
			endforeach;
			$retval .= '
					</table>';
		} else {
			$retval .= '
					<li>'.__('No related comics found','comicpress').'</li>';
		}
		$retval .= '
				</li></ul>';
		$retval .= '
				</div>';
		return $retval;
	}
	return;
}
// add_shortcode('related_comics', 'related_comics_shortcode');

?>

