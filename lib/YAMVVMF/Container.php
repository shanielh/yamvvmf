<?php

namespace YAMVVMF;

// Container implementation for self usage.
class Container {
    
    private static $instance;
    
    private $container;
    
    private function __construct() 
    {
        $this->initIoc();
        $this->container = \IoC\Container::getInstance();
        $this->container->register(new Config());
        $this->container->register('YAMVVMF\Router');
        
    }
    
    private function initIoc() 
    {
        // Load IoC Library
        require_once LIB . 'IoC' . DS . 'IoC' . DS . 'ClassLoader.php';
        
        $classLoader = new \IoC\ClassLoader('IoC', LIB . 'IoC');
        $classLoader->register();

    }
    
    public static function getInstance() 
    {
        
        if (self::$instance === null) {
            self::$instance = new Container();
        }
        
        return self::$instance->container;
        
    }
    
}