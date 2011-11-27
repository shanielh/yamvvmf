<?php
namespace YAMVCF;

// Use the autoloader
require_once('../lib/YAMVCF/autoloader.php');

// Bootstrap
$relativeUri = Router::GetRelativeActionUri($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);

$a = Config::Debug();

$routes = json_decode(file_get_contents('../config/routes.json'), true);

try
{
    $choosenRoute = Router::Route($relativeUri, $routes);
    Router::Bootstrap($choosenRoute);
}
catch (Exceptions\PageNotFoundException $e)
{
    Router::Bootstrap(array('controller' => 'pageNotFound', 'action' => 'index'));
}
