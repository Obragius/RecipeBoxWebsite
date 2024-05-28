<!DOCTYPE html>
<html>
    <title>
        Recipe Fridge:New Recipe
    </title>
    <head>
    <link type="text/css" rel="stylesheet" href="../View/addRecipeCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/homeJS.js"></script>
    <script type="text/javascript" src="../Controller/addRecipeJS.js"></script>
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
            <li> <a class="topLink" id="cartBtn" href="localhost/Controller/cart.php">Cart: </a> <a class="topLink" id="cartNum"><?php if (isset($_SESSION["Cart"])): ?><?= sizeof($_SESSION["Cart"]) ?> <?php else: ?><?= 0 ?><?php endif ?></a> </li>
        </ul>
    </nav>

    </div>

<!-- Input form -->
    <div class="formContainer">
        <form method="post" action="../Controller/addRecipe.php">
            <select name="recipe_edit">
                <?php foreach ($recipeList as $oneRecipe): ?>
                    <option value="<?= $oneRecipe->recipeID ?>"><?= $oneRecipe->title ?></option>
                <?php endforeach ?>
            </select>
            <button id="editBtn" type="button">Edit</button>
            <p>Title</p>
            <input id="recipeTitle" name="recipeTitle"><br/>
            <p>Tags</p>
            <input id="recipeTags" name="recipeTags"><br/>
            <div class="foodContainer">    
            </div>
            <button id="addFood" type="button">Add Food</button>
            <button id="removeFood" type="button">Remove Food</button>
            <p>Description</p>
            <textarea id="recipeDescription" cols="40" rows="10" name="recipeDescription"></textarea>
            <p>Steps (Plus sign separated list)</p>
            <textarea id="recipeSteps" cols="40" rows="10" name="recipeSteps"></textarea>
            <p>Image Name</p>
            <input id="recipeImage" name="recipeImage"><br/>
            <p>Added Cost in Pence</p>
            <input id="recipeAddedCost" name="recipeAddedCost"><br/>
        </form>
        <button id="submitBtn" name="submit" value="submitData">Send Data</button>
    </div>
</body>
</html>