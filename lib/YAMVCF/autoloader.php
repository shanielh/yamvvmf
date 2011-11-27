<?php

namespace YAMVCF;

class AutoLoader {
    
    public static function Load($className) {
        
        $suggestedFileName = '../lib/' . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($suggestedFileName)) {
            require_once $suggestedFileName;
        } else {
            var_dump('file not found ' . $suggestedFileName . ' (class : ' . $className . ' )');
        }
        
    }
    
}

spl_autoload_register('YAMVCF\AutoLoader::load');