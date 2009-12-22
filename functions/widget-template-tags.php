<?php

/**
 * Render the ComicPress calendar widget.
 */
function comicpress_calendar_embed() {
	$calendar = new CalendarWidget();

	$instance = array();
	foreach (array('before_widget', 'after_widget', 'thumbnail', 'link', 'small', 'medium', 'large') as $field) {
		$instance[$field] = '';
	}

	$calendar->widget($instance, array());
}

/**
 * Render the ComicPress bookmark widget.
 */
function comicpress_comic_bookmark_embed() {
	$bookmark = new BookmarkWidget();
	$bookmark->init();
	$bookmark->widget(array(), array());
}

/**
 * Render the monthly archive dropdown widget
 */
function comicpress_archive_dropdown() {
	$archive = new ComicPressArchiveDropdownWidget();
	$archive->widget(array(), array('mode' => 'monthly_archive'));
}

/**
 * Render the comic archive dropdown widget
 */
function comicpress_archive_dropdown_comics() {
	$archive = new ComicPressArchiveDropdownWidget();
	$archive->widget(array(), array('mode' => 'comic_archive'));
}

/**
 * Render the storyline order dropdown widget
 */
function comicpress_archive_dropdown_storyline() {
	$archive = new ComicPressArchiveDropdownWidget();
	$archive->widget(array(), array('mode' => 'storyline_order'));
}
