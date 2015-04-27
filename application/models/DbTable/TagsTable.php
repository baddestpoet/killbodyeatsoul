<?php
class Application_Model_DbTable_TagsTable extends Zend_Db_Table_Abstract
{
    protected $_name = 'tags';
    protected $_primary = 'name';

    protected $_referenceMap = array(
        'posts' => array(
            'columns'           => 'post_id',
            'refTableClass'     => 'Application_Model_DbTable_PostsTable',
            'refColumns'        => 'id'
    ));

    public function getAll() {
        $select = $this->select()
            ->from('tags', array('name', 'id', 'count(tags.name) as anzahl'))
            ->group(array('tags.name'))
            ->order('anzahl DESC');
        
        return $this->fetchAll($select);
    }

    public function getTags($stuffid)
    {
        $select = $this->select()->where('post_id = ?', $stuffid);
        return $this->fetchAll($select);
    }

    public function updateTags($postid, $tags)
    {
        $where = $this->getAdapter()->quoteInto('post_id = ?', $postid);
        $this->delete($where);

        foreach ($tags as $tag) {
            $data = array(
                'post_id' => $postid,
                'name' => $tag
            );
            $this->insert($data);
        }
    }

    public function getStuff($tag) {
        $select = $this->select()
            ->where('name = ?', $tag)
            ->order('id DESC');
        return $this->fetchAll($select);
    }
}