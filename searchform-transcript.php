<form method="get" id="searchform-transcript" action="<?php bloginfo('url'); ?>/">
	<div>
		<input type="text" value="Search Transcripts..." name="s" id="s-transcript" onfocus="this.value=(this.value=='Search Transcripts...') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Search Transcripts...' : this.value;" /><input type="hidden" name="key" value="transcript" />
		<button type="submit" class="button">&#9658;</button>
	</div>
</form>