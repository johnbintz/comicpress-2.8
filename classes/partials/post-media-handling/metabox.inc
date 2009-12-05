<input type="hidden" name="cp[_nonce]" value="<?php echo esc_attr($nonce) ?>" />
<input type="hidden" name="cp[action]" value="post-media-update" />
<input type="hidden" name="cp[_action_nonce]" value="<?php echo esc_attr($action_nonce) ?>" />
<p>
	<em>Enter in relative or absolute URLs to the images you want to use for this post. This will override file system searches.</em>
</p>
<table class="widefat">
<?php
  foreach (array(
		'comic' => __('Comic', 'comicpress'),
  	'rss' => __('RSS', 'comicpress'),
  	'archive' => __('Archive', 'comicpress'),
  	'mini' => __('Mini', 'comicpress')
	) as $field => $label) {
		$value = isset($media_info[$field]) ? $media_info[$field] : '';
		?>
		<tr>
			<th scope="row"><?php echo esc_html($label) ?> URL</th>
			<td>
			  <input type="text" style="width:100%" name="cp[urls][<?php echo esc_attr($field) ?>]" value="<?php echo esc_attr($value) ?>" />
			</td>
		</tr>
  <?php }
?>
</table>
