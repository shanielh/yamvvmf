<?php

namespace YAMVCF;

class Controller {
    
    // Does nothing (Yet).
    // Should be initialized with Twig, etc
    
    private $mExports = [];
    
    protected function export($key, $name) 
    {
        $this->mExports[$key] = $name;
    }
    
    public function GetExports()
    {
        return $this->mExports;
    }
        
}