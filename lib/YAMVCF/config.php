<?php

namespace YAMVCF;

class Config implements Interfaces\IConfig {
    
    private static $config;
    
    public function Debug() {
        return Config::Get()['debug'];
    }
    
    public function GetEnvironment() {
        return apache_getenv('ENVIRONMENT');
    }
    
    public function GetConfig() {
        return json_decode(file_get_contents('../config/' . Config::GetEnvironment() . '.json'), true);
    }
    
    public function GetRoutes() {
        return json_decode(file_get_contents('../config/routes.json'), true);
    }
    
}