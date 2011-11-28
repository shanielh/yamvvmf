<?php

namespace YAMVCF;

class Controller {
    
    // Does nothing (Yet).
    // Should be initialized with Twig, etc
    
    private $mValues = [];
    
    protected function addValue($key, $name) {
        $this->mValues[$key] = $name;
    }
    
    public function getValues() {
        return $this->mValues;
    }
    
    public function render($actionName) {
        
        // Get twig :
        $twig = Container::getInstance()->getObject('Twig');
        $templateName = get_class($this) . '/' . $actionName . '.twig';
        echo $twig->render($templateName, $this->getValues());
    }
    
    
 
}