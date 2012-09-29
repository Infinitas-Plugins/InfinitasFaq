<?php
App::uses('InfinitasFaqContent', 'InfinitasFaq.Model');

/**
 * InfinitasFaqContent Test Case
 *
 */
class InfinitasFaqContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.infinitas_faq.infinitas_faq_content',
		'plugin.contents.global_content',
		'plugin.contents.global_layout',
		'plugin.contents.global_category',
		'plugin.contents.global_tagged',
		'plugin.contents.global_tag',
		'plugin.themes.theme',
		'plugin.users.group',
		'plugin.users.user',
		'plugin.view_counter.view_counter_view',
		'plugin.comments.infinitas_comment',
		'plugin.comments.infinitas_comment_attribute'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InfinitasFaqContent = ClassRegistry::init('InfinitasFaq.InfinitasFaqContent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InfinitasFaqContent);

		parent::tearDown();
	}

}
