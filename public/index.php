<?php
namespace YAMVCF;

// Use the autoloader
require_once('../lib/YAMVCF/autoloader.php');

// Bootstrap
$relativeUri = Router::GetRelativeActionUri($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);

$routes = Config::GetRoutes();

try
{
    $choosenRoute = Router::Route($relativeUri, $routes);
    Router::Bootstrap($choosenRoute);
}
// Fallback to 403, 404, 500.
catch (Exceptions\RedirectingException $e)
{
    Router::Bootstrap($e->GetRouterParams());
}