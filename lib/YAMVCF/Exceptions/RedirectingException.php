<?php

namespace YAMVCF\Exceptions;

class RedirectingException extends \Exception {
    
    private $mRouterParams;
    
    public function __construct($controllerName, $actionName) {
        
        $this->mRouterParams = array('controller' => $controllerName,    
                                    'action'     => $actionName);
        
    }
    
    public function GetRouterParams() {
        
        return $this->mRouterParams;
        
    }
    
}