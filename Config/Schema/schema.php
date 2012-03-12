<?php
class InfinitasFaqSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $infinitas_faq_contents = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'comment_count' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'views' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'rating' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'rating_count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'ordering_id' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'active' => array('column' => 'active', 'unique' => 0), 'most_views' => array('column' => array('views', 'id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}
