<?php

$users = file_get_contents("usersRepository.json");

var_dump($users);

$decoded = json_decode($users, true);

var_dump($decoded);

$arr = ['user' => [
    'nickname' => 'pasha',
    'id' => 34
],
    'user2' => [
        'nick' => 'igor',
        'id' => 15
    ]];

$json = json_encode($arr);
$json_arr = json_decode($json, true);
$count = count($json_arr);
print_r($json);

$arr2 = ['1' => '12', '2' => '122'];
$newArr["user2"] = $arr2;
$newArr["user3"] = $arr2;
var_dump($newArr);