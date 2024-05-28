<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../View/recipeCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/singleRecipeJS.js"></script>
    <title> Recipe Fridge:<?=$recipeList[0]->title?> </title>
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
            <li> <a  class="topLink" href="home.php">Home</a> </li>
            <?php if(isset($_SESSION["user"])): if ($_SESSION["user"]->isAdmin()): ?>
                <li> <a class="topLink"  href="addFood.php">Food Page</a> </li>
                <li> <a class="topLink" href="addRecipe.php">Recipe Page</a> </li>
            <?php endif; endif; if(isset($_SESSION["user"]) == false): ?>
                <li> <a  class="topLink" href="createAccount.php">Create Account</a> </li>
                <li> <a class="topLink" href="login.php">Login</a> </li>
            <?php endif; if (isset($_SESSION["user"])):?>
                <li> <a  class="topLink" href="home.php?logout=logout">Logout</a> </li>
            <?php endif ?>
            <li> <a class="topLink" id="cartBtn" href="cart.php">Cart: </a> <a class="topLink" id="cartNum"><?= $numberOfItems ?></a> </li>
        </ul>
    </nav>

    </div>



<!-- Recipes display -->

    <div class="recipeContainer">
        <h1 class="recipeTitle" id="title"><?=$recipeList[0]->title?></h1>
            <div class="row">
                <div class="col">
                    <img class="recipe" alt="An image of <?= $recipeList[0]->image ?>" src="../Images/<?= $recipeList[0]->image ?>.jpg"> </br>
                    <h2> Tags </h2>
                    <?php foreach ($recipeList[0]->recipeTags as $singleTag): ?>
                        <?php if ($singleTag != ""): ?>
                            <p class="recipe" id="tags"><?=$singleTag?></p>
                        <?php endif ?>
                    <?php endforeach ?>
                    <h2> Price </h2>
                    <p class="recipe" id="cost"><?=$recipeList[0]->displayCostInPounds()?></p>
                </div>
                <div class="col">
                    <h2> Description </h2>
                    <p2 class="recipe" id="description"><?=$recipeList[0]->description?></p2>
                    <h2> Ingridients </h2>
                    <?php for ($i = 0; $i < sizeof($recipeList[0]->foodList);$i++): ?>
                        <p class="recipe" id="food">
                            <?php if ($recipeList[0]->foodQuantity[$i]->amount == 0): ?>
                                <?=$recipeList[0]->foodQuantity[$i]->count?>
                            <?php else: ?>
                                <?=($recipeList[0]->foodQuantity[$i]->amount)/1000?><?=$recipeList[0]->foodList[$i]->foodUnit?>
                            <?php endif ?>
                            :
                            <?=$recipeList[0]->foodList[$i]->foodName?>
                        </p>
                    <?php endfor ?>
                    <h2> Steps </h2>
                    <?php foreach ($recipeList[0]->steps as $step): ?>
                        <p class="recipe" id="step"><?=$step?></p>
                    <?php endforeach ?>
                </div>
            </div>
        <h2 class="cart" id="<?=$recipeList[0]->title?>">Add to cart</h2>
        <form hidden="true" class="cartform" method="post" action="../Controller/singleRecipe.php">
            <input class="recipeToCart" id="<?=$recipeList[0]->title?>" type="submit" name="cart" value="<?=$recipeList[0]->title?>" >
        </form>
    </div>
</body>
</html>