	</div>
</div>
<?php if (is_cp_theme_layout('3c2r')) {
	get_sidebar('left');
} ?>

<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v,3c2r')) { 
	get_sidebar('right'); ?>
<?php } ?>

<?php if (is_cp_theme_layout('3c,standard,3c2r')) {  ?>
			<div class="clear"></div>
		</div>
		<div id="subcontent-wrapper-foot"></div>
<?php } ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		</div>
	<?php } ?>	
	<?php if (is_cp_theme_layout('rgn')) get_sidebar('right'); ?>
	<div class="clear"></div>
</div>
<div id="content-wrapper-foot"></div>
