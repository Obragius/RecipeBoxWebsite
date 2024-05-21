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

    function removeFromCart()
    {
        // AJAX
        $.post("../Controller/CartService.php",{"removeRecipeName" : $(this).attr("id")},function (){});
        
        // Also need to update quantity num
        var prevValue = $("p.recipeQuantity[id='"+$(this).attr("id")+"']").text().replace("Quantity = ","");
        $("p.recipeQuantity[id='"+$(this).attr("id")+"']").text("Quantity = "+String(parseInt(prevValue)-1));
        if (parseInt(prevValue)-1 == 0)
        {
            $("div.row[id='"+$(this).attr("id")+"']").remove();
        }

        // If there are no recipes in cart redirect
        if ($("div.row").length == 0)
        {
            loadHome();
        }

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
    $("p.cart").click(removeFromCart);






});