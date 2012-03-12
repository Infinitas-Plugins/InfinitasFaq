<?php
	class InfinitasFaqContent extends InfinitasFaqAppModel {
		public $lockable = true;
		
		public $contentable = true;

		public $actsAs = array(
			'Feed.Feedable',
			'Contents.Taggable'
		);
		
		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'title' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter the frequently asked question')
					)
				),
				'body' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter the answer to the frequently asked question')
					)
				)
			);
		}
	}
