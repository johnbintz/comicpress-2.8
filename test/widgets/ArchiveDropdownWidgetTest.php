<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/ArchiveDropdownWidget.inc');

class ArchiveDropdownWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();

		$this->w = new ArchiveDropdownWidget();
	}

	function providerTestBuildDropdown() {
		return array(
			array(null, 'Archives...', null, 'Go'),
			array('Test', 'Test', 'Test2', 'Test2'),
		);
	}

	/**
	 * @dataProvider providerTestBuildDropdown
	 */
  function testBuildDropdown($default_value, $expected_default, $button_value, $expected_button) {
  	if (!is_null($default_value)) {
  		_set_filter_expectation('comicpress_archive_dropdown_default_entry', $default_value);
  	}

   	if (!is_null($button_value)) {
  		_set_filter_expectation('comicpress_archive_dropdown_submit_button', $button_value);
  	}

  	foreach (array(
  		array('test' => 'Test',	'test2' => 'Test2'),
  		'<option value="test">Test</option><option value="test2">Test2</option>'
  	) as $entries) {
	  	$html = $this->w->build_dropdown($entries);

	  	foreach (array(
	  		array('tag' => 'div', 'attributes' => array('class' => 'archive-dropdown-wrap')),
	  		array('tag' => 'form', 'attributes' => array('action' => '', 'method' => 'get')),
	  		array('tag' => 'select', 'attributes' => array('name' => 'cp[urls]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[_nonce]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[_action_nonce]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[action]', 'value' => 'follow-archive-dropdown')),
	  		array('tag' => 'option', 'attributes' => array('value' => ''), 'content' => $expected_default),
	  		array('tag' => 'input', 'attributes' => array('type' => 'submit', 'value' => $expected_button)),
	  		array('tag' => 'option', 'attributes' => array('value' => 'test'), 'content' => 'Test'),
	  		array('tag' => 'option', 'attributes' => array('value' => 'test2'), 'content' => 'Test2'),
	  	) as $matcher) {
	  		$this->assertTag($matcher, $html);
	  	}
  	}
  }

  function testBuildDropdownNotStringOrArray() {
  	$html = $this->w->build_dropdown(false);

  	$this->assertTrue(empty($html));
  }

  function testBuildComicArchiveDropdown() {
  	$w = $this->getMock('ArchiveDropdownWidget', array('_new_comicpressstoryline', '_new_wp_query', 'build_dropdown'));

  	$storyline = $this->getMock('ComicPressStoryline', array('read_from_options', 'build_from_restrictions'));
  	$storyline->expects($this->once())->method('read_from_options');
  	$storyline->expects($this->once())->method('build_from_restrictions')->will($this->returnValue(array(1,2,3)));

  	$w->expects($this->once())->method('_new_comicpressstoryline')->will($this->returnValue($storyline));

  	$query = $this->getMock('WP_Query', array('query', 'has_posts', 'next_post'));
  	$query->expects($this->once())->method('query')->with(array(
  		'showposts' => -1,
  		'category__in' => array(1,2,3)
  	));

  	wp_insert_post((object)array('ID' => 1, 'guid' => 'guid', 'post_title' => 'title'));

  	$query->expects($this->at(1))->method('has_posts')->will($this->returnValue(true));
  	$query->expects($this->at(2))->method('next_post')->will($this->returnValue((object)array('ID' => 1, 'guid' => 'guid', 'post_title' => 'title')));
  	$query->expects($this->at(3))->method('has_posts')->will($this->returnValue(false));

  	$w->expects($this->once())->method('_new_wp_query')->will($this->returnValue($query));

  	$w->expects($this->once())->method('build_dropdown')->with(array('guid' => 'title'));

  	$w->build_comic_archive_dropdown();
  }

  function providerTestUpdate() {
  	$w = new ArchiveDropdownWidget();
  	$valid_mode = array_shift(array_keys($w->modes));

  	return array(
  		array(array(), array()),
  		array(
  			array('title' => '<b>test</b>'),
  			array('title' => 'test'),
  		),
  		array(
  			array('mode' => 'bad'),
  			array()
  		),
  		array(
  			array('mode' => $valid_mode),
  			array('mode' => $valid_mode)
  		)
  	);
  }

  /**
   * @dataProvider providerTestUpdate
   */
  function testUpdate($input, $expected_output) {
  	$this->assertEquals($expected_output, $this->w->update($input, array()));
  }
}