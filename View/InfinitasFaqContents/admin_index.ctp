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
        $massActions = $this->Infinitas->massActionButtons(
            array(
                'add',
                'edit',
                'preview',
                'toggle',
                'copy',
                'move',
                'delete'
            )
        );
	echo $this->Infinitas->adminIndexHead($filterOptions, $massActions);
?>
<div class="table">
    <table class="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Infinitas->adminTableHeader(
                array(
                    $this->Form->checkbox('all') => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $this->Paginator->sort('title'),
                    $this->Paginator->sort('Category.name', __d('blog', 'Category')) => array(
                        'style' => 'width:130px;'
                    ),
                    __('Tags'),
                    $this->Paginator->sort('comment_count', __d('blog', 'Comments')) => array(
                        'style' => 'width:50px;'
                    ),
                    $this->Paginator->sort('views') => array(
                        'style' => 'width:30px;'
                    ),
                    __d('blog', 'Status') => array(
                        'class' => 'actions'
                    )
                )
            );

            foreach($infinitasFaqContents as $infinitasFaqContent) {
                ?>
                    <tr class="<?php echo $this->Infinitas->rowClass(); ?>">
                        <td><?php echo $this->Form->checkbox($infinitasFaqContent['InfinitasFaqContent']['id']); ?>&nbsp;</td>
                        <td title="<?php echo $infinitasFaqContent['InfinitasFaqContent']['slug']; ?>">
                            <?php
								echo $this->Html->link($infinitasFaqContent['InfinitasFaqContent']['title'], array('action' => 'edit', $infinitasFaqContent['InfinitasFaqContent']['id']));
								echo $this->Html->adminPreview($infinitasFaqContent['InfinitasFaqContent']);
							?>
                        </td>
                        <td>
							<?php
								if(isset($infinitasFaqContent['GlobalCategory']['title'])) {
									echo $this->Html->link(
										$infinitasFaqContent['GlobalCategory']['title'],
										array(
											'plugin' => 'contents',
											'controller' => 'global_categories',
											'action' => 'edit',
											$infinitasFaqContent['GlobalCategory']['id']
										)
									);
								}
                        	?>
						</td>
                        <td><?php echo $this->TagCloud->tagList($infinitasFaqContent); ?>&nbsp;</td>
                        <td><?php echo $infinitasFaqContent['InfinitasFaqContent']['comment_count']; ?>&nbsp;</td>
                        <td><?php echo $infinitasFaqContent['InfinitasFaqContent']['views']; ?>&nbsp;</td>
                        <td>
                            <?php
                                echo $this->Infinitas->status($infinitasFaqContent['InfinitasFaqContent']['active'], $infinitasFaqContent['InfinitasFaqContent']['id']),
                                    $this->Locked->display($infinitasFaqContent);
                            ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>