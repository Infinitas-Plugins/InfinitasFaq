<?php
    /**
     * Blog index view file.
     *
     * Generate the index page for the blog posts
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       blog
     * @subpackage    InfinitasFaq.views.index
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */
	
    foreach($infinitasFaqContents as $k => &$infinitasFaqContent) {
		$eventData = $this->Event->trigger('infinitasFaqBeforeContentRender', array('_this' => $this, 'data' => $infinitasFaqContent));
		$infinitasFaqContent['InfinitasFaqContent']['events_before'] = '';
		foreach((array)$eventData['infinitasFaqBeforeContentRender'] as $_plugin => $_data) {
			$infinitasFaqContent['InfinitasFaqContent']['events_before'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
		}

		$eventData = $this->Event->trigger('infinitasFaqAfterContentRender', array('_this' => $this, 'data' => $infinitasFaqContent));
		$infinitasFaqContent['InfinitasFaqContent']['events_after'] = '';
		foreach((array)$eventData['infinitasFaqAfterContentRender'] as $_plugin => $_data) {
			$infinitasFaqContent['InfinitasFaqContent']['events_after'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
		}

		$eventData = $this->Event->trigger('InfinitasFaq.slugUrl', array('type' => 'posts', 'data' => $infinitasFaqContent));
		$url = InfinitasRouter::url(current($eventData['slugUrl']), true);
		$infinitasFaqContent['InfinitasFaqContent']['title_link'] = $this->Html->link($infinitasFaqContent['InfinitasFaqContent']['title'], $url);
		$infinitasFaqContent['InfinitasFaqContent']['url'] = $url;

		$infinitasFaqContent['InfinitasFaqContent']['created'] = CakeTime::format(Configure::read('InfinitasFaq.time_format'), $infinitasFaqContent['InfinitasFaqContent']['created']);
		$infinitasFaqContent['InfinitasFaqContent']['modified'] = CakeTime::format(Configure::read('InfinitasFaq.time_format'), $infinitasFaqContent['InfinitasFaqContent']['modified']);

		$infinitasFaqContent['InfinitasFaqContent']['module_tags_list'] = $this->TagCloud->tagList($infinitasFaqContent, ',');
		$infinitasFaqContent['InfinitasFaqContent']['module_tags'] = $this->ModuleLoader->loadDirect(
			'InfinitasFaq.post_tag_cloud',
			array(
				'tags' => $infinitasFaqContent['GlobalTagged'],
				'title' => 'Tags'
			)
		);

		$infinitasFaqContent['InfinitasFaqContent']['module_comment_count'] = sprintf(__d('comments', '%d Comments'), $infinitasFaqContent['InfinitasFaqContent']['comment_count']);
    }
	
	if(count($infinitasFaqContents) > 0) {
		$this->set('infinitasFaqContents', $infinitasFaqContents);
		$this->set('paginationNavigation', $this->element('pagination/navigation'));
	}

	if(empty($globalLayoutTemplate)) {
		throw new Exception('Template was not loaded, make sure one exists');
	}
	
	
	$faqTags = ClassRegistry::init('Contents.GlobalTagged')->find(
		'cloud',
		array(
			'limit' => 50,
			'model' => $this->plugin . '.InfinitasFaqContent'
		)
	);
	$this->set('faqTags', $faqTags);
	
	echo $this->GlobalContents->renderTemplate($globalLayoutTemplate);