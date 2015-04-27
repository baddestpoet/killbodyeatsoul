<?php

class FuController extends Zend_Controller_Action
{
    public function indexAction() {
    }

    public function newstuffAction() {
        $form = new Application_Form_Post();
        $postTable = new Application_Model_DbTable_PostsTable();

        $this->view->form = $form;
        $this->view->newId = $postTable->getlastId()->id+1;
        $params = $this->getRequest()->getParams();
        
        if(isset($params['submit']) && $form->isValid($params)) {
            
            $data = array();
            $data['title'] = $params['title'];
            $data['text'] = $params['text'];
            $data['date'] = date('Y-m-d');
            $data['pic'] = $params['pic'];

            $tagTable = new Application_Model_DbTable_TagsTable();

            $postid = $postTable->insert($data);

            $tags = explode(' ', $params['tags']);
            
            $tagTable->updateTags($postid, $tags);

            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->addFilter('Rename', array('target' => 'images/' . $postid . '.jpg'));
            $adapter->receive();

            $data = $postTable->getFifteenPosts();

            $rssdata = array(
                'title' => "killbodyeatsoul.",
                'description' => "a bunch of stuff",
                'link' => "killbodyeatsoul.net",
                'charset' => "utf-8",
                'entries' => array()
            );

            foreach($data as $entry) {
                if($entry['pic']) {
                    $desc = '<img src="http://www.killbodyeatsoul.net/images/' . $entry['id'] . '.jpg" /><br/>' . $entry['text'];
                } else {
                    $desc = $entry['text'];
                }
                $rssdata[entries][] = array(
                    'title' => $entry['title'],
                    'description' => $desc,
                    'link' => "http://www.killbodyeatsoul.net/?id=" . $entry['id'],
                );
            }
            
            $feed = Zend_Feed::importArray($rssdata, 'rss');
            $rss = $feed->saveXml();

            $file = fopen("eatsoul.rss", "w");
            fwrite($file, $rss);
            fclose($file);
        }
    }

    public function newquoteAction() {
        $form = new Application_Form_Quote();
        $quoteTable = new Application_Model_DbTable_QuotesTable();

        $params = $this->getRequest()->getParams();
        
        if(isset($params['submit']) && $form->isValid($params)) {
            $data = array();
            $data['author'] = $params['author'];
            $data['quote'] = $params['quote'];
            $quoteTable->insert($data);
        }

        $this->view->form = $form;   
    }
}