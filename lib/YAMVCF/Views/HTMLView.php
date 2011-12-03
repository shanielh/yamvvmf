<?php

namespace YAMVCF\Views;
use \YAMVCF\Interfaces\IView as IView;
use \YAMVCF\Container as Container;

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
        require_once dirname(__FILE__) . '/../../Twig/lib/Twig/Autoloader.php';
        \Twig_Autoloader::Register();
        
        $loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . '/../../../views/');
        $this->mTwig = new \Twig_Environment($loader, array('debug' => true));
     
    }
    
    public function Render($values) 
    {
        
        $templateName = $this->mControllerName . '/' . 
                        $this->mActionName . '.twig';
        
        echo $this->mTwig->render($templateName, $values);
        
    }
    
}