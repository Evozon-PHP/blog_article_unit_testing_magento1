<?php

class Evo_ProductNotes_Model_Resource_Note extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('evo_productnotes/notes', 'note_id');
    }

}