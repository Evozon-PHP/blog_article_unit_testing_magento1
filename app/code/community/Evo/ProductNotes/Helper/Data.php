<?php

class Evo_ProductNotes_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Returns currently referred product.
     * This allows easy changing the way the modules gets the current product in just one edit.
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getCurrentProduct()
    {
        return Mage::registry('current_product');
    }

    /**
     * Returns current datetime formatted for MySQL
     * @return mixed
     */
    public function getCurrentDatetimeMysqlFormatted()
    {
        return Mage::getModel('core/date')->date('Y-m-d H:i:s');
    }

}