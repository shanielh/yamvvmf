<?php

namespace YAMVCF\Exceptions;

class InternalErrorException extends RedirectingException
{
    
    private $mMessage;
    
    // Use it when you need it.
    public function __construct($message) 
    {
        parent::__construct('InternalError', 'index');
        $mMessage = $message;
    }
    
}