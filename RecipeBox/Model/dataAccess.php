<?php 

// The constant database login attributes
$DBUSER = "k1801606";
$DBPASS = "ieshikub";
$DBNAME = "db_k1801606";

// Connection to the database
$pdo = new PDO("mysql:host=localhost;dbname=$DBNAME", "$DBUSER", "$DBPASS", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Will insert new food and their nutrition to the database
function insertFood($foodObject)
{
    global $pdo;

    // Insert the new food object into the database
    $statement = $pdo->prepare("INSERT INTO Food (foodName,foodTag,foodCost,foodDescription,foodUnit, calories, carbohydrates, protein, fat)
                                VALUES (:foodName,:foodTag,:foodCost,:foodDescription,:foodUnit,:calories,:carbohydrates,:protein,:fat)
                                ON DUPLICATE KEY UPDATE foodName=:foodName,foodTag=:foodTag,foodCost=:foodCost,foodDescription=:foodDescription,
                                foodUnit=:foodUnit,calories=:calories,carbohydrates=:carbohydrates,protein=:protein,fat=:fat");
    $statement->bindValue(":foodName",$foodObject->foodName);
    $statement->bindValue(":foodTag",$foodObject->foodTag);
    $statement->bindValue(":foodCost",$foodObject->foodCost,PDO::PARAM_INT);
    $statement->bindValue(":foodDescription",$foodObject->foodDescription);
    $statement->bindValue(":foodUnit",$foodObject->foodUnit);
    $statement->bindValue(":calories",$foodObject->calories,PDO::PARAM_INT);
    $statement->bindValue(":carbohydrates",$foodObject->carbohydrates,PDO::PARAM_INT);
    $statement->bindValue(":protein",$foodObject->protein,PDO::PARAM_INT);
    $statement->bindValue(":fat",$foodObject->fat,PDO::PARAM_INT);
    $statement->execute();
}

// Will retrieve all the foods with their nutrition values
function getAllFoods()
{
    global $pdo;

    //Get all the food records
    $statement = $pdo->query("SELECT * FROM Food");
    $statement->execute();
    $foodList = $statement->fetchAll(PDO::FETCH_CLASS, "Food");

    //Return the list of food object which already have nutrition object attached as attributes
    return $foodList;
}

// Will retrieve one food object by ID
function getFoodByID($id)
{
    global $pdo;

    //Get food by this id
    $statement = $pdo->prepare("SELECT * FROM Food WHERE foodID = ?");
    $statement->execute([$id]);
    $foodList = $statement->fetchAll(PDO::FETCH_CLASS, "Food");

    //Return the the one object found
    return $foodList[0];
}

// Will retrieve one food object by name
function getFoodByName($name)
{
    global $pdo;

    //Get food by this name
    $statement = $pdo->prepare("SELECT * FROM Food WHERE foodName = ?");
    $statement->execute([$name]);
    $foodList = $statement->fetchAll(PDO::FETCH_CLASS, "Food");

    //Return the the one object found
    if ($foodList != null)
    {
        return $foodList[0];
    }
    return null;
}

// Will retrieve one food which is like the user input
function getFoodLikeName($name)
{
    global $pdo;

    //Get food like this name
    $statement = $pdo->prepare("SELECT * FROM Food WHERE foodName LIKE ?");
    $statement->execute(["%".$name."%"]);
    $foodList = $statement->fetchAll(PDO::FETCH_CLASS, "Food");

    //Return the the one object found
    if ($foodList != null)
    {
        return $foodList[0];
    }
    return null;
}

// Will retrieve all recipes ID's for a given food ID

function getRecipeIDByFoodID($id)
{
    global $pdo;

    //Get recipe ID by this food ID
    $statement = $pdo->prepare("SELECT recipeID FROM FoodList WHERE foodID = ?");
    $statement->execute([$id]);
    $foodList = $statement->fetchAll();

    //Return the number found
    return $foodList;
}


// Will insert the new recipe into the database
function insertRecipe($recipeObject)
{
    global $pdo;

    // For each recipe the tags need to be updated with the food tags
    $additionalRecipeTags = [];
    foreach ($recipeObject->foodList as $foodObj)
    {
        array_push($additionalRecipeTags,$foodObj->foodTag);
    }
    // Get only the unique values
    $additionalRecipeTags = array_unique($additionalRecipeTags);
    // Add all the food tags to the recipe tags
    foreach ($additionalRecipeTags as $tag)
    {
        $tagsList = explode(",",$tag);
        foreach ($tagsList as $separateTag)
        {
            if ($separateTag != "")
            {
                $recipeObject->recipeTags = str_replace(",".$separateTag,"",$recipeObject->recipeTags);
                $recipeObject->recipeTags = $recipeObject->recipeTags.",".$separateTag;
            }
        }
    }
    // Remove all the spaces from tags to display correctly
    $recipeObject->recipeTags = str_replace(" ","",$recipeObject->recipeTags);

    // Prepare the statement and insert the database record
    $statement = $pdo->prepare("INSERT INTO Recipe (title,description,steps,image,recipeAddedCost,recipeTags)
                                VALUES (:recipeTitle,:recipeDescription,:recipeSteps,:recipeImage,:recipeAddedCost,:recipeTags)
                                ON DUPLICATE KEY UPDATE title=:recipeTitle,description=:recipeDescription,steps=:recipeSteps,
                                image=:recipeImage,recipeAddedCost=:recipeAddedCost,recipeTags=:recipeTags");
    $statement->bindValue(":recipeTitle",$recipeObject->title);
    $statement->bindValue(":recipeDescription",$recipeObject->description);
    $statement->bindValue(":recipeSteps",$recipeObject->steps);
    $statement->bindValue(":recipeImage",$recipeObject->image);
    $statement->bindValue(":recipeAddedCost",$recipeObject->recipeAddedCost);
    $statement->bindValue(":recipeTags",$recipeObject->recipeTags);
    $statement->execute();

    // Get the id of the recipe record
    if ($recipeObject->localID != null)
    {
        $nutritionID = $recipeObject->localID;
    }
    else
    {
        $nutritionID = $pdo->lastinsertId();
    }

    // For each ingridient 
    $loopCount = 0;
    foreach ($recipeObject->foodList as $foodObj)
    {
        $statement = $pdo->prepare("INSERT INTO FoodList (recipeID,foodID,count,amount)
                                    VALUES (:recipeID,:foodID,:count,:amount)
                                    ON DUPLICATE KEY UPDATE recipeID=:recipeID,foodID=:foodID,count=:count,amount=:amount");
        $statement->bindValue(":recipeID", $nutritionID,PDO::PARAM_INT);
        $statement->bindValue(":foodID", $foodObj->foodID,PDO::PARAM_INT);
        $statement->bindValue(":count", $recipeObject->foodQuantity[$loopCount]->count,PDO::PARAM_INT);
        $statement->bindValue(":amount", $recipeObject->foodQuantity[$loopCount]->amount,PDO::PARAM_INT);
        $statement->execute();
        $loopCount += 1;

    }

}


// When updating the recipe delete all recipe to ingridient connection
function deleteFoodListOnChange($recipeID)
{
    global $pdo;
    // Prepare the statement and delete all food list rows associated with this recipe
    $statement = $pdo->prepare("DELETE FROM FoodList WHERE recipeID = ?");
    $statement->execute([$recipeID]);

    return true;
}

// Will return all recipe records
function getAllRecipes()
{
    global $pdo;

    // Prepare the statement and execute to get all recipe objects
    $statement = $pdo->prepare(" SELECT * FROM Recipe ");
    $statement->execute();
    $recipeList = $statement->fetchAll(PDO::FETCH_CLASS, "Recipe");

    return $recipeList;


}


// Will return all recipe objects which match a recipe title
function getRecipeByTitle($recipeTitle)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Recipe WHERE title = ?");
    $statement->execute([$recipeTitle]);
    $recipeList = $statement->fetchAll(PDO::FETCH_CLASS, "Recipe");

    return $recipeList;

}

// Will return all recipe objects which are like the user input
function getRecipeLikeTitle($recipeTitle)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Recipe WHERE title LIKE ?");
    $statement->execute(["%".$recipeTitle."%"]);
    $recipeList = $statement->fetchAll(PDO::FETCH_CLASS, "Recipe");

    return $recipeList;

}

// Will return all recipe objects which have tags like user input
function getRecipeLikeTag($recipeTag)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM Recipe WHERE recipeTags LIKE ?");
    $statement->execute(["%".$recipeTag."%"]);
    $recipeList = $statement->fetchAll(PDO::FETCH_CLASS, "Recipe");

    return $recipeList;

}

// Will return all recipe objects which match this ID
function getRecipeByID($recipeID)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Recipe WHERE recipeID = ?");
    $statement->execute([$recipeID]);
    $recipeList = $statement->fetchAll(PDO::FETCH_CLASS, "Recipe");

    return $recipeList;
}

