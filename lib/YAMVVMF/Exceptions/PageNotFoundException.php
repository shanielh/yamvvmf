<?php

namespace YAMVVMF\Exceptions;

class PageNotFoundException extends RedirectingException 
{

    // Throw it when you need it.
    public function __construct() 
    {
        parent::__construct('PageNotFound', 'index');
        
    }
    
}
