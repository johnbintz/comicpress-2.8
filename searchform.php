<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
		<input type="text" value="Search Site..." name="s" id="s-search" onfocus="this.value=(this.value=='Search Site...') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Search Site...' : this.value;" />
		<button type="submit" class="button">&#9658;</button>
	</div>
</form>