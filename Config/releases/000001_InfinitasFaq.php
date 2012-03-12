<?php
	/**
	 * Infinitas Releas
	 *
	 * Auto generated database update
	 */
	 
	class R4f5d4e00f60c4fb383ef36d86318cd70 extends CakeRelease {

	/**
	* Migration description
	*
	* @var string
	* @access public
	*/
		public $description = 'Migration for InfinitasFaq version 0.1';

	/**
	* Plugin name
	*
	* @var string
	* @access public
	*/
		public $plugin = 'InfinitasFaq';

	/**
	* Actions to be performed
	*
	* @var array $migration
	* @access public
	*/
		public $migration = array(
			'up' => array(
			'create_table' => array(
				'infinitas_faq_contents' => array(
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
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'active' => array('column' => 'active', 'unique' => 0),
						'most_views' => array('column' => array('views', 'id'), 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'infinitas_faq_contents'
			),
		),
		);

	
	/**
	* Before migration callback
	*
	* @param string $direction, up or down direction of migration process
	* @return boolean Should process continue
	* @access public
	*/
		public function before($direction) {
			return true;
		}

	/**
	* After migration callback
	*
	* @param string $direction, up or down direction of migration process
	* @return boolean Should process continue
	* @access public
	*/
		public function after($direction) {
			return true;
		}
	}