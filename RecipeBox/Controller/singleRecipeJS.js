$(document).ready(function(){

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

    $("div.title").click(loadHome);

    
    // Adding recipe to the cart
    $("h2.cart").click(addToCart);

});