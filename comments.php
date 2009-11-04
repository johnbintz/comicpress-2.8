<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die (__('Please do not load this page directly. Thanks!','comicpress'));

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','comicpress'); ?></p>
	<?php
	return;
} ?>

<div id="comment-wrapper-head"></div>
<div id="comment-wrapper">

<?php if ( have_comments() ) : ?>


	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
		<div class="commentsrsslink">[ <?php comments_rss_link('Comments RSS'); ?> ]</div>
		<h3 id="comments"><?php comments_number(__('Discussion &not;','comicpress'), __('Discussion &not;','comicpress'), __('Discussion (%) &not;','comicpress') );?></h3>

		<ol class="commentlist">
		<?php 
		if (function_exists('comicpress_comments_callback')) { 
			wp_list_comments(array(
						'type' => 'comment',
						'reply_text' => __('Reply to %s&not;','comicpress'), 
						'callback' => 'comicpress_comments_callback',
						'end-callback' => 'comicpress_comments_end_callback',
						'avatar_size'=>64
						)
					); 
		} else {
			wp_list_comments(array('type' => 'comment', 'avatar_size'=>64));
			}?>	
		</ol>
	<?php endif; ?>
	
		<?php global $enable_numbered_pagination; if ($enable_numbered_pagination == 'yes') { ?>
		<?php 
			$pagelinks = paginate_comments_links(array('echo' => 0)); 
			if (!empty($pagelinks)) {
				$pagelinks = preg_replace('#\<a#', '<li><a', $pagelinks);
				$pagelinks = preg_replace('#\<\/a\>#', '</a></li>', $pagelinks); 
				$pagelinks = preg_replace('#\<span#', '<li', $pagelinks); 
				$pagelinks = preg_replace('#\<\/span\>#', '</li>', $pagelinks); ?>
			<div id="wp-paginav">
				<div id="paginav">				
					<?php echo '<ul><li class="paginav-extend">'.__('Comment Pages','comicpress').'</li>'. $pagelinks . '</ul>'; ?>
					</div>
				<div class="clear"></div>
			</div>					
			<?php } ?>

		<?php } else { ?>
			<div class="commentnav">
				<div class="commentnav-right"><?php next_comments_link(__('Next Comments &uarr;','comicpress')) ?></div>
				<div class="commentnav-left"><?php previous_comments_link(__('&darr; Previous Comments','comicpress')) ?></div>
				<div class="clear"></div>
			</div>
		<?php } ?>

	
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<p class="nocomments"><?php _e('Comments are closed.','comicpress'); ?></p>
	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

	<div id="respond">

		<h3><?php comment_form_title( __('Comment &not;','comicpress'), __('Reply to %s &not;','comicpress') ); ?></h3>

		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php _e('You must be','comicpress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in','comicpress'); ?></a> <?php _e('to post a comment.','comicpress'); ?></p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
					<p><?php _e('Logged in as','comicpress'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','comicpress'); ?>"><?php _e('Log out &raquo;','comicpress'); ?></a></p>
				<?php else : ?>
					<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					<label for="author"><small><?php _e('NAME &mdash;','comicpress'); ?> <a href="http://gravatar.com"><?php _e('Get a Gravatar','comicpress'); ?></a></small></label></p>
					<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
					<label for="email"><small><?php _e('EMAIL','comicpress'); ?> <?php if ($req) echo __("&mdash; Required / not published",'comicpress'); ?> </small></label></p>
					<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small><?php _e('WEBSITE','comicpress'); ?></small></label></p>
				<?php endif; ?>
				<?php do_action('comment_form', $post->ID); ?>
				<p><textarea name="comment" id="comment" cols="50" rows="6" tabindex="4"></textarea></p>
				<button type="submit"><?php _e('Submit Comment','comicpress'); ?></button>
				<?php global $disable_comment_note;
				if ($disable_comment_note != 'yes') { ?>
					<div class="comment-note"><?php _e('NOTE - You can use these tags:','comicpress'); ?><br /><?php echo allowed_tags(); ?></div>
				<?php } ?>
				<?php comment_id_fields(); ?>
			</form>	
		<?php endif; ?>
	</div>

<?php endif; ?>

	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	
		<h4 id="comments"><?php _e('Pings & Trackbacks &not;','comicpress'); ?></h4>
		<ol class="commentlist">
		<ul>
		<?php 
		if (function_exists('comicpress_comments_callback')) { 
			wp_list_comments(array(
						'type' => 'pings',
						'callback' => 'comicpress_comments_callback',
						'end-callback' => 'comicpress_comments_end_callback',
						'avatar_size'=>32
						)
					); 
		} else {
			wp_list_comments(array('type' => 'pings', 'avatar_size'=>64));
			}?>	
			</ul>
		</ol>
	<?php endif; ?>
	
</div>
<div id="comment-wrapper-foot"></div>