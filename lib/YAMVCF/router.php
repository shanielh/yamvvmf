<?php

namespace YAMVCF;

class Router implements Interfaces\IRouter 
{
    
    private $mConfig;
    
    const FORMAT_REGEX = "/(.*)\.(HTML|JSON|XML)$/i";
    
    public function __construct(Interfaces\IConfig $config) 
    {
        
        $this->mConfig = $config;
        
    }
    
    public function GetRelativeActionUri($requestUri, $scriptName) 
    {
        
        $baseUri = Router::getBaseUri($scriptName);
        return substr($requestUri, strlen($baseUri) + 1);
        
    }
    
    private function GetBaseUri($scriptName) 
    {
        
        return dirname($scriptName);
    }
    
    public function Route($relativeActionUri) 
    {
        
        if (preg_match(self::FORMAT_REGEX, $relativeActionUri, $matches) > 0) {
            $format = strtoupper($matches[2]);
            $relativeActionUri = $matches[1];
        } else {
            $format = "HTML";
        }
        
        foreach ($this->mConfig->getRoutes() as $uri => $params) {
            
            // Clones the params to new array
            $formats = array_key_exists('formats', $params) ? 
                       $params['formats'] : array("HTML");
            
            if (!in_array($format, $formats)) {
                continue;
            }
            
            $regexes = $params;
            unset($regexes['controller']);
            unset($regexes['action']);
            
            // Build regex
            foreach ($regexes as $key => &$value) {
                $value = "(?<{$key}>{$value})";
            }
            
            $uriRegex = str_replace(array_keys($regexes), array_values($regexes), $uri);
            
            $uriRegex = '/^' . str_replace('/', '\/', $uriRegex) . '$/i';
            
            // Try Regex
            if (preg_match($uriRegex, $relativeActionUri, $matches) > 0) {
                
                // Fill in request
                foreach ($matches as $key => $value) {
                    if (is_int($key)) {
                        continue;
                    }
                    
                    $_REQUEST[$key] = $value;
                }
                
                // Return original params
                $params['format'] = $format;
                return $params;
            }
        }
        return false;
    }
    
    // Bootstraps controller and calls for action :-)
    public function Bootstrap($routeParams) 
    {
        
        if ($routeParams === false) {
            throw new Exceptions\PageNotFoundException();
        }
        
        $controllerName = $routeParams['controller'];
        $actionName = $routeParams['action'];
        
        if (strcasecmp($controllerName, $actionName) === 0) {
            $error = "Controller name should not be the same as the action name " .
                     "(Because if they are, The action would become the controller's c'tor)";
            throw new Exceptions\InternalErrorException($error);
        }
        
        require_once('../controllers/' . $controllerName . '.php');
        
        
        $controller = new $controllerName();
        
        $arguments = Router::GetArguments($controllerName, $actionName, $_REQUEST);
        
        // Call it.
        call_user_func_array(array($controller, $actionName), $arguments);
        
        
        // Create view and render.
        $viewName = 'YAMVCF\\Views\\' . $routeParams['format'] . 'View';
        $view = new $viewName($controllerName, $actionName);
        
        $view->render($controller->GetExports());
        
    }
    
    private static function GetArguments($controllerName, $actionName, $arguments) 
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