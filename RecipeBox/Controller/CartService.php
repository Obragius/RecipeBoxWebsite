<?php

//Include all the model files
require_once "DependencyControl.php";

// Start the session
session_start();

if (isset($_REQUEST["addRecipeName"]))
{


    if (isset($_SESSION["Cart"]))
    {
        if (isset($_SESSION["Cart"][$_REQUEST["addRecipeName"]]))
        {
            $_SESSION["Cart"][$_REQUEST["addRecipeName"]][1] = $_SESSION["Cart"][$_REQUEST["addRecipeName"]][1] + 1;
        }
        else
        {
            $_SESSION["Cart"][$_REQUEST["addRecipeName"]] = [$_REQUEST["addRecipeName"],1];
        }
    }
    else
    {
        $_SESSION["Cart"] = [];
        $_SESSION["Cart"][$_REQUEST["addRecipeName"]] = [$_REQUEST["addRecipeName"],1];
    }
    $numberOfItems = 0;
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
    echo ($numberOfItems);
}

if (isset($_REQUEST["removeRecipeName"]))
{

    if ($_SESSION["Cart"][$_REQUEST["removeRecipeName"]][1] == 1)
    {
        unset($_SESSION["Cart"][$_REQUEST["removeRecipeName"]]);
    }
    else
    {
        $_SESSION["Cart"][$_REQUEST["removeRecipeName"]][1] -= 1;
    }
    $numberOfItems = 0;
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
    echo ($numberOfItems);
}

?>