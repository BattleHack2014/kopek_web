<?php

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Crm\Logic\Logic;

/* @var $app Silex\Application */
$app = require_once ROOT_PATH.'/config/app.php';

/**
 * Роут для клиентских событий
 * {logic} - для вызова классов логики в субдиректориях необходимо передавать названия логик через тире
 * Пример: /client/syoss/3/work-review/add - обращение к классу Logic/Client/Work/Review
 */
$app->match('/client/{project}/{campaign_id}/{logic}/{action}', function ($project, $campaign_id, $logic, $action) use ($app) {
    $available_projects = array(
        'autotest',
        'cinema',
        'syoss'
    );

    if (!in_array($project, $available_projects)) {
        return $app->abort(404, "Проекта не существует");
    }

    define('PROJECT', $project);
    define('CAMPAIGN_ID', $campaign_id);

    /**
     * Определяем полное имя класса логики
     * Для вызова классов логики в субдиректориях необходимо передавать названия логик через тире
     * Пример: /client/syoss/3/work-review/add - обращение к классу Logic/Client/Work/Review
     */
    $logic = implode('\\', array_map(function($item) {return ucfirst($item);}, explode('-', $logic)));
    $class_name = '\\Crm\\Logic\\Client\\' . $logic;

    if(!class_exists($class_name))
        return $app->redirect('/');

    $request = Logic::getRequest();
    //TODO: Temp code
    // Добавляем параметры GET к параметрам POST
    $request->request->add($request->query->all());

    // Объявляем объект логики
    $logic_object = new $class_name();
    return new Response (
        json_encode_cyr($logic_object->execute($action, $request->request->all())),
        200,
        array('content-type' => 'application/json; charset=utf-8')
    );
});

/**
 * Роут RESTFul: PUT
 */
$app->put('/rest/{logic}/{id}', function ($logic, $id) use ($app) {
    $params = file_get_contents("php://input");
    if (!$json_params = json_decode($params, true))
        return $app->abort(404, "Неверные аргументы");

    Logic::getRequest()->request->add($json_params);

    return $app->handle(
        Request::create('/'.$logic.'/save' , 'POST'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Роут RESTFul: POST
 */
$app->post('/rest/{logic}/{id}', function ($logic, $id) use ($app) {
    Logic::getRequest()->request->add(array('id' => $id));

    return $app->handle(
        Request::create('/'.$logic.'/save' , 'POST'),
        HttpKernelInterface::SUB_REQUEST
    );
});

/**
 * Роут RESTFul: GET/DELETE
 */
$app->match('/rest/{logic}/{action}/{id}', function ($logic, $action, $id) use ($app) {
    Logic::getRequest()->request->add(array('id' => $id));

    return $app->handle(
        Request::create('/'.$logic.'/'.$action, 'GET'),
        HttpKernelInterface::SUB_REQUEST
    );
});


/**
 * Роут для событий админки
 */
$app->match('/{logic}/{action}', function ($logic, $action) use ($app) {
    // определяем полное имя класса логики
	$class_name = '\\Crm\\Logic\\'.ucfirst(AREA).'\\' . ucfirst($logic);
    if(!class_exists($class_name))
        return $app->redirect('/');
    $request = Logic::getRequest();
    //TODO: Temp code
    // Добавляем параметры GET к параметрам POST
    $request->request->add($request->query->all());

    // Объявляем объект логики
    $logic_object = new $class_name();

    return new Response (
        json_encode_cyr($logic_object->execute($action, $request->request->all())),
        200,
        array('content-type' => 'application/json; charset=utf-8')
    );
});

// Все ошибки, любой конкретный exception можно обработать здесь
$app->error(function (\Exception $e, $code) {

    switch ($code) {
        case 404:
            return new Response(json_encode_cyr(array(
                Logic::OUTPUT_STATUS => $code,
                Logic::OUTPUT_MESSAGE => $e->getMessage(),
            )));
            break;
    }
});

/**
 * Костыль позволяющий использовать русские символы в json_encode()
 */
function json_encode_cyr($str) {
    $arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
        '\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
        '\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
        '\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
        '\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
        '\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
        '\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
        '\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
    $arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
        'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
        'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
        'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
    $str1 = json_encode($str);
    $str2 = str_replace($arr_replace_utf,$arr_replace_cyr,$str1);
    return $str2;
}

return $app;
?>