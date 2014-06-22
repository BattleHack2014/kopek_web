<?php

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Crm\Logic\Logic;

$app = require_once ROOT_PATH.'/config/app.php';
// Initialize Twig
$twig_path = ROOT_PATH.'/src/Crm/View/';
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $twig_path,
));

/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/', function () use ($app) {
    return $app->handle(
        Request::create('/index/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/facebook', function () use ($app) {
    return $app->handle(
        Request::create('/facebook/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/goal', function () use ($app) {
    return $app->handle(
        Request::create('/goal/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});
/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/pay', function () use ($app) {
    return $app->handle(
        Request::create('/pay/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/dashboard', function () use ($app) {
    return $app->handle(
        Request::create('/dashboard/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Custom route in most cases redirects to original {logic}/{action} route
 */
$app->match('/example', function () use ($app) {
    Logic::getRequest()->request->add(array('id' => $id));
    return $app->handle(
        Request::create('/example/index', 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Main route
 */
$app->match('/{logic}/{action}', function ($logic, $action) use ($app) {
    // Определяем полное имя класса логики
    $logic = implode('\\', array_map(function($item) {return ucfirst($item);}, explode('-', $logic)));
    $class_name = '\\Crm\\Logic\\' . $logic;
    if(!class_exists($class_name)) {
        $app->abort(404, "Logic " . $class_name . " does not exists");
    }

    // Добавляем параметры GET к параметрам POST
    $request = Logic::getRequest();
    $request->request->add($request->query->all());

    // Объявляем объект логики
    $logic_object = new $class_name();

    // Находим соответствующий шаблон
    $template = $logic . '/' . $action . '.twig';
    if (!file_exists($app['twig.path'] . $template)) {
        $app->abort(404, "Template " . $template . " does not exists");
        return $app->redirect('/');
    }

    $params = $logic_object->execute($action, $request->request->all());

    if (isset($params[Logic::OUTPUT_REDIRECT])) {
        return $app->redirect($params[Logic::OUTPUT_REDIRECT]);
    } else {
        $body = $app['twig']->render('header.twig');
        $body .= $app['twig']->render($template, $params);
        $body .= $app['twig']->render('footer.twig');
        return new Response ($body);
    }

});

/**
 * Handle route errors
 * Catch application exceptions
 */
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            return new Response($app['twig']->render('Error/404.twig', array(
                'message' => $e->getMessage()
            )));
            break;
    }
});

return $app;