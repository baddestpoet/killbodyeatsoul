<?php
class Application_Model_DbTable_PostsTable extends Zend_Db_Table_Abstract
{
    protected $_name = 'posts';
    protected $_primary = 'id';

    public function getAll()
    {
        $select = $this->select()->order('id DESC');
        return $this->fetchAll($select);
    }

    public function getById($id)
    {
        $select = $this->select()
            ->where('id = '. $id);
        return $this->fetchAll($select);
    }

    public function getBlogposts()
    {
        $select = $this->select()
            ->where('post = 1')
            ->order('date DESC');
        return $this->fetchAll($select);
    }

    public function getRandom()
    {
        $select = $this->select()
            ->where('post != 1')
            ->order(new Zend_Db_Expr('RAND()'));
        
        return $this->fetchRow($select);
    }

    public function getFifteenPosts()
    {
        $select = $this->select()
            ->order('id DESC')
            ->limit(15, 0);
        return $this->fetchAll($select);        
    }

    public function getLastId()
    {
        $select = $this->select()
            ->order('id DESC');
        return $this->fetchRow($select);
    }
}