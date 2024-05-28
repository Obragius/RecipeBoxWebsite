<?php

//Include all the model files
require_once "DependencyControl.php";

// Start the session
session_start();

if (isset($_REQUEST["remove"]))
{
    if ($_SESSION["Cart"][$_REQUEST["remove"]][1] == 1)
    {
        unset($_SESSION["Cart"][$_REQUEST["remove"]]);
    }
    else
    {
        $_SESSION["Cart"][$_REQUEST["remove"]][1] -= 1;
    }
}

if (isset($_SESSION["Cart"]))
{
    $cartRecipes = [];
    foreach( $_SESSION["Cart"] as $recipe )
    {
        $newCartRecipe = getRecipesAccess("getRecipeByTitle",$recipe[0]);
        array_push($cartRecipes,[$newCartRecipe,$recipe[1]]);
    }
    
}

$redirect = false;
if ($cartRecipes == [])
{
    $redirect = true;
}

$numberOfItems = 0;
if (isset($_SESSION["Cart"]))
{
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
}

require_once "../View/cartView.php";


?>