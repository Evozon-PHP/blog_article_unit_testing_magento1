<?php

use Evo_ProductNotes_Model_Resource_Note_Collection as NoteCollection;

class Evo_ProductNotes_Block_Note_Listing extends Mage_Core_Block_Template
{
    const LISTING_LIMIT_DEFAULT = 5;

    /**
     * The number of notes to list
     * @var int
     */
    private $listingLimit;

    /**
     * Constructor:
     * - sets default listing limit
     */
    protected function _construct()
    {
        parent::_construct();
        $this->listingLimit = self::LISTING_LIMIT_DEFAULT;
    }

    /**
     * Returns notes collection for use in listing.
     * @return NoteCollection
     */
    protected function getNotesCollection()
    {
        $product = Mage::helper('evo_productnotes')->getCurrentProduct();

        /* @var $collection NoteCollection */
        $collection = Mage::getModel('evo_productnotes/note')->getCollection();
        $collection->prepareForListing($this->getListingLimit(), $product);

        return $collection;
    }


    /**
     * Returns datetime formatted for display
     * @param $note
     * @return mixed
     */
    public function getFormattedDatetime($note)
    {
        $datetime = $note->getNoteDate();
        return Mage::helper('core')->formatDate($datetime, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM, true);
    }

    /**
     * Getter for listing limiting count.
     * @return int
     */
    public function getListingLimit()
    {
        return $this->listingLimit;
    }

}