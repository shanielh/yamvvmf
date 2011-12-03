<?php

namespace YAMVVMF\Exceptions;

class ForbiddenException extends RedirectingException
{
    
    // Use it when you need it :-)
    public function __construct() 
    {
        parent::__construct('Forbidden', 'index');
        
    }
    
}