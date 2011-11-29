<?php

namespace YAMVCF;

// Use the autoloader
require_once '../lib/YAMVCF/autoloader.php';

$container = Container::getInstance();

$router = $container->getObject('YAMVCF\Interfaces\IRouter');

// Bootstrap
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];

$relativeUri = $router->GetRelativeActionUri($requestUri, $scriptName);

try
{
    $choosenRoute = $router->route($relativeUri);
    $router->bootstrap($choosenRoute);
}
// Fallback to 403, 404, 500.
catch (Exceptions\RedirectingException $e)
{
    $router->bootstrap($e->GetRouterParams());
}