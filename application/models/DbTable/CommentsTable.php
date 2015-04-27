<?php
class Application_Model_DbTable_CommentsTable extends Zend_Db_Table_Abstract
{
    protected $_name = 'comments';
    protected $_primary = 'id';

    protected $_referenceMap = array(
        'stuff' => array(
            'columns'           => 'post_id',
            'refTableClass'     => 'Application_Model_DbTable_PostsTable',
            'refColumns'        => 'id'
    ));

    public function getAll($stuffid)
    {
        $select = $this->select()
            ->where('post_id ='. $stuffid)
            ->order('id ASC');
        return $this->fetchAll($select);
    }
    
    public function getLatest() {
        $select = $this->select()
            ->order('id DESC');
        return $this->fetchAll($select);
    }
}
