<?php
/**
 * Created by PhpStorm.
 * User: qingchengdelaike
 * Date: 2018/4/3
 * Time: 1:36
 */

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings'=>[
        'displayErrorDetails'=>true,
    ]
]);


$container = $app->getContainer();

$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[
        'cache'=>false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function ($container)
{
    return new \App\Home\Controllers\HomeController($container);
};

require __DIR__ . '/../routes/routes.php';