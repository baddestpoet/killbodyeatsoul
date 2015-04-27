<?php

class IndexController extends Zend_Controller_Action
{

    public function _init()
    {
        $this->view->title = $this->getRequest()->getAction();
    }

    public function indexAction() {

        $params = $this->getRequest()->getParams();

        $postTable = new Application_Model_DbTable_PostsTable();
        $commentTable = new Application_Model_DbTable_CommentsTable();
        $quoteTable = new Application_Model_DbTable_QuotesTable();
        $tagTable = new Application_Model_DbTable_TagsTable();

        if(isset($params['id'])) {
            $paginator = Zend_Paginator::factory($postTable->getById($params['id']));
        } elseif (isset($params['tag'])) {
            $tags = $tagTable->getStuff($params['tag']);
            $stufflist = array();
            if(!empty($tags)) {
                foreach($tags as $tag) {
                    $stufflist[] = $tag->findParentRow($postTable);
                }
                $paginator = Zend_Paginator::factory($stufflist);
            }
        } else {
            $paginator = Zend_Paginator::factory($postTable->getAll());
        }
        $paginator->setDefaultItemCountPerPage(29);
        $paginator->setCurrentPageNumber($this->_getParam('page'));

        $form = new Application_Form_Comment();

        if(isset($params['submit'])) {
            if($form->isValid($params) && !$params['email'] && $params['robot'] == "human") {
                $data = array(
                    'author' => $params['name'],
                    'text' => $params['text'],
                    'post_id' => $params['post_id'],
                    'url' => $params['url'],
                    'date' => date('Y-m-d'),
                );
                $commentTable->insert($data);
            }
        }
        $data = $commentTable->getLatest();
        $latestComments = array();

        foreach($data as $entry) {
            $title = $entry->findParentRow($postTable)->title;
            $entry = $entry->toArray();
            $entry['title'] = $title;
            $latestComments[] = $entry;
        }

        $comments = array();
        $taglist = array();
        foreach($paginator as $post) {
            $precomments = $commentTable->getAll($post['id'])->toArray();

            foreach($precomments as $comment) {
                $comments[$post['id']][] = $comment;
            }
            $pretags = $tagTable->getTags($post['id'])->toArray();

            foreach($pretags as $tag) {
                $taglist[$post['id']][] = $tag;
            }
        }

        $this->view->paginator = $paginator;
        $this->view->form = $form;
        $this->view->latestComments = $latestComments;
        $this->view->tags = $tagTable->getAll();
        $this->view->quote = $quoteTable->getRandom();
        $this->view->comments = $comments;
        $this->view->taglist = $taglist;
        $this->view->blogposts = $postTable->getBlogposts();
        $this->view->randomStuff = $postTable->getRandom();
        if (isset($params['tag'])) {
            $this->view->tag = $params['tag'];
        }
    }
}
