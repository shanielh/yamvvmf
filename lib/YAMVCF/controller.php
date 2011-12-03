<?php

namespace YAMVCF;

class Controller {
    
    private $mExports = [];
    
    // Use it to export key-value-pairs to the view
    protected function export($key, $value) 
    {
        $this->mExports[$key] = $value;
    }
    
    public function GetExports()
    {
        return $this->mExports;
    }
        
}