// This function controls all recipe related access methods, because to build the recipe
// it needs to be filled with the food objects no matter which method was used to aquire
// the recipe object, therfore this is a control center for recipe access
function getRecipesAccess($function, $args)
{
    global $pdo;

    //Get all ingridient objects
    $foodList = getAllFoods();

    //Get all food list tables to map recipes to foods
    $statement = $pdo->prepare(" SELECT * FROM FoodList");
    $statement->execute();
    $foodConnection = $statement->fetchAll();

    if ($function == null)
    {
        $recipeList = getAllRecipes();
    }
    else
    {
        $recipeList = $function($args);
    }


    // For each item in the connection table add the ingridient as an object to the recipe
    foreach ($foodConnection as $singleConnection)
    {
        foreach($recipeList as $singleRecipe)
        {
            if ($singleRecipe->recipeID == $singleConnection["recipeID"])
            {
                foreach ($foodList as $singleFood)
                {
                    if ($singleFood->foodID == $singleConnection["foodID"])
                    {
                        $singleFoodQuantity = new FoodQuantity();
                        $singleFoodQuantity->count = $singleConnection["count"];
                        $singleFoodQuantity->amount = $singleConnection["amount"];

                        $singleRecipe->addFood($singleFood,$singleFoodQuantity);
                    }
                }
            }
        }
    }

    foreach ($recipeList as $singleRecipe)
    {
        // These methods make the recipe initilised, so that all the information is diplayed correctly
        $singleRecipe->makeStepsList();
        $singleRecipe->calculateCost();
        $singleRecipe->gatherTags();
    }

    return $recipeList;
}

