<?php

namespace YAMVCF;

class Config {
    
    private static $config;
    
    public static function Get() {
        
        if (Config::$config == null) {
            Config::$config = Config::GetConfig();
        }
        
        return Config::$config;
        
    }
    
    public static function Debug() {
        
        return Config::Get()['debug'];
        
    }
    
    public static function GetEnvironment() {
        return 'dev';
    }
    
    private static function GetConfig() {
        return json_decode(file_get_contents('../config/' . Config::GetEnvironment() . '.json'), true);
    }
    
}