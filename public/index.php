<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Validator;
use DI\Container;
use Slim\Factory\AppFactory;

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$app->post('/users', function ($request, $response) {
    $user = $request->getParsedBodyParam('user');
    $data = json_encode($user);
    file_put_contents("../../userRepository.php", $data);
    return $response->withRedirect('/users', 302);
});

$app->get('/users/new', function ($request, $response) {
    return $this->get('renderer')->render($response, "users/new.phtml");
});

$app->run();