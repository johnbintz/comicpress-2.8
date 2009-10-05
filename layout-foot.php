<?php if (is_cp_theme_layout('v')) { ?>
	</div>	
<?php } ?>

<?php 
if (is_cp_theme_layout('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

<?php if (is_cp_theme_layout('3c,standard')) {  ?>
			<div class="clear"></div>
		</div>
		<div id="subcontent-wrapper-bottom"></div>
<?php } ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		</div>
	<?php } ?>	
	<?php if (is_cp_theme_layout('rgn')) get_sidebar('right'); ?>
	
	<div class="clear"></div>
<div id="content-wrapper-bottom"></div>
