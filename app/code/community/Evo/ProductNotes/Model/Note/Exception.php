<?php


class Evo_ProductNotes_Model_Note_Exception extends Exception
{

    public static function forEmptyNote()
    {
        return new self('Empty note content', 1);
    }

    public static function forMaximumLengthExceeded($length, $maxLength)
    {
        return new self(sprintf('Note content length %s exceeds maximum allowed length of %s', $length, $maxLength), 2);
    }

}