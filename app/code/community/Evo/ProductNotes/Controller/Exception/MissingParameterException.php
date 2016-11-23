<?php

/**
 * Exception thrown when controller action is missing a request parameter.
 */
class Evo_ProductNotes_Controller_Exception_MissingParameterException extends Exception
{

    const CODE_POST_PARAMETER = 1;

    const MESSAGE_POST_PARAMETER = 'Missing POST parameter: %s';
    
    /**
     * FActory method for exceptions regarding POST parameters missing
     * @param $parameter
     * @return Evo_ProductNotes_Controller_Exception_MissingParameterException
     */
    public static function forMissingPostParameter($parameter)
    {
        return new self(sprintf(self::MESSAGE_POST_PARAMETER, $parameter), self::CODE_POST_PARAMETER);
    }
}