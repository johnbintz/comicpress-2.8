<?php global $post; if ($post->comment_status != 'closed') { ?>
	<div class="comment-link">
		<?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&rdquo;</span>', '<span class="comment-balloon">1</span>', '<span class="comment-balloon">%</span>'); ?>
	</div>
<?php } ?>
