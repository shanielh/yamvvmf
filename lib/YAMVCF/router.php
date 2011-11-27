<?php

namespace YAMVCF;

class Router {
    
    public static function GetRelativeActionUri($requestUri, $scriptName) {
        
        $baseUri = Router::getBaseUri($scriptName);
        
        return substr($requestUri, strlen($baseUri) + 1);
        
    }
    
    public static function getBaseUri($scriptName) {
        
        return dirname($scriptName);
    }
    
    public static function Route($relativeActionUri, $routes) {
        
        foreach ($routes as $uri => $params) {
            
            // Clones the params to new array
            $regexes = $params;
            unset($regexes['controller']);
            unset($regexes['action']);
            
            // Build regex
            foreach ($regexes as $key => &$value) {
                $value = "(?<{$key}>{$value})";
            }
            
            $uriRegex = '$' . str_replace(array_keys($regexes), array_values($regexes), $uri) . '$';
            
            // Try Regex
            if (preg_match($uriRegex, $relativeActionUri, $matches)) {
                
                // Fill in request
                foreach ($matches as $key => $value) {
                    if (is_int($key)) {
                        continue;
                    }
                    
                    $_REQUEST[$key] = $value;
                }
            }
            
            // Return original params
            return $params;
        }
        
    }
    
    // Bootstraps controller and calls for action :-)
    public static function Bootstrap($routeParams) {
        
        $controllerName = $routeParams['controller'];
        $actionName = $routeParams['action'];
        
        require_once('../controllers/' . $controllerName . '.php');
        
        $controller = new $controllerName();
        
        $arguments = Router::GetArguments($controllerName, $actionName, $_REQUEST);
        
        // Call it.
        call_user_func_array(array($controller, $actionName), $arguments);
        
    }
    
    private static function GetArguments($controllerName, $actionName, $arguments) {
        
        $reflector = new \ReflectionClass($controllerName);
        $methodReflector = $reflector->getMethod($actionName);
        
        $retVal = array();
        
        foreach ($methodReflector->getParameters() as $param) {
            $paramName = $param->getName();
            
            if (array_key_exists($paramName, $arguments)) {
                $paramValue = $arguments[$paramName];
            } elseif ($param->isDefaultValueAvailable) {
                $paramValue = $param->getDefaultValue();
            } else {
                throw new Exception("Argh");
            }
            
            $retVal[$paramName] = $paramValue;
        }
        
        return $retVal;
        
    }
    
}