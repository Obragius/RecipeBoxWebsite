$(document).ready(function(){

    function loadRecipe()
    {
        window.location.href = "https://kunet.uk/k1801606/coursework/Controller/singleRecipe.php?name="+$(this).text().trim();
    }

    function loadRecipeID()
    {
        window.location.href = "https://kunet.uk/k1801606/coursework/Controller/singleRecipe.php?name="+$(this).attr("id").trim();
    }

    function loadHome()
    {
        window.location.href = "https://kunet.uk/k1801606/coursework/Controller/home.php";
    }

    function updateCartNum($response)
    {
        $("a.topLink#cartNum").text($response);
    }

    function addToCart()
    {
        // AJAX
        $.post("../Controller/CartService.php",{"addRecipeName" : $(this).attr("id")},updateCartNum);


        //Old function of php post reload
        //$("input[id='"+$(this).attr("id")+"']").click();
    }


    // Loading the webpages to display single recipe
    $("p.recipeCost").click(loadRecipeID);
    $("img.recipeImage").click(loadRecipeID);
    $("p.recipe#title").click(loadRecipe);

    // Loading the home webpage to return to view all recipes
    $("div.title").click(loadHome);

    // Adding recipe to the cart
    $("p.cart").click(addToCart);






});