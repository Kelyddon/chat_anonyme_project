<?php

use App\controllers\AboutController;
use App\controllers\RoomController;
use App\controllers\MessageController;
use App\services\Router;

require_once 'src/config/settings.php';
require_once 'src/services/Router.php';

spl_autoload_register(function($className) {
    $path = str_replace('\\', '/', $className);
    $path = str_replace('App', 'src', $path);
    $filename = $path . '.php';

    if (file_exists($filename)) {
        include $filename;
    }
});

$url = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : null;

$router = new Router($url, $action);
$controllerInstance = $router->getController();
$actionMethod = $router->getAction();

$controllerInstance->$actionMethod();


switch ($url) {
    case 'home':
        $controllerInstance->display();
        break;
    case 'about':
        $controllerInstance->display();
        break;
    case 'room':
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controllerInstance->createRoom();
        } else {
            $controllerInstance->display();
        }
        break;
    case 'message':
        if ($action === 'send' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controllerInstance->sendMessage();
        } else {
            $controllerInstance->display();
        }
        break;
    default:
        echo "Erreur 404 : page non trouvée.";
        break;
}