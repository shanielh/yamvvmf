<?php

namespace YAMVCF\Interfaces;

interface IConfig {
    
    public function Debug();
    
    public function GetEnvironment();
    
    public function GetConfig();
    
    public function GetRoutes();
    
}