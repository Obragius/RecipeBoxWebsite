$(document).ready(function(){

    function loadHome()
    {
        window.location.href = "https://kunet.uk/k1801606/coursework/Controller/home.php";
    }

    function autofillResponse(user)
    {
        // Input all the values into the fields if user is found
        $("input#firstname").val(user.firstname);
        $("input#surname").val(user.surname);
        $("input#address1").val(user.address.lineOne);
        $("input#address2").val(user.address.lineTwo);
        $("input#postcode").val(user.address.postcode);
        $("input#town").val(user.address.town);
        $("input#city").val(user.address.city);
        $("input#country").val(user.address.country);
        $("input#telephone").val(user.telephone);
        $("input#autofill").val("true");

    }

    // This checks that the user is logged in, and if so it calls the service to retrieve a user object
    // If user is not logged in, it alerts the user that this functionality is only available if they 
    // are logged in (obsolete now, because the button is hidden unless logged in)
    function autofillServiceCall()
    {
        if ($("input.loginCheck").attr("value") == "Login")
        {
            $.post("../Controller/AutofillService.php",{"autofill" : true},autofillResponse)
        }
        else
        {
            alert("Please login to use this feature");
        }
    }

    // Loading the home webpage to return to view all recipes
    $("div.title").click(loadHome);


    // Load the page with with information from the account
    $("h2.Autofill").click(autofillServiceCall);






});