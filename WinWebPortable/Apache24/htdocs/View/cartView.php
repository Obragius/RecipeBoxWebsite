<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../View/cartCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/cartJS.js"></script>
    <title> Recipe Fridge:Cart </title>
    <?php if ($redirect): ?>
    <script>
        window.location.href = "home.php"
    </script>
    <?php endif?>
</head>
<body>
    <div class="navigation"> 

    <div class="title"> Recipe Fridge </div>

<!-- Search Functionality -->

    <form class="searchform" method="post" action="../Controller/home.php">
        <input name="search" placeholder="Type here"> 
        <select name="search_value">
                    <option value="Name">Recipe Name</option>
                    <option value="Food">Ingridient Name</option>
                    <option value="Tag">Recipe Tag</option>
        </select>
        <input type="submit" value="Search">
    </form>
    
<!-- Navigation bar -->

    <nav>
        <ul>
            <li> <a  class="topLink" href="localhost/Controller/home.php">Home</a> </li>
            <?php if(isset($_SESSION["user"])): if ($_SESSION["user"]->isAdmin()): ?>
                <li> <a class="topLink"  href="localhost/Controller/addFood.php">Food Page</a> </li>
                <li> <a class="topLink" href="localhost/Controller/addRecipe.php">Recipe Page</a> </li>
            <?php endif; endif; if(isset($_SESSION["user"]) == false): ?>
                <li> <a  class="topLink" href="localhost/Controller/createAccount.php">Create Account</a> </li>
                <li> <a class="topLink" href="localhost/Controller/login.php">Login</a> </li>
            <?php endif; if (isset($_SESSION["user"])):?>
                <li> <a  class="topLink" href="localhost/Controller/home.php?logout=logout">Logout</a> </li>
            <?php endif ?>
            <?php if (isset($cartRecipes)): ?> 
                <li>
                <form class="topLink" method="post" action="../Controller/checkout.php">
                    <input class="checkout" type="submit" name="checkout" value="Checkout" >
                </form>
                </li>
            <?php endif ?>   
        </ul>
    </nav>

    </div>



<!-- Recipes display -->

    <div class="recipeContainer">
        <?php if (isset($cartRecipes)): ?>
            <?php foreach ($cartRecipes as $singleRecipe): ?>
                <div class="row" id="<?=$singleRecipe[0][0]->title?>">
                    <div class="col">
                        <img class="recipeImage" id="<?=$singleRecipe[0][0]->title?>" alt="An image of <?= $singleRecipe[0][0]->image ?>" src="../Images/<?= $singleRecipe[0][0]->image ?>.jpg"> </br>
                        <p class="recipe" id="title"> <?= $singleRecipe[0][0]->title ?> </p>
                        <p class="recipeCost" id="<?=$singleRecipe[0][0]->title?>"> <?= $singleRecipe[0][0]->displayCostInPounds() ?> </p>
                        <form hidden="true" method="post" action="../Controller/cart.php">
                            <input class="cartRemove" id="<?=$singleRecipe[0][0]->title?>" type="submit" name="remove" value="<?=$singleRecipe[0][0]->title?>" >
                        </form>
                    </div>
                    <div class="col2">
                        <p class="cart" id="<?=$singleRecipe[0][0]->title?>"> Remove from Cart </p>
                        <p class="recipeQuantity" id="<?=$singleRecipe[0][0]->title?>"> Quantity = <?= $singleRecipe[1] ?> </p>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</body>
</html>