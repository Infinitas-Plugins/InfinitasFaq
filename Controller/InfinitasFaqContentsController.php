<?php
	/**
	 * Infinitas Faq Contents Controller class file.
	 *
	 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @filesource
	 * @copyright Copyright (c) 2012 Carl Sutton ( dogmatic69 )
	 * @link http://infinitas-cms.org
	 * @package InfinitasFaq
	 * @subpackage InfinitasFaq.Controller
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * 
	 * @since 0.9
	 */
	App::uses('InfinitasFaqAppController', 'InfinitasFaq.Controller');
	class InfinitasFaqContentsController extends InfinitasFaqAppController {
		/**
		 * Index for users
		 *
		 * @param string $tag used to find posts with a tag
		 * @param string $year used to find posts in a cetain year
		 * @param string $month used to find posts in a year and month needs year
		 * @return
		 */
		public function index() {
			$this->Session->delete('Pagination.Post');
			$titleForLayout = $slug = $tagData = null;
			$url = array_merge(array('action' => 'index'), $this->request->params['named']);
			
			$conditions = array(
				$this->modelClass . '.active' => 1,
				'or' => array(
					$this->modelClass . '.active' => 1,
					$this->modelClass . '.id IS NULL'
				)
			);
			
			if(isset($this->request->params['tag'])) {
				$tag = $this->request->params['tag'];
				if(empty($titleForLayout)) {
					$titleForLayout = __d('infinitas_faq', 'FAQ');
				}

				$titleForLayout = sprintf(__d('infinitas_faq', '%s related to %s'), $titleForLayout, $tag);
				$tagData = $this->{$this->modelClass}->GlobalTag->getViewData($tag);

				$url['tag'] = $tag;
			}

			$faqIds = array();
			if (!empty($tag)) {
				$tag_id = ClassRegistry::init('Contents.GlobalTag')->find(
					'list',
					array(
						'fields' => array(
							'GlobalTag.id', 'GlobalTag.id'
						),
						'conditions' => array(
							'GlobalTag.name' => $tag
						)
					)
				);

				$faqIds = $this->{$this->modelClass}->GlobalTagged->find(
					'list',
					array(
						'fields' => array(
							'GlobalTagged.foreign_key', 'GlobalTagged.foreign_key'
						),
						'conditions' => array(
							'GlobalTagged.tag_id' => $tag_id
						)
					)
				);
			}

			if(!empty($faqIds)) {
				$conditions['GlobalContent.id'] = $faqIds;
			}

			$this->Paginator->settings = array(
				'fields' => array(
					$this->modelClass . '.id',
					$this->modelClass . '.comment_count',
					$this->modelClass . '.views',
					$this->modelClass . '.created',
					$this->modelClass . '.ordering',
				),
				'conditions' => $conditions,
				'limit' => Configure::read('InfinitasFaq.pagination_limit')
			);
			
			$this->set('infinitasFaqContents', $this->Paginator->paginate());
			$this->set('seoContentIndex', Configure::read('InfinitasFaq.robots.index.index'));
			$this->set('seoContentFollow', Configure::read('InfinitasFaq.robots.index.follow'));
			$this->set('seoCanonicalUrl', $url);
			$this->set('tagData', $tagData);
			$this->set('title_for_layout', $titleForLayout);
		}

		/**
		 * User view
		 *
		 * @param string $slug the slug for the record
		 * @return na
		 */
		public function view() {
			if (!isset($this->request->params['slug'])) {
				$this->notice('invalid');
			}

			$infinitasFaqContent = $this->{$this->modelClass}->find(
				'viewData',
				array(
					'conditions' => array(
						'GlobalContent.slug' => $this->request->params['slug'],
						$this->modelClass . '.active' => 1
					)
				)
			);

			/**
			 * make sure there is something found
			 */
			if (empty($infinitasFaqContent)) {
				$this->notice('invalid');
			}

			$this->set('infinitasFaqContent', $infinitasFaqContent);

			$canonicalUrl = $this->Event->trigger('InfinitasFaq.slugUrl', $infinitasFaqContent);
			$this->set('seoCanonicalUrl', $canonicalUrl['slugUrl']['InfinitasFaq']);

			$this->set('seoContentIndex', Configure::read('InfinitasFaq.robots.view.index'));
			$this->set('seoContentFollow', Configure::read('InfinitasFaq.robots.view.follow'));
			$this->set('title_for_layout', $infinitasFaqContent[$this->modelClass]['title']);
		}

		/**
		 * Admin Section.
		 *
		 * All the admin methods.
		 */
		/**
		 * Admin dashboard
		 *
		 * @return na
		 */
		public function admin_dashboard() {
			$feed = $this->{$this->modelClass}->find(
				'feed',
				array(
					'setup' => array(
						'plugin' => 'InfinitasFaq',
						'controller' => 'blog_posts',
						'action' => 'view',
					),
					'fields' => array(
						'BlogPost.id',
						'BlogPost.title',
						'BlogPost.intro',
						'BlogPost.created'
					),
					'feed' => array(
						'Core.Comment' => array(
							'setup' => array(
								'plugin' => 'Comments',
								'controller' => 'infinitas_comments',
								'action' => 'view',
							),
							'fields' => array(
								'InfinitasComment.id',
								'InfinitasComment.name',
								'InfinitasComment.comment',
								'InfinitasComment.created'
							)
						)
					),
					'order' => array(
						'created' => 'DESC'
					)
				)
			);

			$this->set('blogFeeds', $feed);

			$this->set('dashboardPostCount', $this->BlogPost->getCounts());
			$this->set('dashboardPostLatest', $this->BlogPost->getLatest());
			$this->set('dashboardCommentsCount', $this->BlogPost->Comment->getCounts('Blog.BlogPost'));
		}

		/**
		 * Admin index.
		 *
		 * Uses the {@see FilterComponent} component to filter results.
		 *
		 * @return na
		 */
		public function admin_index() {
			$infinitasFaqContents = $this->Paginator->paginate(null, $this->Filter->filter);

			$filterOptions = $this->Filter->filterOptions;
			$filterOptions['fields'] = array(
				'title',
				'body',
				'category_id' => $this->{$this->modelClass}->GlobalContent->find('categoryList'),
				'active' => Configure::read('CORE.active_options')
			);

			$this->set(compact('infinitasFaqContents', 'filterOptions'));
		}
	}