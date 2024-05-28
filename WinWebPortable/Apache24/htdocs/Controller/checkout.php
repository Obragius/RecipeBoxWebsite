<?php

//Include all the model files
require_once "DependencyControl.php";

session_start();

$checkoutComplete = false;

if (isset($_REQUEST["firstname"]))
{
    if($_REQUEST["firstname"] != "" && $_REQUEST["surname"] != "" && $_REQUEST["Address1"] != "" && $_REQUEST["Address2"] != "" && $_REQUEST["postcode"] != "" && $_REQUEST["town"] != "" && $_REQUEST["city"] != "" && $_REQUEST["country"] != "" && $_REQUEST["telephone"] != "")
    {
        //Create an address object
        $newAddress = new Address();
        $newAddress->lineOne = htmlentities($_REQUEST["Address1"]);
        $newAddress->lineTwo = htmlentities($_REQUEST["Address2"]);
        $newAddress->postcode = htmlentities($_REQUEST["postcode"]);
        $newAddress->town = htmlentities($_REQUEST["town"]);
        $newAddress->city = htmlentities($_REQUEST["city"]);
        $newAddress->country = htmlentities($_REQUEST["country"]);

        //Create an user object
        $newUser = new Account();
        $newUser->firstname = htmlentities($_REQUEST["firstname"]);
        $newUser->surname = htmlentities($_REQUEST["surname"]);
        $newUser->address = $newAddress;
        $newUser->telephone = htmlentities($_REQUEST["telephone"]);

        $newAccountFlag = true;
        if ($_REQUEST["auto"] == "true")
        {
            $newAccountFlag = false;
            $newUser = $_SESSION["user"];
        }

        $orderComplete = makeAnOrder($newUser,$_SESSION["Cart"],$newAccountFlag);
        if ($orderComplete)
        {
            unset($_SESSION["Cart"]);
            $checkoutComplete = true;
        }
    }
}

$numberOfItems = 0;
if (isset($_SESSION["Cart"]))
{
    foreach ($_SESSION["Cart"] as $singleRecipe)
    {
        $numberOfItems += $singleRecipe[1];
    }
}




//Display the view to the user
require_once "../View/checkoutView.php";

?>