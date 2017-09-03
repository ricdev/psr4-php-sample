<?php namespace App; include_once("start.inc.php");

//$o = new App\Sample();
//var_dump($o->func());

$user = new User();
$user->email = "someemail@somedomain.com";
print_r($user);

$userCon = new UserController();
$result = $userCon->save($user);
print_r($result);

echo "<br>";echo "<br>";
$user = $userCon->find(1);
print_r($user );

echo "<br>";echo "<br>";
$user->email = "someemail123@1somedomain.com";
$result = $userCon->save($user); //since it has id, function will be update
print_r($user );

echo "<br>";echo "<br>";
$users = $userCon->findAll();
print_r($users );


print_r($result);