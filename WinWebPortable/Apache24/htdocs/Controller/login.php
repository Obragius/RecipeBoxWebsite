<?php

//Include all the model files
require_once "DependencyControl.php";

// Start session to login user
session_start();

// Set the redirect boolean 
$redirect = false;

// Set response for the user
$response = "";

if (isset($_REQUEST["Username"]))
{
    $loginUser = getUserByUsername($_REQUEST["Username"]);

    if ($loginUser == null)
    {
        $response = "User not found";
    }
    else
    {

        if (password_verify($_REQUEST["Password"],$loginUser->password))
        {
            $redirect = true;
            $givenAddress = getAddressByID($loginUser->addressID);
            $loginUser->address = $givenAddress;
            $_SESSION["user"] = $loginUser;
        }
        else
        {
            $response = "Incorrect password";
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
require_once "../View/loginView.php";

?>