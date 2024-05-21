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

if (isset($_REQUEST["search"]) && $_REQUEST["search"] != "")
{
    if ($_REQUEST["search_value"] == "Name")
    {
        $recipeTitle = htmlentities($_REQUEST["search"]);
        $recipeList = getRecipesAccess("getRecipeLikeTitle",$recipeTitle);
    }
    elseif ($_REQUEST["search_value"] == "Food")
    {
        $foodName = htmlentities($_REQUEST["search"]);
        $givenFood = getFoodLikeName($foodName);
        if ($givenFood != null)
        {
            $recipeIDList = getRecipeIDByFoodID($givenFood->foodID);
            $recipeList = [];
            foreach ($recipeIDList as $singleID)
            {
                array_push($recipeList,getRecipesAccess("getRecipeByID",$singleID[0])[0]);
            }
        }
        else
        {
            $recipeList = [];
        }
    }
    elseif ($_REQUEST["search_value"] == "Tag")
    {
        $recipeTag= htmlentities($_REQUEST["search"]);
        $recipeList = getRecipesAccess("getRecipeLikeTag",$recipeTag);
    }
    $_SESSION["SearchList"] = $recipeList;
}
else
{
    if (isset($_SESSION["SearchList"]) && isset($_REQUEST["cart"]) == true)
    {
        $recipeList = $_SESSION["SearchList"];
    }
    else
    {
        //Get all recipes from the database
        $recipeList = getRecipesAccess(null, null);
        unset($_SESSION["SearchList"]);
    }
}

$numberOfItems = 0;
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
}

if (isset($_SESSION["Cart"]))
{
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
}


//Load the view to display output to the user
require_once "../View/homeView.php";

?>