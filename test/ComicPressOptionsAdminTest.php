<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../comicpress-options.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressMediaHandling.inc');

class ComicPressOptionsAdminTest extends PHPUnit_Framework_TestCase {
	function providerTestSaveComicFilenameFilters() {
		$cpmh = new ComicPressMediaHandling();

		return array(
			array(
				array(),
				array()
			),
			array(
				array(1 => array(
					'name' => 'test', 'filter' => 'myfilter'
				)),
				array(
					'default' => $cpmh->default_filter,
					'test' => 'myfilter'
				)
			),
			array(
				array(1 => array(
					'name' => 'default', 'filter' => 'test'
				)),
				array(
					'default' => 'test'
				)
			)
		);
	}

	/**
	 * @dataProvider providerTestSaveComicFilenameFilters
	 */
	function testSaveComicFilenameFilters($incoming, $expected) {
		$this->assertEquals($expected, comicpress_save_options_comic_filename_filters($incoming));
	}
}
