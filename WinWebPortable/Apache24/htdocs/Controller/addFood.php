<?php

//Include all the model files
require_once "DependencyControl.php";

session_start();

if (isset($_REQUEST["Add"]) && $_REQUEST["foodName"] != "")
{

    //Create a food object
    $newFood = new Food();
    $newFood->foodName = htmlentities($_REQUEST["foodName"]);
    $newFood->foodTag = htmlentities($_REQUEST["foodTag"]);
    $newFood->foodCost = htmlentities($_REQUEST["foodCost"]);
    $newFood->foodDescription = htmlentities($_REQUEST["foodDescription"]);
    $newFood->foodUnit = htmlentities($_REQUEST["foodUnit"]);

    $newFood->calories = htmlentities($_REQUEST["calories"]);
    $newFood->carbohydrates = htmlentities($_REQUEST["carbohydrates"]);
    $newFood->protein = htmlentities($_REQUEST["protein"]);
    $newFood->fat = htmlentities($_REQUEST["fat"]);

    //Run the query to add this to the database
    insertFood($newFood);
}

$foodList = getAllFoods();


if (isset($_REQUEST["Edit"]))
{
    //Get the food by name
    $myFood = getFoodByID($_REQUEST["food_edit"]);
}
else
{
    $myFood = null;
}


// Only admin would have access to this page even if direct link is used (Security)
if (isset($_SESSION["user"]))
{
    if ($_SESSION["user"]->isAdmin())
    {
        //Display the view to the admin
        require_once "../View/addFoodView.php";
    }
}


?>