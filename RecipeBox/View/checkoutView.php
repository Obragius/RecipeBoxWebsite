<!DOCTYPE html>
<html>
    <title>
        Recipe Fridge:Checkout
    </title>
    <head>
    <link type="text/css" rel="stylesheet" href="../View/checkoutCSS.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Controller/homeJS.js"></script>
    <script type="text/javascript" src="../Controller/checkoutJS.js"></script>
    <?php if ($checkoutComplete):?>
        <script> 
        alert("Thank you for your order");
        window.location.href = "https://kunet.uk/k1801606/coursework/Controller/home.php";
        </script>
     <?php endif ?>
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
            <li> <a class="topLink" id="cartBtn" href="https://kunet.uk/k1801606/coursework/Controller/cart.php">Cart: </a> <a  href="https://kunet.uk/k1801606/coursework/Controller/cart.php" class="topLink" id="cartNum"><?= $numberOfItems ?></a> </li>
        </ul>
    </nav>

<!-- Checkout info -->

    </div>
        <form class="form" method="post" action="../Controller/checkout.php">
            <input class="loginCheck" name="autofill" value="<?php if (isset($_SESSION["user"])):?><?="Login"?><?php endif ?>" hidden="true">
            <?php if(isset($_SESSION["user"])): ?>
                <h2 class="Autofill">Autofill</h2>
            <?php endif ?>
            <p>Please provide the information requested in the fields below<p></br>
            <p>Firstname</p>
            <input id="firstname" name="firstname"><br/>
            <p>Surname</p>
            <input id="surname" name="surname"><br/>
            <p>Address Line one</p>
            <input id="address1" name="Address1"><br/>
            <p>Address Line two</p>
            <input id="address2" name="Address2"><br/>
            <p>Postcode</p>
            <input id="postcode" name="postcode"><br/>
            <p>Town</p>
            <input id="town" name="town"><br/>
            <p>City</p>
            <input id="city" name="city"><br/>
            <p>Country</p>
            <input id="country" name="country"><br/>
            <p>Telephone</p>
            <input id="telephone" name="telephone"><br/>
            <input hidden="true" id="autofill" name="auto">
            <input class="submitOrder" type="submit" value="Complete Order">
        </form>
    </body>
</html>