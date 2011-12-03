<?php
namespace YAMVCF;

define('DS', DIRECTORY_SEPARATOR);

class AutoLoader {
    
    public static function load($className)
    {
        
        $formattedClassName = str_replace('\\', DS, $className);
        $suggestedFileName = __DIR__ . DS .'..' . DS . $formattedClassName . '.php';
        
        if (file_exists($suggestedFileName)) {
            require_once $suggestedFileName;
        }
        
    }
    
}

spl_autoload_register('YAMVCF\AutoLoader::load');