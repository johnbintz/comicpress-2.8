<div id="comicpress-config">

	<form method="post" id="myForm-config" enctype="multipart/form-data" action="">
	<?php wp_nonce_field('update-options') ?>

		<div class="comicpress-options">

			<table class="widefat">

				<thead>
					<tr>
						<th colspan="5"><?php _e('Configuration','comicpress'); ?></th>
					</tr>
				</thead>

				<tr class="alternate">
					<th scope="row">
						<label for="comiccat"><?php _e('Comic Category','comicpress'); ?></label>
						<?php
							$comiccat = $comicpress_options['comicpress_config']['comiccat'];
							$select = wp_dropdown_categories('show_option_all=Select category&hide_empty=0&show_count=0&orderby=name&echo=0&selected='.$comiccat);
							$select = preg_replace('#<select([^>]*)>#', '<select name="comiccat" id="comicccat">', $select);
							echo $select;
						?>
					</th>
					<td>
						<?php _e('The category that is designated for the primary comic category.','comicpress'); ?>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="comiccat"><?php _e('Blog Category','comicpress'); ?></label>
						<?php
							$blogcat = $comicpress_options['comicpress_config']['blogcat'];
							$select = wp_dropdown_categories('show_option_all=Select category&hide_empty=0&show_count=0&orderby=name&echo=0&selected='.$blogcat);
							$select = preg_replace('#<select([^>]*)>#', '<select name="blogcat" id="blogcat">', $select);
							echo $select;
						?>
					</th>
					<td>
						<?php _e('The primary blog category.','comicpress'); ?>
					</td>
				</tr>

				<?php
					$dirs_to_search = array_unique(array(ABSPATH));
					$directories = array();
					foreach ($dirs_to_search as $dir) { $directories = array_merge($directories,glob("${dir}/*")); }

					$current_directory = $comicpress_options['comicpress_config']['comic_folder'];
				?>
				<tr class="alternate">
					<th scope="row"><label for="comic_folder"><?php _e('Comic Folder','comicpress'); ?></label>

							<select name="comic_folder" id="comic_folder">
								<?php
									foreach ($directories as $dirs) {
										if (is_dir($dirs)) {
											$dir_name = basename($dirs); ?>
											<option class="level-0" value="<?php echo $dir_name; ?>" <?php if ($current_directory == $dir_name) { ?>selected="selected"<?php } ?>><?php echo $dir_name; ?></option>
									<?php }
									}
								?>
							</select>

					</th>
					<td>
						<?php _e('Choose a directory to get the original sized comics from.','comicpress'); ?>
					</td>
				</tr>

				<?php
					$current_directory = $comicpress_options['comicpress_config']['rss_comic_folder'];
				?>
				<tr>
					<th scope="row"><label for="rss_comic_folder"><?php _e('RSS Thumbnail Folder','comicpress'); ?></label>

							<select name="rss_comic_folder" id="rss_comic_folder">
								<?php
									foreach ($directories as $dirs) {
										if (is_dir($dirs)) {
											$dir_name = basename($dirs); ?>
											<option class="level-0" value="<?php echo $dir_name; ?>" <?php if ($current_directory == $dir_name) { ?>selected="selected"<?php } ?>><?php echo $dir_name; ?></option>
									<?php }
									}
								?>
							</select>

					</th>
					<td>
						<?php _e('Choose a directory to get the RSS thumbnails from.','comicpress'); ?>
					</td>
				</tr>

				<?php
					$current_directory = $comicpress_options['comicpress_config']['archive_comic_folder'];
				?>
				<tr class="alternate">
					<th scope="row"><label for="archive_comic_folder"><?php _e('Archive Thumbnail Folder','comicpress'); ?></label>

							<select name="archive_comic_folder" id="archive_comic_folder">
								<?php
									foreach ($directories as $dirs) {
										if (is_dir($dirs)) {
											$dir_name = basename($dirs); ?>
											<option class="level-0" value="<?php echo $dir_name; ?>" <?php if ($current_directory == $dir_name) { ?>selected="selected"<?php } ?>><?php echo $dir_name; ?></option>
									<?php }
									}
								?>
							</select>

					</th>
					<td>
						<?php _e('Choose a directory to get the Archive/Search thumbnails from.','comicpress'); ?>
					</td>
				</tr>

				<?php
					$current_directory = $comicpress_options['comicpress_config']['mini_comic_folder'];
				?>
				<tr>
					<th scope="row"><label for="mini_comic_folder"><?php _e('Mini Thumbnail Folder','comicpress'); ?></label>

							<select name="mini_comic_folder" id="mini_comic_folder">
								<?php
									foreach ($directories as $dirs) {
										if (is_dir($dirs)) {
											$dir_name = basename($dirs); ?>
											<option class="level-0" value="<?php echo $dir_name; ?>" <?php if ($current_directory == $dir_name) { ?>selected="selected"<?php } ?>><?php echo $dir_name; ?></option>
									<?php }
									}
								?>
							</select>

					</th>
					<td>
						<?php _e('Choose a directory to get the Mini thumbnails from. (for archive-comic-list, etc.)','comicpress'); ?>
					</td>
				</tr>

				<tr class="alternate">
					<th scope="row"><label for="rss_comic_width"><?php _e('RSS Thumbnail Width','comicpress'); ?></label></th>
					<td colspan="2">
						<input type="text" size="7" name="rss_comic_width" id="rss_comic_width" value="<?php echo $comicpress_options['comicpress_config']['rss_comic_width']; ?>" />
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="archive_comic_width"><?php _e('Archive Thumbnail Width','comicpress'); ?></label></th>
					<td colspan="2">
						<input type="text" size="7" name="archive_comic_width" id="archive_comic_width" value="<?php echo $comicpress_options['comicpress_config']['archive_comic_width']; ?>" />
					</td>
				</tr>

				<tr class="alternate">
					<th scope="row"><label for="mini_comic_width"><?php _e('Mini Thumbnail Width','comicpress'); ?></label></th>
					<td colspan="2">
						<input type="text" size="7" name="mini_comic_width" id="mini_comic_width" value="<?php echo $comicpress_options['comicpress_config']['mini_comic_width']; ?>" />
					</td>
				</tr>

				<?php
					$cpmh = new ComicPressMediaHandling();

					$filters = $comicpress_options['comic_filename_filters'];
					if (!isset($filters['default'])) {
						$filters['default'] = $cpmh->default_filter;
					}
				?>

				<tr>
					<th scope="row"><label><?php _e('Comic Filename Filters', 'comicpress'); ?></label></th>
					<td colspan="2">
						<p>
							<em>For advanced users.</em> Specify the filters used to find the filename.
						</p>
						<div id="comicpress-comic-filename-filters-holder">
						</div>
						<a href="#" id="add-new-filter"><?php _e('Add new filter', 'comicpress') ?></a>
						<script type="text/javascript">
							(function($) {
								var filter_data = [];
								<?php foreach ($filters as $name => $filter) { ?>
									filter_data.push({name:'<?php echo esc_js($name) ?>', filter:'<?php echo esc_js($filter) ?>'});
								<?php } ?>

								var build_row = function(data) {
									var key = (new Date()).getTime();
									var row = $('<div>\
										          <label>\
										            <strong>Key:</strong>\
										            <input type="text" size="15" name="comic_filename_filters[' + key + '][name]" value="' + data.name + '" />\
										          </label>\
										          <label>\
										          	<strong>Filter:</strong>\
										          	<input type="text" size="60" name="comic_filename_filters[' + key + '][name]" value="' + data.filter + '" />\
										          </label>\
										          <a href="#">Remove</a>\
											      </div>');
									$('a', row).click(function() {
										if (confirm('<?php _e('Are you sure?', 'comicpress') ?>')) {
											$(this).parent().remove();
										}
										return false;
									});

									return row;
								};

								$('#add-new-filter').click(function() {
									$('#comicpress-comic-filename-filters-holder').append(build_row({name:'new_filter',filter:'%wordpress%'}));
									return false;
								});

								$.each(filter_data, function(index, f) {
									$('#comicpress-comic-filename-filters-holder').append(build_row(f));
								});
							}(jQuery))
						</script>
						<p>
							Available parameters:
						</p>
						<ul>
							<li><strong>%wordpress%</strong>: The WordPress root folder</li>
							<li><strong>%type-folder%</strong>: The folder for the requested filetype (comic, rss, archive, or mini)</li>
							<li><strong>%date-(format)%</strong>: The formatting to use for the requested date as per the <a href="http://php.net/date">date()</a> function <em>(ex: %date-Ymd% is <?php echo date('Ymd') ?>)</em></li>
							<li><strong>%upload-path%</strong>: The value of the upload_path option, which is the destination upload directory for WPMU installs.</li>
						</ul>
					</td>
				</tr>

			</table>

		</div>

		<div class="comicpress-options-save">
			<div class="comicpress-major-publishing-actions">
				<div class="comicpress-publishing-action">
					<input name="comicpress_save_config" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="comicpress_save_config" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
