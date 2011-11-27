<?php

namespace YAMVCF;

interface IConfig {
    
    public function Debug();
    
    public function GetEnvironment();
    
    public function GetConfig();
    
    public function GetRoutes();
    
}