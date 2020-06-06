<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use DI\ContainerBuilder;
use todo\includes\Lists;
/*############### includes for connection library and classes###############*/
require_once(dirname(__DIR__). "/todo/includes/idiorm.php");
require_once(dirname(__DIR__). "/todo/includes/connect.php");
require_once(dirname(__DIR__). "/todo/includes/classes.php");
/*########################################################################*/
require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->get('/', function (Request $request, Response $response, $args) {
	$renderer = new PhpRenderer('../todo');
	$lists = \ORM::for_table('list')->order_by_asc('t_order')->find_array();
    return $renderer->render($response, "index.php",  ['alllist' => $lists]);
});
/*############### Routes Start From Here ###############*/

/*############### insert call ###############*/
$app->post('/insert', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	//echo "<pre>";var_dump($data);echo"</pre>";
	$list = $postdata["list"];
	$insert = $obj->insert($list);
	if($insert =="success"){
		$view =  $obj->viewallspecified();
		$response->getBody()->write($view);
    	return $response;
		
	   }
});
/*############### insert call ###############*/

/*############### colorupdate call ###############*/
$app->post('/colorupdtae', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	$id = $postdata["id"];
	$color = $postdata["color"];
	$obj->updatecolour($color,$id);
	$view =  $obj->viewallspecified();
	$response->getBody()->write($view);
	return $response;
});
/*############### colorupdate call ###############*/

/*############### markread call ###############*/
$app->post('/markread', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	$id = $postdata["id"];
	$obj->updatemark($id);
	$view =  $obj->viewallspecified();
	$response->getBody()->write($view);
	return $response;
});
/*############### markread call ###############*/

/*############### updatetext call ###############*/
$app->post('/updatetext', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	$id = $postdata["id"];
	$text = $postdata["text"];
	$obj-> updatetext($text,$id);
	$view =  $obj->viewallspecified();
	$response->getBody()->write($view);
	return $response;
});
/*############### updatetext call ###############*/

/*############### delete call ###############*/
$app->post('/delete', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	$id = $postdata["id"];
	$obj->deletethat($id);
	$view =  $obj->viewallspecified();
	$response->getBody()->write($view);
	return $response;
});
/*############### delete call ###############*/

/*############### updatepositions call ###############*/
$app->post('/updatepositions', function (Request $request, Response $response, $args) {
	$obj = new Lists();
	$postdata = $request->getParsedBody();
	foreach ($postdata["value"] as $key => $value) {
		$obj-> updateposition($key,$value);
	}
	$view =  $obj->viewallspecified();
	$response->getBody()->write($view);
	return $response;
});
/*############### updatepositions call ###############*/

/*############### Routes end From Here ###############*/
$app->run();
