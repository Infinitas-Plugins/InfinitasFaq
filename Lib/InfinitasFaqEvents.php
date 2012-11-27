<?php
class InfinitasFaqEvents extends AppEvents {
	public function onPluginRollCall(Event $Event) {
		return array(
			'name' => 'FAQ',
			'description' => 'FAQ plugin',
			'icon' => '/infinitas_faq/img/icon.png',
			'author' => 'Infinitas',
			'dashboard' => array(
				'plugin' => 'infinitas_faq',
				'controller' => 'infinitas_faq_contents',
				'action' => 'index'
			)
		);
	}

	public function onAdminMenu(Event $Event) {
		$menu = array(
			'filter' => array(
				'Active' => array('InfinitasFaq.status' => 1)
			)
		);

		return $menu;
	}

	public function onRequireCssToLoad(Event $Event, $data = null) {
		return array(
			'InfinitasFaq.infinitas_faq'
		);
	}

	public function onRequireJavascriptToLoad(Event $Event, $data = null) {
		return array(
			'InfinitasFaq.infinitas_faq'
		);
	}
}