<?php

namespace YAMVCF;

interface IRouter {
    
    public function GetRelativeActionUri($requestUri, $scriptName);
    
    public function getBaseUri($scriptName);
    
    public function Route($relativeActionUri);
    
    // Bootstraps controller and calls for action :-)
    public function Bootstrap($routeParams);
    
}