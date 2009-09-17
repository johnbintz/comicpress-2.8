<div id="content-wrapper-top"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>

	<?php if (is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
<?php if (is_cp_theme_layout('3c,v')) {  ?>
<div id="subcontent-wrapper-top"></div>
	<div id="subcontent-wrapper">
<?php } ?>
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>