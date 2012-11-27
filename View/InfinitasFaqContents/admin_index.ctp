<?php
    /**
     * Blog Comments admin index
     *
     * this is the page for admins to view all the posts on the site.
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
     * @subpackage    blog.views.posts.admin_index
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */
    echo $this->Form->create(null, array('action' => 'mass'));
	echo $this->Infinitas->adminIndexHead($filterOptions, array(
		'add',
		'edit',
		'preview',
		'toggle',
		'copy',
		'move',
		'delete'
	));
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			$this->Form->checkbox('all') => array(
				'class' => 'first'
			),
			$this->Paginator->sort('title'),
			$this->Paginator->sort('Category.name', __d('infinitas_faq', 'Category')) => array(
				'class' => 'large'
			),
			__('Tags'),
			$this->Paginator->sort('comment_count', __d('infinitas_faq', 'Comments')) => array(
				'class' => 'small'
			),
			$this->Paginator->sort('views') => array(
				'class' => 'small'
			),
			__d('infinitas_faq', 'Status') => array(
				'class' => 'actions'
			)
		));

		foreach($infinitasFaqContents as $infinitasFaqContent) { ?>
			<tr>
				<td><?php echo $this->Form->checkbox($infinitasFaqContent['InfinitasFaqContent']['id']); ?>&nbsp;</td>
				<td>
					<?php
						echo $this->Html->link($infinitasFaqContent['InfinitasFaqContent']['title'], array('action' => 'edit', $infinitasFaqContent['InfinitasFaqContent']['id']));
						echo $this->Html->adminPreview($infinitasFaqContent['InfinitasFaqContent']);
					?>&nbsp;
				</td>
				<td>
					<?php
						if(!empty($infinitasFaqContent['GlobalCategory']['title'])) {
							echo $this->Html->link($infinitasFaqContent['GlobalCategory']['title'], array(
								'plugin' => 'contents',
								'controller' => 'global_categories',
								'action' => 'edit',
								$infinitasFaqContent['GlobalCategory']['id']
							));
						}
					?>&nbsp;
				</td>
				<td><?php echo $this->TagCloud->tagList($infinitasFaqContent); ?>&nbsp;</td>
				<td><?php echo $this->Design->count($infinitasFaqContent['InfinitasFaqContent']['comment_count']); ?>&nbsp;</td>
				<td><?php echo $this->Design->count($infinitasFaqContent['InfinitasFaqContent']['views']); ?>&nbsp;</td>
				<td>
					<?php
						echo $this->Infinitas->status($infinitasFaqContent['InfinitasFaqContent']['active'], $infinitasFaqContent['InfinitasFaqContent']['id']),
							$this->Locked->display($infinitasFaqContent);
					?>
				</td>
			</tr> <?php
		}
	?>
</table>
<?php
	echo $this->Form->end();
	echo $this->element('pagination/admin/navigation');