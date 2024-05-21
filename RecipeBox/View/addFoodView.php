<!DOCTYPE html>
<html>
    <title>
        Recipe Fridge:New Food
    </title>
    <head>
    <link type="text/css" rel="stylesheet" href="../View/addFoodCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/homeJS.js"></script>
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
            <li> <a  class="topLink" href="https://kunet.uk/k1801606/coursework/Controller/home.php">Home</a> </li>
            <?php if(isset($_SESSION["user"])): if ($_SESSION["user"]->isAdmin()): ?>
                <li> <a class="topLink"  href="https://kunet.uk/k1801606/coursework/Controller/addFood.php">Food Page</a> </li>
                <li> <a class="topLink" href="https://kunet.uk/k1801606/coursework/Controller/addRecipe.php">Recipe Page</a> </li>
            <?php endif; endif; if(isset($_SESSION["user"]) == false): ?>
                <li> <a  class="topLink" href="https://kunet.uk/k1801606/coursework/Controller/createAccount.php">Create Account</a> </li>
                <li> <a class="topLink" href="https://kunet.uk/k1801606/coursework/Controller/login.php">Login</a> </li>
            <?php endif; if (isset($_SESSION["user"])):?>
                <li> <a  class="topLink" href="https://kunet.uk/k1801606/coursework/Controller/home.php?logout=logout">Logout</a> </li>
            <?php endif ?>
            <li> <a class="topLink" id="cartBtn" href="https://kunet.uk/k1801606/coursework/Controller/cart.php">Cart: </a> <a class="topLink" id="cartNum"><?php if (isset($_SESSION["Cart"])): ?><?= sizeof($_SESSION["Cart"]) ?> <?php else: ?><?= 0 ?><?php endif ?></a> </li>
        </ul>
    </nav>

    </div>

<!-- Input Form -->
    <div class="formContainer">
        <form method="post" action="../Controller/addFood.php">
            <select name="food_edit">
                <?php foreach ($foodList as $oneFood): ?>
                    <option value=<?= $oneFood->foodID ?>><?= $oneFood->foodName ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" name="Edit" value="Edit">
            <p>Name</p>
            <input name="foodName"<?php if ($myFood != null): ?> value="<?=$myFood->foodName?>" <?php endif ?>><br/>
            <p>Tags</p>
            <input name="foodTag"<?php if ($myFood != null): ?> value="<?=$myFood->foodTag?>" <?php endif ?>><br/>
            <p>Cost</p>
            <input name="foodCost"<?php if ($myFood != null): ?> value="<?=$myFood->foodCost?>" <?php endif ?>><br/>
            <p>Unit</p>
            <input name="foodUnit"<?php if ($myFood != null): ?> value="<?=$myFood->foodUnit?>" <?php endif ?>></br>
            <p>Description</p>
            <textarea cols="40" rows="10" name="foodDescription"><?php if ($myFood != null): ?><?=$myFood->foodDescription?> <?php endif ?></textarea>
            <p>Calories</p>
            <input name="calories"<?php if ($myFood != null): ?> value="<?=$myFood->calories?>" <?php endif ?>><br/>
            <p>Carbohydrates</p>
            <input name="carbohydrates"<?php if ($myFood != null): ?> value="<?=$myFood->carbohydrates?>" <?php endif ?>><br/>
            <p>Proteins</p>
            <input name="protein"<?php if ($myFood != null): ?> value="<?=$myFood->protein?>" <?php endif ?>><br/>
            <p>Fats</p>
            <input name="fat"<?php if ($myFood != null): ?> value="<?=$myFood->fat?>" <?php endif ?>><br/>
            <input type="submit" name="Add" value="Add">
        </form>
    </div>
</body>
</html>