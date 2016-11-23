<?php

class Evo_ProductNotes_Block_Note_Form extends Mage_Core_Block_Template
{
    /**
     * Returns URL for form's action
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->_getUrlModel()->getUrl('evo_productnotes/note/new');
    }

    /**
     * Returns value for the hidden input that holds the referred product ID.
     * @return int
     */
    public function getProductIdFieldValue()
    {
        $product = Mage::helper('evo_productnotes')->getCurrentProduct();
        return (int)$product->getId();
    }
}