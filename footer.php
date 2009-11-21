<div id="footer">
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
		<div class="footerpwad">
			<center>
			<?php the_project_wonderful_ad('footer'); ?>
			</center>
		</div>
	<?php } ?>
	<?php get_sidebar('footer'); ?>
	<?php global $disable_footer_text, $wpmu_version; if ($disable_footer_text != 'yes') { ?>
		<p>
			<span class="footer-copyright">
				<?php echo comicpress_copyright(); ?>
				<?php if (empty($wpmu_version)) {
					$authorfirstname = get_the_author_meta('firstname',1);
					$authorlastname = get_the_author_meta('lastname',1);
					$blogname = get_bloginfo('title');
					if ( $authorfirstname != "" ) {
						echo $authorfirstname."	".$authorlastname;
					} else {
						echo $blogname;
					}
				} ?>
			</span>
			<span class="footer-powered">
				<span class="footer-pipe">|</span>
				<?php _e('Powered by','comicpress'); ?> <a href="http://wordpress.org/">WordPress</a> <?php _e('with','comicpress'); ?> <a href="http://comicpress.org/">ComicPress</a>
			</span>
			<span class="footer-subscribe">
				<span class="footer-pipe">|</span>
				Subscribe: <a href="<?php bloginfo('rss2_url') ?>">RSS</a>
			</span>
			<span class="footer-uptotop">
				<span class="footer-pipe">|</span>
				<a href="#outside" onclick="scrollup(); return false;"><?php _e('Back to Top &uarr;','comicpress'); ?></a>
			</span>
			<!-- <?php echo get_num_queries() ?> queries. <?php timer_stop(1) ?> seconds. -->
		</p>
	<?php } ?>
</div>
 
<?php global $disable_page_restraints; if ($disable_page_restraints == 'no') { ?>
	</div><!-- Ends "page/page-wide" -->
</div><!-- Ends "page-wrap" -->
<?php } ?>
<div id="page-foot"></div>

<?php wp_footer() ?>
</body>
</html>