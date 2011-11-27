<?php

namespace YAMVCF;

// Load IoC Library
require_once dirname(__FILE__) . '/../IoC/IoC/ClassLoader.php';

$classLoader = new \IoC\ClassLoader('IoC', __DIR__ . '/../IoC/');
$classLoader->register();

// Container implementation for self usage.
class Container {
    
    private static $instance;
    
    private $container;
    
    private function __construct() {
    
        $this->container = \IoC\Container::getInstance();
        $this->container->register(new Config());
        $this->container->register('YAMVCF\Router');
        
    }
    
    public static function getInstance() {
        
        if (self::$instance === null) {
            self::$instance = new Container();
        }
        
        return self::$instance->container;
        
    }
    
}