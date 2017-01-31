<?php

set_error_handler(function($errno, $errstr, $errfile, $errline){
    echo "<table><tr><td><b>{$errfile}: {$errline}</b></td><td>Error {$errno}: {$errstr}</td></tr></table>";
});

include_once("./middhp/Fenom.php");

include_once("./middhp/include/application.php");
include_once("./middhp/include/request.php");
include_once("./middhp/include/response.php");
include_once("./middhp/include/messages.php");
include_once("./middhp/include/renderer.php");
include_once("./middhp/include/route.php");
include_once("./middhp/p2regexp.php");
include_once("./middhp/include/database.php");
include_once("./middhp/include/db/model.php");

?>