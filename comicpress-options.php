<?php

include(get_template_directory() . '/comicpress-options-config.php');

function comicpress_options() {
	$pagehook = add_submenu_page('themes.php','comicpress', 'ComicPress Options', 10, 'comicpress-options', 'comicpress_admin');
	add_action('admin_head-'.$pagehook, 'comicpress_admin_page_head');
}

function comicpress_admin_page_head() { ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/tabbed/tabbed_pages.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/tabbed/tabbed_pages.js"></script>
<?php }


function comicpress_admin() {
	global $options, $upload_path, $blogcat, $moods_directory;
	

	?>
	<div class="wrap">
	<h2 class="alignleft">ComicPress Options</h2>
	 
	<a class="alignright" style="margin: 20px;" href="http://comicpress.org/"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/options/comicpress_logo.png" alt="ComicPress" /></a>


	<br clear="all" />		

	<?php 
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {
		
		if ('comicpress_save'== $_REQUEST['action']) {
			foreach ($options as $value) {
			if( !isset( $_REQUEST[ $value['id'] ] ) ) {  } else { update_option( $value['id'], stripslashes($_REQUEST[ $value['id']])); } } ?>
			<div class="updated fade"><p><strong>Options/Settings SAVED!</strong></p></div>
		<?php }
		
		if ('comicpress_reset' == $_REQUEST['action'] ) {
			foreach ($options as $default) {
				delete_option($default['id'],$default['default']);
			} ?>
			<div class="updated fade"><p><strong>Options/Settings RESET!</strong></p></div>
		<?php
		}
	}
	
	// set default options
	foreach ($options as $default) {
		if(get_option($default['id'])=="") {
			update_option($default['id'],$default['default']);
		}
	}

	include(get_template_directory() . '/comicpress-config.php');		
	
	?>
	<div id="poststuff" class="metabox-holder">
	<script language="javascript">
		function showimage(sel,pic)
		{
		if (!document.images) 
		return
		document.getElementById(pic).src = '<?php echo get_bloginfo('stylesheet_directory'); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
		}
	</script>

<div id="cpadmin">
<div class="on" title="themestyle"><span>Theme Style</span></div>
<div class="off" title="generaloptions"><span>General Settings</span></div>
<div class="off" title="indexoptions"><span>Index Page</span></div>
<div class="off" title="postoptions"><span>Post Options</span></div>
<div class="off" title="customheader"><span>Custom Header</span></div>
<div class="off" title="buyprintoptions"><span>Buy Print</span></div>

</div>

	<div id="themestyle" class="show">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-cp_theme_style": ?>
				<tr>
					<th scope="row"><strong>Choose which theme style you want to use.</strong><br /><br />This is the style in which your theme will be presented.<br /><br /></th>
					<td valign="top">
						<label>
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="code" onchange="showimage(this,'cpthemestyle')">
								<option class="level-0" value="standard" <?php if (get_option($value['id'])=='standard') {?>selected="selected" <?php } ?>>Standard</option>
								<option class="level-0" value="3c" <?php if (get_option($value['id'])=='3c') {?>selected="selected" <?php } ?>>3C</option>
								<option class="level-0" value="gn" <?php if (get_option($value['id'])=='gn') {?>selected="selected" <?php } ?>>GN</option>
								<option class="level-0" value="v" <?php if (get_option($value['id'])=='v') {?>selected="selected" <?php } ?>>V</option>
								<option class="level-0" value="v3c" <?php if (get_option($value['id'])=='v3c') {?>selected="selected" <?php } ?>>V3C</option>
							</select>
						</label>
					</td>
					<td valign="top">
						<img id="cpthemestyle" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/options/<?php echo get_option($value['id']); ?>.png" alt="ComicPress Theme Style" />
					</td>
					<td valign="bottom" colspan="2">
            <p><em>(Check the vaildity of your theme's HTML &amp; CSS using the links below. Stock ComicPress is XHTML 1.0 and CSS 2 compliant.)</em></p>
						<a href="http://validator.w3.org/check?uri=referer"><img
							src="http://www.w3.org/Icons/valid-xhtml10"
							alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
						<a href="http://jigsaw.w3.org/css-validator/check/referer">
							<img style="border:0;width:88px;height:31px"
								src="http://jigsaw.w3.org/css-validator/images/vcss"
								alt="Valid CSS!" />
						</a>
					</td>
				</tr>
				
				<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Style" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>

	<div id="generaloptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {

			case "comicpress-disable_extended_comments": ?>
				<tr>
				<th scope="row"><strong>Disable Extra Comment Code?</strong><br /><br />Set to &quot;Yes&quot; and the extended comment code will be disabled.</th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				</tr>
				
				<?php break;				
			case "comicpress-contact_in_menubar": ?>
				<tr>
				<th scope="row"><strong>Contact Link in Menubar</strong><br /><br />Setting to &quot;Yes&quot will put [&nbsp;CONTACT&nbsp;] in the menubar and associate it with your admin's email.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
				You can also create a links category called "menulinks" and whatever link you add to that will appear in the menubar.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_widgetarea_use_sidebar_css": ?>
				<tr>
				<th scope="row"><strong>Enable Sidebar CSS?</strong><br /><br />Enabling this will use the standard CSS styling of the sidebars for all the widget areas.<br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
					If not enabled it will use the .customwidgetarea user made styling only and only the Sidebar-left and Sidebar-right will use sidebar styling.<br />
				</td>
				</tr>
				<?php break;
			case "comicpress-enable_numbered_pagination": ?>
				<tr>
				<th scope="row"><strong>Enable numbered pagination?</strong><br /><br />Setting to &quot;Yes&quot; will make the Previous Entries and Next Entries turn into numbered pages to click on.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_page_restraints": ?>
				<tr>
				<th scope="row"><strong>Disable the #page / #page-wide restraints?</strong><br />
				<br />
				Turning this option to Yes will make it so that the divs for #page and #page-wide will not load.<br />
				<br />
				What you can do with this is use the entire *page* for your canvas instead of the 780px/980px that the two elements keep you in.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_dropdown_sidebar": ?>
				<tr>
				<th scope="row"><strong>Enable the Dropbar Widget area?</strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-comic_clicks_next": ?>
				<tr>
				<th scope="row"><strong>Make the comic an Href that goes to next comic?</strong><br /><br />In doing this if someone clicks the comic it will go to the next comic (if possible)<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-anomaly_says": ?>
				<tr>
				<th scope="row"><strong>Request Anomaly to comment?</strong><br /><br />Enabling this option will summon Anomaly to your comic's universe and say what you request Anomaly to say by modifying the "Hovertext" in the comic post.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-disable_css_style_editor": ?>
				<tr>
				<th scope="row"><strong>Disable the styling in ComicPress Companion?</strong><br /><br />This will let you disable the colored, styling CSS editor and be a normal form.<br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				<td valign="top">
				<a href="http://wordpress.org/extend/plugins/comicpress-companion/">ComicPress Companion</a> is a plugin made specifically for ComicPress 2.8 versions.  It allows you to add CSS element changes without editing the original style.css file.
				</td>
				</tr>
				
				<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />
	</form>
	</div>
	</div>
	
	<div id="indexoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-disable_comic_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable Comic On Frontpage?</strong><br /><br />Set to &quot;Yes&quot; and the comic will not display on the index page/front page of your site.</th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				<td valign="top" width="400">
					Note: You can use the Latest Thumbnail widget to display your comic in a sidebar.  Make sure you set the archive-thumbnail size to under 200px.
					Turning this off and using the GN style turns ComicPress into a Blog.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_comic_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable Comic Blog On Frontpage?</strong><br /><br />Set to &quot;Yes&quot; and the blog portion of the comic will not display on the index page/front page of your site.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_blog_frontpage": ?>
				<tr>
				<th scope="row"><strong>Disable Blog On Frontpage?</strong><br /><br />Set to &quot;Yes&quot; and the blog area will not display on the index page/front page of your site.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label><br />
				</td>
				</tr>
				
				<?php break;
			case "comicpress-disable_showing_comic_post_area": ?>
				<tr>
				<th scope="row"><strong>Disable showing the post for the comic?</strong><br /><br />Setting to &quot;Yes&quot; will disable showing the blog post of the comic on the home page and single pages.<br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />	
	</form>
	</div>
	</div>	
	

	<div id="postoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
	<?php
	foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "comicpress-transcript_in_posts": ?>
				<tr>
				<th scope="row"><strong>Show transcript in post area?</strong><br /><br />When enabled, if the comic has a transcript, the transcript will be displayed inside the post for the comic.</th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-moods_directory": 
				$current_directory = get_option($value['id']);
				if (empty($current_directory)) $current_directory = 'default';
					
				$count = count($results = glob(get_template_directory() . '/images/moods/'.$current_directory.'/*'));
				$mood_directories = glob(get_template_directory() . '/images/moods/*');
			?>
				<tr>
				<th scope="row"><strong>Moods Directory</strong><br /><br />Choose a directory to get the post moods from.<br /></th>
				<td valign="top">
						<label>
								<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php
					foreach ($mood_directories as $mood_dirs) {
						if (is_dir($mood_dirs)) { 
							$mood_dir_name = basename($mood_dirs); ?>
							<option class="level-0" value="<?php echo $mood_dir_name; ?>" <?php if ($current_directory == $mood_dir_name) { ?>selected="selected"<?php } ?>><?php echo $mood_dir_name; ?></option>
					<?php }
					}
				?>
							</select>
						</label>
				</td>
				<td valign="top">
					Found: <?php echo $count; ?> moods in the "<?php echo $current_directory; ?>" directory.<br />
					<br />
					Mood directories are found in your theme directory/images/moods/* to create your own custom moods just create a directory
					under images/moods/ and place ONLY image files inside of it.  The name of the image file represents what the mood is.
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_related_comics": ?>
				<tr>
				<th scope="row"><strong>Put Related Comics in comic posts?</strong><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_related_posts": ?>
				<tr>
				<th scope="row"><strong>Put Related Posts in blog posts?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
			case "comicpress-enable_post_calendar": ?>
				<tr>
				<th scope="row"><strong>Add graphic calendar to blog posts?</strong><br /><br />Enabling this option will display a calendar image on your posts.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-enable_post_author_gravatar": ?>
				<tr>
				<th scope="row"><strong>Display a gravatar of the post author on blog posts?</strong><br /><br />Enabling this option will show a gravatar of the post author based on the authors email.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-enable_comic_post_calendar": ?>
				<tr>
				<th scope="row"><strong>Add graphic calendar to comic posts?</strong><br /><br />Enabling this option will display a calendar image on your posts.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;

			case "comicpress-enable_comic_post_author_gravatar": ?>
				<tr>
				<th scope="row"><strong>Display a gravatar of the post author on comic posts?</strong><br /><br />Enabling this option will show a gravatar of the post author based on the authors email.</th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-disable_categories_in_posts": ?>
				<tr>
				<th scope="row"><strong>Disable showing categories in posts?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
				
			case "comicpress-disable_tags_in_posts": ?>
				<tr>
				<th scope="row"><strong>Disable showing tags in posts?</strong><br /><br /></th>
				<td valign="top">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
		}
	}
	?>
	</table>
	<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
	<input type="hidden" name="action" value="comicpress_save" />	
	</form>
	</div>
	</div>	
	
	<div id="customheader" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">
		<?php
		foreach ($options as $value) {
			switch ( $value['type'] ) {
			case "comicpress-enable_custom_image_header": ?>
				<tr>
				<th scope="row"><strong>Enable Custom Image Header panel?</strong><br /><br />Setting to &quot;Yes&quot; will set a new option in your Dashboard -> Appearance menu.<br /></th>
				<td valign="top" width="100">
				<label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> />Yes</label>
				&nbsp;&nbsp;
				<label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> />No</label>
				</td>
				</tr>
				
				<?php break;
				case "comicpress-custom_image_header_height": ?>
					<tr>
					<th scope="row"><b>Header Image Height</b><br /><br />Set the <b>height</b> of the image you want to use in the Custom Image Header panel.</th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-custom_image_header_width": ?>
					<tr>
					<th scope="row"><b>Header Image Width</b><br /><br />Set the <b>width</b> of the image you want to use in the Custom Image Header panel.</th>
					<td valign="top">
					<label>
					<input type="text" size="5" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					</label>
					</td>
					<td valign="top" rowspawn="5">
					The Standard and V styles use <b>760</b> px width, while the 3C, GN and V3C use <b>980</b> px width.  This is configurable in case you set the #page, #page-width widths in the CSS to something different than the default while using the Custom Header panel.
					</td>
					</tr>
					
					<?php break;
			}
		}
		?>
		</table>
		<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
		<input type="hidden" name="action" value="comicpress_save" />
		</form>
		</div>
		</div>
	
	<div id="buyprintoptions" class="hide">
	<div class="inside">
	<form method="post" id="myForm" name="template" enctype="multipart/form-data">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table" style="width: auto">

		<?php
		foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "comicpress-buy_print_email": ?>
					<tr>
					<th scope="row"><b>Paypal Email Address</b><span style="color: #ff0000;">*</span><br /><br />The Email address you registered with Paypal and that your store is associated with.</th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;">* This must be correct, you don't want other people getting your money.</span>
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_url": ?>
					<tr>
					<th scope="row"><b>Url Page of the Template</b><span style="color: #ff0000;">*</span><br /><br />The URL address to which you associated the buy print template.</th>
					<td valign="top">
					<label>
					<input type="text" size="45" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" /><br />
					<span style="color: #ff0000;">* This must be correct, the form needs some place to go.</span><br />
					<b>Examples</b>:<br />
					http://yourdomain.com/?p=233<br />
					http://yourdomain.com/shop/<br />
					/?p=233<br />
					/shop/<br />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_us_amount": ?>
					<tr>
					<th scope="row"><b>Print Cost (US/Canada)</b><br /><br />How much does a print cost for people in the United State and Canada?</th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_us_ship": ?>
					<tr>
					<th scope="row"><b>Shipping Cost (US/Canada)</b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
				
					<?php break;
				case "comicpress-buy_print_int_amount": ?>
					<tr>
					<th scope="row"><b>Print Cost (International)</b><br /><br />How much does a print cost for people *NOT* in the United States and Canda (International)</th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
				case "comicpress-buy_print_int_ship": ?>
					<tr>
					<th scope="row"><b>Shipping Cost (International)</b><br /><br /></th>
					<td valign="top">
					<label>
					<input type="text" size="7" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
					</label>
					</td>
					</tr>
					
					<?php break;
			}
		}
		?>
		</table>
		<input name="comicpress_save" type="submit" class="button-primary" value="Save Settings" />
		<input type="hidden" name="action" value="comicpress_save" />
		</form>
		</div>
		</div>

	<div style="text-align:center;padding: 5px; background: #ddd; -moz-border-radius: 10px;-khtml-border-radius: 10px;-webkit-border-radius: 10px;border-radius: 10px;border: solid 1px #000;">
	<a href="http://comicpress.org/">ComicPress <?php echo comicpress_current_theme_version(); ?></a>, created by <a href="http://mindfaucet.com/">Tyler Martin</a>, with <a href="http://www.coswellproductions.com/">John Bintz</a> and <a href="http://webcomicplanet.com/">Philip M. Hofer</a> (<a href="http://frumph.webcomicplanet.com/">Frumph</a>)<br />
	If you like the ComicPress theme, please donate.  It will help in creating new versions.<br />
					
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal-wrap">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="3142149">
			<input type="submit" border="0" name="submit" alt="" value="Donate" id="paypal">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
  </div>
</div>
<?php 
}

add_action('admin_menu', 'comicpress_options');

?>