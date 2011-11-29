<?php

namespace YAMVCF;

class Controller {
    
    // Does nothing (Yet).
    // Should be initialized with Twig, etc
    
    private $mValues = [];
    
    protected function addValue($key, $name) {
        $this->mValues[$key] = $name;
    }
    
    public function GetValues() {
        return $this->mValues;
    }
        
}