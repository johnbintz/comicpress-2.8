<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
	return;
} ?>

<div <?php comment_class(); ?>>

<?php if ( have_comments() ) : ?>


	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
		<div class="commentsrsslink">[ <?php comments_rss_link('Comments RSS'); ?> ]</div>
		<h3 id="comments"><?php comments_number('Discussion &not;', 'Discussion &not;', 'Discussion (%) &not;' );?></h3>

		<ol class="commentlist">
		<?php 
		if (function_exists('comicpress_comments_callback')) { 
			wp_list_comments(array(
						'type' => 'comment',
						'reply_text' => 'Reply to %s&not;', 
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
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	
		<h4 id="comments">Pings & Trackbacks &not;</h4>
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
					<?php echo '<ul><li class="paginav-extend">Comment Pages</li>'. $pagelinks . '</ul>'; ?>
					</div>
				<div class="clear"></div>
			</div>					
			<?php } ?>

		<?php } else { ?>
			<div class="commentnav">
				<div class="commentnav-right"><?php next_comments_link('Newer Comments &uarr;') ?></div>
				<div class="commentnav-left"><?php previous_comments_link('&darr; Previous Comments') ?></div>
				<div class="clear"></div>
			</div>
		<?php } ?>

	
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->






	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

	<div id="respond">

		<h3><?php comment_form_title( 'Comment &not;', 'Reply to %s &not;' ); ?></h3>

		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
					<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
				<?php else : ?>
					<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					<label for="author"><small>NAME &mdash; <a href="http://gravatar.com">Get an avatar</a></small></label></p>
					<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
					<label for="email"><small>EMAIL <?php if ($req) echo "&mdash; Required / not published"; ?> </small></label></p>
					<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small>WEBSITE</small></label></p>
				<?php endif; ?>
				<?php do_action('comment_form', $post->ID); ?>
				<p><textarea name="comment" id="comment" cols="50" rows="6" tabindex="4"></textarea></p>
				<button type="submit" class="button">Submit Comment</button>
				<?php global $disable_comment_note;
				if ($disable_comment_note != 'yes') { ?>
					<div class="comment-note">NOTE - You can use these tags:<br /><?php echo allowed_tags(); ?></div>
				<?php } ?>
				<?php comment_id_fields(); ?>
			</form>	
		<?php endif; ?>
	</div>

<?php endif; ?>
</div>