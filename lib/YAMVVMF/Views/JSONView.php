<?php

namespace YAMVVMF\Views;
use YAMVVMF\Interfaces\IView as IView;

class JSONView implements IView {
    
    public function __construct($controllerName, $actionName) 
    {
    }
    
    public function Render($values)
    {
        echo json_encode($values);
    }
    
    
    
}