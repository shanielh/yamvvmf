<?php

namespace YAMVCF;

// Define some constants
define('DS', DIRECTORY_SEPARATOR);
define('LIB', __DIR__ . DS . '..' . DS );
define('COMPLEX', LIB . DS . '..' . DS );

class AutoLoader {
    
    public static function load($className)
    {
        
        $formattedClassName = str_replace('\\', DS, $className);
        $suggestedFileName = LIB . $formattedClassName . '.php';
        
        if (file_exists($suggestedFileName)) {
            require_once $suggestedFileName;
        }
        
    }
    
}

spl_autoload_register('YAMVCF\AutoLoader::load');