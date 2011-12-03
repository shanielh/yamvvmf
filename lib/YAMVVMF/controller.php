<?php

namespace YAMVVMF;

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
        
    public static function GetArguments($controllerName, $actionName, $arguments) 
    {
        
        $reflector = new \ReflectionClass($controllerName);
        $methodReflector = $reflector->getMethod($actionName);
        
        $retVal = array();
        
        foreach ($methodReflector->getParameters() as $param) {
            $paramName = $param->getName();
            
            if (array_key_exists($paramName, $arguments)) {
                $paramValue = $arguments[$paramName];
            } elseif ($param->isDefaultValueAvailable()) {
                $paramValue = $param->getDefaultValue();
            } else {
                throw new Exceptions\PageNotFoundException();
            }
            
            $retVal[$paramName] = $paramValue;
        }
        
        return $retVal;
        
    }
}