// Will insert new account record to the database
function createAccount($userObject)
{

    global $pdo;

    // Prepare the statement and insert the database record
    $statement = $pdo->prepare("INSERT INTO Address (lineOne,lineTwo,postCode,town,city,country)
    VALUES (:lineOne,:lineTwo,:postcode,:town,:city,:country)");
    $statement->bindValue(":lineOne",$userObject->address->lineOne);
    $statement->bindValue(":lineTwo",$userObject->address->lineTwo);
    $statement->bindValue(":postcode",$userObject->address->postcode);
    $statement->bindValue(":town",$userObject->address->town);
    $statement->bindValue(":city",$userObject->address->city);
    $statement->bindValue(":country",$userObject->address->country);
    $statement->execute();

    // Get the id of the recipe record
    $AddressID = $pdo->lastinsertId();

    $statement = $pdo->prepare("INSERT INTO Account (firstname,surname,addressID,telephone,username,password)
    VALUES (:firstname,:surname,:address,:telephone,:username,:password)");
    $statement->bindValue(":firstname",$userObject->firstname);
    $statement->bindValue(":surname",$userObject->surname);
    $statement->bindValue(":address",$AddressID,PDO::PARAM_INT);
    $statement->bindValue(":telephone",$userObject->telephone);
    $statement->bindValue(":username",$userObject->username);
    $statement->bindValue(":password",$userObject->password);
    $statement->execute();

}

// Insert all neceserry information to fufill an order
function makeAnOrder($userObject,$recipeList,$newAccountFlag)
{

    global $pdo;
    if ($newAccountFlag)
    {
        // Prepare the statement and insert the database record
        $statement = $pdo->prepare("INSERT INTO Address (lineOne,lineTwo,postCode,town,city,country)
        VALUES (:lineOne,:lineTwo,:postcode,:town,:city,:country)");
        $statement->bindValue(":lineOne",$userObject->address->lineOne);
        $statement->bindValue(":lineTwo",$userObject->address->lineTwo);
        $statement->bindValue(":postcode",$userObject->address->postcode);
        $statement->bindValue(":town",$userObject->address->town);
        $statement->bindValue(":city",$userObject->address->city);
        $statement->bindValue(":country",$userObject->address->country);
        $statement->execute();

        // Get the id of the address id
        $AddressID = $pdo->lastinsertId();
    }
    else
    {
        $AddressID = $userObject->address->addressID;
    }
    // If new account, insert in database

    if ($newAccountFlag)
    {

        $statement = $pdo->prepare("INSERT INTO Account (firstname,surname,addressID,telephone)
        VALUES (:firstname,:surname,:address,:telephone)");
        $statement->bindValue(":firstname",$userObject->firstname);
        $statement->bindValue(":surname",$userObject->surname);
        $statement->bindValue(":address",$AddressID,PDO::PARAM_INT);
        $statement->bindValue(":telephone",$userObject->telephone);
        $statement->execute();

        // Get the id of the new user
        $userID = $pdo->lastinsertId();
    }
    else
    {
        $userID = $userObject->accountID;
    }

    // Create all orders record and record their id
    $ordersID = [];
    foreach ($recipeList as $singleRecipe)
    {
        $statement = $pdo->prepare("INSERT INTO Orders (deliveryAddress,orderDate,recipeID,Quantity)
        VALUES (:deliveryAddress,:orderDate,:recipeID,:quantity)");
        $statement->bindValue(":deliveryAddress",$AddressID,PDO::PARAM_INT);
        $statement->bindValue(":orderDate",date("d/m/Y"));
        $statement->bindValue(":recipeID",getRecipesAccess("getRecipeByTitle",$singleRecipe[0])[0]->recipeID,PDO::PARAM_INT);
        $statement->bindValue(":quantity",$singleRecipe[1],PDO::PARAM_INT);
        $statement->execute();

        // Get the last id and record it
        array_push($ordersID,$pdo->lastinsertId());
    }

    // Now connect orders to an account

    foreach ($ordersID as $singleOrder)
    {
        $statement = $pdo->prepare("INSERT INTO OrderHistory (accountID,orderID)
        VALUES (:accountID,:orderID)");
        $statement->bindValue(":accountID",$userID,PDO::PARAM_INT);
        $statement->bindValue(":orderID",$singleOrder,PDO::PARAM_INT);
        $statement->execute();
    }

    return true;
}

// Return one user object if the username is found
function getUserByUsername($username)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Account WHERE username = ?");
    $statement->execute([$username]);
    $currentUser = $statement->fetchAll(PDO::FETCH_CLASS,"Account");

    if ($currentUser != null)
    {
        return $currentUser[0];
    }
    else
    {
        return $currentUser;
    }
}

// Returns one address object if this address id is found
function getAddressByID($id)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Address WHERE addressID = ?");
    $statement->execute([$id]);
    $currentAddress = $statement->fetchAll(PDO::FETCH_CLASS,"Address");

    if ($currentAddress != null)
    {
        return $currentAddress[0];
    }
    else
    {
        return $currentAddress;
    }
}




?>