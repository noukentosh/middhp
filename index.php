<?php

include_once("./middhp/middhp.php");

$db = new DataBase("mysqli://noukentosh@127.0.0.1/test");
$app = new Application();

$app->get("/", function($req, $res){
    global $db;
    $user = new User($db);
    $user->login = "user" . rand(1, 1000);
    $user->password = md5("user" . rand(1, 1000));
    $user->group = rand(1, 1000);
    $user->token = md5($user->login . rand(1, 1000));
    $user->save();
    $users = $user->find();
    $res->render("index.tpl", array("name" => "John", "users" => $users));
    $res->end();
});

$app->run();

?>