<?php

namespace YAMVCF;

class InternalErrorException extends RedirectingException
{
    
    // Use it when you need it.
    public function __construct() {
        parent::__construct('InternalError','index');
        
    }
}