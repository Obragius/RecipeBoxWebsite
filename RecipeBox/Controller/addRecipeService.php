<?php

//Include all the model files
require_once "DependencyControl.php";

// Start the session
session_start();

if (isset($_SESSION["user"]))
{
    if ($_SESSION["user"]->isAdmin())
    {
        $myObject = json_decode($_REQUEST["object"]);
        // Get the list of foods allowed to be part of a recipe
        $foodList = getAllFoods();
        $recipeIndex = sizeof($myObject)-1;

        if ( $myObject[$recipeIndex]->recipeTitle != "" && $myObject[$recipeIndex]->recipeImage != "")
        {
            $newRecipe = new Recipe();

            // To make sure edit works we need to delete all values of previous recipe in foodlist
            $recipeList = getRecipesAccess("getRecipeByTitle",htmlentities($myObject[$recipeIndex]->recipeTitle));
            if ($recipeList != [])
            {
                $recipeID = $recipeList[0]->recipeID;
                deleteFoodListOnChange($recipeID);
                $newRecipe->localID = $recipeID;
            }
            else
            {
                $newRecipe->localID = null;
            }

            // Create a recipe object
            $newRecipe->title = htmlentities($myObject[$recipeIndex]->recipeTitle);
            $newRecipe->description = htmlentities($myObject[$recipeIndex]->recipeDescription);

            // I will not use htmlentities on this line because it maked ; separated lists imposible,
            // This should be fine because only only admin people have access to this service and therfore there
            // is no high likelyhood this will be targeted as well as not affecting sql security
            $newRecipe->steps = $myObject[$recipeIndex]->recipeSteps;
            $newRecipe->image = htmlentities($myObject[$recipeIndex]->recipeImage);
            $newRecipe->recipeAddedCost = htmlentities($myObject[$recipeIndex]->recipeAddedCost);
            $newRecipe->recipeTags = htmlentities($myObject[$recipeIndex]->recipeTags);


            // Check all the ingridients added and create FoodQuantity objects
            $ingridientCount = intval($myObject[$recipeIndex]->ingridientCount);
            for ($i = 0; $i < $ingridientCount;$i++)
            {
                $foodObject = null;
                foreach ($foodList as $singleFood)
                {
                    if ($singleFood->foodID == $myObject[$i]->food)
                    {
                        $foodObject = $singleFood;
                    }
                }
                $newQuantityObject = new FoodQuantity();
                $newQuantityObject->count = htmlentities( $myObject[$i]->foodCount);
                $newQuantityObject->amount = htmlentities( $myObject[$i]->foodAmount);
                $newRecipe->addFood($foodObject,$newQuantityObject);               
            }

            // Send this object to the data access to input to the database
            insertRecipe($newRecipe);
            // Echo to the JS controller that the recipe has been sucesfully added
            echo("Recipe Added");
        }
    }
}

?>