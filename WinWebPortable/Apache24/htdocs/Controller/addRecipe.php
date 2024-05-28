<?php

//Include all the model files
require_once "DependencyControl.php";

// Start session to allow to add and delete food entries to the recipe
session_start();

// Set the food count variable which is used in the view and set the session variable for the first time
if (isset($_SESSION["foodCount"]))
{
    $foodCount = $_SESSION["foodCount"];
}
else
{
    $_SESSION["foodCount"] = 0;
    $foodCount = 0;
}

// Logic to add more food entries or delete some food entries
if (isset($_REQUEST["AddFood"])) 
{
    if ($_REQUEST["AddFood"] == "addFood")
    {
        $_SESSION["foodCount"] = $foodCount + 1;
    }
    if ($_REQUEST["AddFood"] == "delFood") 
    {
        $_SESSION["foodCount"] = $foodCount - 1;
        if ($_SESSION["foodCount"] < 0) 
        {
            $_SESSION["foodCount"] = 0;
        }
    }
}
// All the page to load the correct number of food entires at current time
$foodCount = $_SESSION["foodCount"];

// Get the list of foods allowed to be part of a recipe
$foodList = getAllFoods();

if (isset($_REQUEST["recipeTitle"]) && $_REQUEST["recipeTitle"] != "" && $_REQUEST["recipeImage"] != "" && isset($_REQUEST["submitRecipe"]))
{
    // Create a recipe object
    $newRecipe = new Recipe();
    $newRecipe->title = htmlentities($_REQUEST["recipeTitle"]);
    $newRecipe->description = htmlentities($_REQUEST["recipeDescription"]);
    $newRecipe->steps = htmlentities($_REQUEST["recipeSteps"]);
    $newRecipe->image = htmlentities($_REQUEST["recipeImage"]);
    $newRecipe->recipeAddedCost = htmlentities($_REQUEST["recipeAddedCost"]);
    $newRecipe->recipeTags = htmlentities($_REQUEST["recipeTags"]);


    // Check all the ingridients added and create FoodQuantity objects
    $ingridientCount = 0;
    while (isset($_REQUEST["food_".strval($ingridientCount)]))
    {
        $foodObject = null;
        foreach ($foodList as $singleFood)
        {
            if ($singleFood->foodID == $_REQUEST["food_".strval($ingridientCount)])
            {
                $foodObject = $singleFood;
            }
        }
        $newQuantityObject = new FoodQuantity();
        $newQuantityObject->count = htmlentities($_REQUEST["foodCount_".strval($ingridientCount)]);
        $newQuantityObject->amount = htmlentities($_REQUEST["foodAmount_".strval($ingridientCount)]);
        $newRecipe->addFood($foodObject,$newQuantityObject);
        $ingridientCount += 1;
        
    }

    // Send this object to the data access to input to the database
    insertRecipe($newRecipe);

}

//Get all recipes
$recipeList = getRecipesAccess(null,null);

if (isset($_REQUEST["Edit"]))
{
    //Get the recipe by id
    $myRecipe = null;
    foreach ($recipeList as $singleRecipe)
    {
        if ($_REQUEST["recipe_edit"] == $singleRecipe->recipeID)
        {
            $myRecipe = $singleRecipe;
            $foodCount = sizeof($myRecipe->foodList);
            $foodToDisplay = $myRecipe->foodList;
        }
    }
    
}
else
{
    $myRecipe = null;
}

// Only admin would have access to this page even if direct link is used (Security)
if (isset($_SESSION["user"]))
{
    if ($_SESSION["user"]->isAdmin())
    {
        //Display the view to the admin
        require_once "../View/addRecipeView.php";
    }
}

?>