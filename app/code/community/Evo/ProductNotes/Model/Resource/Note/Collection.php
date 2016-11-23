<?php

class Evo_ProductNotes_Model_Resource_Note_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Initializes the collection
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('evo_productnotes/note');
    }

    /**
     * Prepares collection for listing notes block
     * @param int $listingLimit
     * @param Mage_Catalog_Model_Product $product
     */
    public function prepareForListing($listingLimit, $product)
    {
        // Add product constraint
        $this->addFieldToFilter('product_id', array('eq' => $product->getId()));

        // Add the limit
        $this->setPageSize($listingLimit);
        $this->setCurPage(1);

        // Set the ordering
        $this->setOrder('note_date', self::SORT_ORDER_DESC);
    }
}