<?php

use Evo_ProductNotes_Controller_Exception_MissingParameterException as MissingParameterException;
use Evo_ProductNotes_Controller_Exception_WrongParameterException as WrongParameterException;

/**
 * Note controller
 */
class Evo_ProductNotes_NoteController extends Mage_Core_Controller_Front_Action
{

    /**
     * Saves a new note.
     * Requested via POST.
     * Redirects to referrer.
     *
     * @throws Exception
     * @throws Mage_Core_Exception
     */
    public function newAction()
    {
        $request = $this->getRequest();

        // Validate POST parameters
        $productId = $request->getPost('product_id');

        // Check for product_id parameter to be present
        if (is_null($productId)) {
            throw MissingParameterException::forMissingPostParameter('product_id');
        }

        // Check if product_id is of correct type
        if (!is_numeric($productId)) {
            throw WrongParameterException::forWrongPostParameter('product_id');
        }

        $content = $request->getPost('note', '');
        // Check the cote parameter to not be missing or empty
        if (strlen($content) === 0) {
            throw MissingParameterException::forMissingPostParameter('note');
        }

        // Create note model, fill in data and then save
        $note = Mage::getModel('evo_productnotes/note');
        $note->setProductId((int)$productId);
        $note->setNote($content);
        $helper = Mage::helper('evo_productnotes');
        $note->setNoteDate($helper->getCurrentDatetimeMysqlFormatted());

        $note->save();

        $this->_redirectReferer();
    }

}