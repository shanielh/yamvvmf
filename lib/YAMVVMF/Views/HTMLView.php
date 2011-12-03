<?php

namespace YAMVVMF\Views;
use \YAMVVMF\Interfaces\IView as IView;
use \YAMVVMF\Container as Container;

class HTMLView implements IView 
{
    
    private $mControllerName;
    
    private $mActionName;
    
    private $mTwig;
    
    public function __construct($controllerName, $actionName) 
    {
        
        $this->mControllerName = $controllerName;
        $this->mActionName = $actionName;
     
        // Load Twig Library
        require_once LIB . '/Twig/lib/Twig/Autoloader.php';
        \Twig_Autoloader::Register();
        
        $loader = new \Twig_Loader_Filesystem(COMPLEX . '/views/');
        $this->mTwig = new \Twig_Environment($loader, array('debug' => true));
     
    }
    
    public function Render($values) 
    {
        
        $templateName = $this->mControllerName . '/' . 
                        $this->mActionName . '.twig';
        
        echo $this->mTwig->render($templateName, $values);
        
    }
    
}