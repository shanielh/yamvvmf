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
    
    private function __construct() 
    {
    
        $this->container = \IoC\Container::getInstance();
        $this->container->register(new Config());
        $this->container->register('YAMVCF\Router');
        
        $this->initTwig();
        
    }
    
    // Loads twig into container with the name 'Twig'
    private function initTwig() 
    {
        
        // Load Twig Library
        require_once dirname(__FILE__) . '/../Twig/lib/Twig/Autoloader.php';
        \Twig_Autoloader::Register();
        
        $loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . '/../../views/');
        $twig = new \Twig_Environment($loader, array('debug' => true));
        
        $this->container->register($twig, 'Twig');

    }
    
    public static function getInstance() 
    {
        
        if (self::$instance === null) {
            self::$instance = new Container();
        }
        
        return self::$instance->container;
        
    }
    
}