<?php

namespace YAMVCF;

class Controller {
    
    private $mExports = [];
    
    // Use it to export key-value-pairs to the view
    protected function export($key, $name) 
    {
        $this->mExports[$key] = $name;
    }
    
    public function GetExports()
    {
        return $this->mExports;
    }
        
}