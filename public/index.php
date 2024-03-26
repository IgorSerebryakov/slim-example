<?php

require __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$app->get('/users/new', function ($request, $response) {
    return $this->get('renderer')->render($response, "users/new.phtml");
});

$app->post('/users', function ($request, $response) {
    $user = $request->getParsedBodyParam('user');
    $id = uniqid();
    $user['id'] = $id;
    
    $users = file_get_contents("usersRepository.json");
    $decodedUsers = json_decode($users, true);
    if ($users == null) {
        $num = 1;
    } else {
        $count = count($decodedUsers);
        $num = $count + 1;
    }

    $currentUser = "user{$num}";
    $decodedUsers[$currentUser] = $user;
    $data = json_encode($decodedUsers);
    file_put_contents("usersRepository.json", $data);
    return $response->withRedirect('/users');
});

$app->get('/users', function ($request, $response) {
    $users = file_get_contents("usersRepository.json");
    $decodedUsers = json_decode($users, true);
    $params = [
        'users' => $decodedUsers
    ];
    
    return $this->get('renderer')->render($response, "users/users.phtml", $params);
});



$app->run();