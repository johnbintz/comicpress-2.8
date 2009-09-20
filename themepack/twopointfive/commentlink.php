<?php global $post; if ($post->comment_status != 'closed') { ?>
	<div class="comment-link">[ <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> ]</div><?php } ?>
}
