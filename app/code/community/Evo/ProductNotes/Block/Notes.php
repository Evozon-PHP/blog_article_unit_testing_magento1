<?php


class Evo_ProductNotes_Block_Notes extends Mage_Core_Block_Template
{
    /**
     * Returns referred product name for display in template.
     * @return string
     */
    public function getProductName()
    {
        $product = Mage::helper('evo_productnotes')->getCurrentProduct();
        return $product->getName();
    }
}