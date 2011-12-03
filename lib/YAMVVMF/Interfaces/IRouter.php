<?php

namespace YAMVVMF\Interfaces;

interface IRouter {
    
    public function GetRelativeActionUri($requestUri, $scriptName);
    
    public function Route($relativeActionUri);
    
    // Bootstraps controller and calls for action :-)
    // Should be in IBootstrapper
    public function Bootstrap($routeParams);
    
}