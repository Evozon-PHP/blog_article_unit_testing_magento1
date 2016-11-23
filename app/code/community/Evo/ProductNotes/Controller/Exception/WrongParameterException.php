<?php

/**
 * Exception thrown when controller action is of wrong type a request parameter.
 */
class Evo_ProductNotes_Controller_Exception_WrongParameterException extends Exception
{
    const CODE_POST_PARAMETER = 1;

    const MESSAGE_POST_PARAMETER = 'Wrong value for POST parameter: %s';

    /**
     * Factory method for exceptions regarding POST parameters being of wrong type
     * @param $parameter
     * @return Evo_ProductNotes_Controller_Exception_WrongParameterException
     */
    public static function forWrongPostParameter($parameter)
    {
        return new self(sprintf(self::MESSAGE_POST_PARAMETER, $parameter), self::CODE_POST_PARAMETER);
    }
}