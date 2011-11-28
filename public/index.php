<?php
namespace YAMVCF;

// Use the autoloader
require_once('../lib/YAMVCF/autoloader.php');

$container = Container::getInstance();

$router = $container->getObject('YAMVCF\Interfaces\IRouter');

// Bootstrap
$relativeUri = $router->GetRelativeActionUri($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);

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