<?php

//Include all the model files
require_once "DependencyControl.php";

session_start();

if (isset($_REQUEST["username"]))
{
   // Check that they have inputted username and password
   if ($_REQUEST["username"] != "" && $_REQUEST["password"] != "")
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
      $newUser->username = htmlentities($_REQUEST["username"]);
      $newUser->password = password_hash(htmlentities($_REQUEST["password"]),PASSWORD_DEFAULT);

      createAccount($newUser);
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
require_once "../View/createAccountView.php";

?>