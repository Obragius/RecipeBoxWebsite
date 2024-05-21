<?php

//Include all the model files
require_once "DependencyControl.php";

session_start();
header('Content-Type: application/json');

$autofill = false;
if (isset($_REQUEST["autofill"]))
{
    if (isset($_SESSION["user"]))
    {
        echo (json_encode($_SESSION["user"]));
    }
}


?>