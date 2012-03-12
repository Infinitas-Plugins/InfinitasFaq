<?php
    /**
     * Blog Comments admin edit posts
     *
     * this is the page for admins to edit blog posts
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
     * @subpackage    blog.views.posts.admin_edit
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */

    echo $this->Form->create(null, array('type' => 'file'));
        echo $this->Infinitas->adminEditHead();

		$tabs = array(
			__d('contents', 'Content'),
			__d('contents', 'Author'),
			__d('blog', 'Other Data')
		);

		$content = array(
			$this->element('Contents.content_form', array('intro' => false)),
			$this->element('Contents.author_form'),
			implode('', array(
				$this->Form->input('id'),
				$this->Form->input('active'),
				$this->Form->hidden('ContentConfig.id'),
				$this->element('Contents.meta_form')))
		);

		echo $this->Design->tabs($tabs, $content);
    echo $this->Form->end();