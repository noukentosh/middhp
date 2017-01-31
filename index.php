<?php

include_once("./middhp/middhp.php");

$db = new DataBase("mysqli://noukentosh@127.0.0.1/test");
$app = new Application();

$app->get("/", function($req, $res){
    global $db;
    $user = new User($db);
    $users = $user->findOne(array("login" => "admin"));
    var_dump($users);
    //$res->render("index.tpl", array("name" => "John", "users" => $users));
    $res->end();
});

$app->run();

?>