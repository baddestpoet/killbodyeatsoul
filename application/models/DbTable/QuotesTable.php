<?php
class Application_Model_DbTable_QuotesTable extends Zend_Db_Table_Abstract
{
    protected $_name = 'quotes';
    protected $_primary = 'id';

    public function getRandom()
    {
        $select = $this->select()
            ->order(new Zend_Db_Expr('RAND()'));

        return $this->fetchRow($select);
    }
}