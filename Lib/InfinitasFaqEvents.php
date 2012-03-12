<?php
	class InfinitasFaqEvents extends AppEvents {
		public function onPluginRollCall() {
			return array(
				'name' => 'FAQ',
				'description' => 'FAQ plugin',
				'icon' => '/infinitas_faq/img/icon.png',
				'author' => 'Infinitas',
				'dashboard' => array(
					'plugin' => 'infinitas_faq',
					'controller' => 'infinitas_faq_contents',
					'action' => 'dashboard'
				)
			);
		}

		public function onAdminMenu($event) {
			$menu['main'] = array(
				'Dashboard' => array('plugin' => 'infinitas_faq', 'controller' => 'infinitas_faq_contents', 'action' => 'dashboard'),
				'FAQ' => array('plugin' => 'infinitas_faq', 'controller' => 'infinitas_faq_contents', 'action' => 'index'),
			);

			return $menu;
		}
		
		public function onRequireCssToLoad($event, $data = null) {
			return array(
				'InfinitasFaq.infinitas_faq'
			);
		}
		
		public function onRequireJavascriptToLoad($event, $data = null) {
			return array(
				'InfinitasFaq.infinitas_faq'
			);
		}
	}