<?php

//Include all the model files
require_once "DependencyControl.php";

//Check if the user wants to logout
if (isset($_REQUEST["logout"]))
{
    session_start();
    session_destroy();
}

// Start session to see if the user is logged in
session_start();

if (isset($_GET["name"]) && $_GET["name"] != "")
{
    $recipeTitle = htmlentities($_GET["name"]);
    $recipeList = getRecipesAccess("getRecipeByTitle",$recipeTitle);
}
else
{
    //Get all recipes from the database
    $recipeList = getRecipesAccess(null, null);
}

// Code to add a recipe to the cart
if (isset($_REQUEST["cart"]))
{
    if (isset($_SESSION["Cart"]))
    {
        if (isset($_SESSION["Cart"][$_REQUEST["cart"]]))
        {
            $_SESSION["Cart"][$_REQUEST["cart"]][1] = $_SESSION["Cart"][$_REQUEST["cart"]][1] + 1;
        }
        else
        {
            $_SESSION["Cart"][$_REQUEST["cart"]] = [$_REQUEST["cart"],1];
        }
    }
    else
    {
        $_SESSION["Cart"] = [];
        $_SESSION["Cart"][$_REQUEST["cart"]] = [$_REQUEST["cart"],1];
    }
    $recipeList = getRecipesAccess("getRecipeByTitle",$_REQUEST["cart"]);
}

$numberOfItems = 0;
if (isset($_SESSION["Cart"]))
{
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
}

//Load the view to display output to the user
require_once "../View/singleRecipeView.php";

?>