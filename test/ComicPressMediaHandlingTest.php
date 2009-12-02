<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once('vfsStream/vfsStream.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressMediaHandling.inc');

class ComicPressMediaHandlingTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->cpmh = new ComicPressMediaHandling();
	}

	function testBundleGlobalVariables() {
		global $comic_folder, $archive_comic_folder, $rss_comic_folder, $mini_comic_folder;

		$comic_folder = 'comic';
		$archive_comic_folder = 'archive';
		$rss_comic_folder = 'rss';
		$mini_comic_folder = 'mini';

		$this->assertEquals(array(
			'comic'   => 'comic',
			'archive' => 'archive',
			'rss'     => 'rss',
			'mini'    => 'mini'
		), $this->cpmh->_bundle_global_variables());
	}

	function providerTestGetFilter() {
		return array(
			array(null, '%wordpress%/%type-folder%/%date-Y-m-d%*.*'),
			array('fail', '%wordpress%/%type-folder%/%date-Y-m-d%*.*'),
			array(array(), '%wordpress%/%type-folder%/%date-Y-m-d%*.*'),
			array('test', 'test')
		);
	}

	/**
	 * @dataProvider providerTestGetFilter
	 */
	function testGetFilter($filter_to_use, $expected_result) {
		global $comic_filename_filters;

		$comic_filename_filters['test'] = 'test';

		$this->assertEquals($expected_result, $this->cpmh->_get_filter($filter_to_use));
	}
}
