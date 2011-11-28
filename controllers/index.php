<?php

class Index extends YAMVCF\Controller {
    
    public function getById($id) {
        
        var_dump($id);
        die();
        
    }
    
    public function main() {
        
        $this->addValue('world', 'world!');
    
    }
    
}