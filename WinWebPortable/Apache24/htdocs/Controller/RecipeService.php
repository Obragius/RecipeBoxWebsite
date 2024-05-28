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
        $myRecipes = getRecipesAccess("getRecipeByID",$_REQUEST["recipeID"]);
        echo(json_encode($myRecipes[0]));
    }
}

?>