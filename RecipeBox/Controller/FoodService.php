<?php

//Include all the model files
require_once "DependencyControl.php";

// Start the session
session_start();
header('Content-Type: application/json');

if (isset($_SESSION["user"]))
{
    if ($_SESSION["user"]->isAdmin())
    {
        {
            $myFoods = getAllFoods();
            echo(json_encode($myFoods));
        }
    }
}

?>