<?php

namespace YAMVCF\Views;
use \YAMVCF\Interfaces\IView as IView;
use \YAMVCF\Container as Container;

class HTMLView implements IView {
    
    private $mControllerName;
    
    private $mActionName;
    
    public function __construct($controllerName, $actionName) {
        
        $this->mControllerName = $controllerName;
        $this->mActionName = $actionName;
        
    }
    
    public function Render($values) {
        
        $twig = Container::getInstance()->getObject('Twig');
        $templateName = $this->mControllerName . '/' . $this->mActionName . '.twig';
        
        echo $twig->render($templateName, $values);
        
    }
    
}