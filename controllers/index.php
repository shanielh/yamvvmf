<?php

class Index extends YAMVVMF\Controller {
    
    public function getById($id) {
        
        var_dump($id);
        die();
        
    }
    
    public function main() {
        
        $this->export('world', 'world!');
    
    }
    
}