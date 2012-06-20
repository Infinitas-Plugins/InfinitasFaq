<?php
    /**
     * Blog Comments view
     *
     * this is the page for users to view blog posts
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
     * @subpackage    blog.views.posts.view
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */

	/**
	 * events for before the output
	 */
	$eventData = $this->Event->trigger('blogBeforeContentRender', array('_this' => $this, 'post' => $post));
	$post['BlogPost']['events_before'] = '';
	foreach((array)$eventData['blogBeforeContentRender'] as $_plugin => $_data) {
		$post['BlogPost']['events_before'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
	}

	/**
	 * events for after the output
	 */
	$eventData = $this->Event->trigger('blogAfterContentRender', array('_this' => $this, 'post' => $post));
	$post['BlogPost']['events_after'] = '';
	foreach((array)$eventData['blogAfterContentRender'] as $_plugin => $_data) {
		$post['BlogPost']['events_after'] .= '<div class="'.$_plugin.'">'.$_data.'</div>';
	}

	$eventData = $this->Event->trigger('Blog.slugUrl', array('type' => 'posts', 'data' => $post));
	$post['BlogPost']['url'] = Router::url(current($eventData['slugUrl']), true);
	$post['BlogPost']['title_link'] = $this->Html->link($post['BlogPost']['title'], $post['BlogPost']['url']);
	
	$post['BlogPost']['created'] = CakeTime::format(Configure::read('Blog.time_format'), $post['BlogPost']['created']);
	$post['BlogPost']['modified'] = CakeTime::format(Configure::read('Blog.time_format'), $post['BlogPost']['modified']);

	$post['BlogPost']['module_tags_list'] = $this->TagCloud->tagList($post, ',');
	$post['BlogPost']['module_tags'] = $this->ModuleLoader->loadDirect(
		'Blog.post_tag_cloud',
		array(
			'tags' => $post['GlobalTagged'],
			'title' => 'Tags'
		)
	);

	$post['BlogPost']['author_link'] = $this->GlobalContents->author($post);
	$post['BlogPost']['module_comment_count'] = $this->Html->link(
		sprintf(__d('comments', '%d Comments'), count($post['BlogPostComment'])),
		'#comments-top'
	);

	$post['BlogPost']['module_comments'] = $this->element(
		'Comments.modules/comment',
		array(
			'content' => $post,
			'modelName' => 'BlogPost',
			'foreign_id' => $post['BlogPost']['id']
		)
	);
	
	// need to overwrite the stuff in the viewVars for mustache
	$this->set('post', $post);
	echo $this->GlobalContents->renderTemplate($post);