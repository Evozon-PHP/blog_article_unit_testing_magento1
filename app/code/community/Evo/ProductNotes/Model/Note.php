<?php

use Evo_ProductNotes_Model_Note_Exception as NoteException;

class Evo_ProductNotes_Model_Note extends Mage_Core_Model_Abstract
{
    /**
     * @const Default maximum note content length
     */
    const MAX_NOTE_LENGTH = 50;

    /**
     * Initializes the model instance
     */
    protected function _construct()
    {
        $this->_init('evo_productnotes/note');
    }

    /**
     * Getter of note content as page displayable
     * @return string
     */
    public function getNoteHtml()
    {
        return nl2br($this->getData('note'));
    }

    /**
     * Note attribute setter.
     *
     * @param string $note
     * @throws NoteException
     */
    public function setNote($note)
    {

        $clean = strip_tags($note);
        $length = mb_strlen($clean);

        if ($length == 0) {
            throw NoteException::forEmptyNote();
        }

        if ($length > $this->getMaxNoteLength()) {
            throw NoteException::forMaximumLengthExceeded($length, $this->getMaxNoteLength());
        }

        $this->setData('note', $clean);
    }

    /**
     * A getter for the max length allowed for note contents.
     * Easily mock-able.
     * @return int
     */
    public function getMaxNoteLength()
    {
        return self::MAX_NOTE_LENGTH;
    }
}