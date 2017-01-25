<?php

include_once("./middhp/middhp.php");

$app = new Application();

$app->get("/", function($req, $res){
    $res->render("index.tpl", array("name" => "John"));
    $res->end();
});

$app->run();

?>