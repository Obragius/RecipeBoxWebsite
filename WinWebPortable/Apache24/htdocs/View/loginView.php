<!DOCTYPE html>
<html>
    <title>
        Recipe Fridge:Login
    </title>
    <head>
    <link type="text/css" rel="stylesheet" href="../View/homeCSS.css" />
    <link type="text/css" rel="stylesheet" href="../View/loginCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/homeJS.js"></script>
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
            <li> <a class="topLink" id="cartBtn" href="cart.php">Cart: </a> <a  href="cart.php" class="topLink" id="cartNum"><?= $numberOfItems ?></a> </li>
        </ul>
    </nav>

    </div>

    <div class="formContainer">
        <form method="post" action="../Controller/login.php">
            <p><?= $response?></p>
            <p>Please provide the information requested in the fields below<p></br>
            <p>Username</p>
            <input name="Username"><br/>
            <p>Password</p>
            <input name="Password" type="password"><br/>
            <input type="submit", value="Login">
        </form>
    </div>
</body>
</html>