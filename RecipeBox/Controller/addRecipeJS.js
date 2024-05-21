$(document).ready(function(){

    function addRecipe()
    {
        var myObject = [];
        // Gather all ingridients
        for (var i = 0;i < ingridientCount;i++)
        {
            myObject.push({"food":$("select[id=fN"+i+"]").val(),
            "foodCount":$("input[id=fC"+i+"]").val(),
            "foodAmount":$("input[id=fA"+i+"]").val()});
        }
        // Gather all other the recipe attributes
        var myValue = {
            "ingridientCount":ingridientCount,
            "recipeTitle":$("input#recipeTitle").val(),
            "recipeImage":$("input#recipeImage").val(),
            "recipeDescription":$("textarea#recipeDescription").val(),
            "recipeSteps":$("textarea#recipeSteps").val(),
            "recipeAddedCost":$("input#recipeAddedCost").val(),
            "recipeTags":$("input#recipeTags").val(),
        }

        myObject.push(myValue);

        // Call a service to add this recipe
        $.post("../Controller/addRecipeService.php",{"object":JSON.stringify(myObject)},function(result){alert(result);});
        // The result will tell if the recipe has been added or what error has happened
        // Intentionally did not change the dom, because the admin may have made a mistake and can
        // resend the add recipe request to fix the recipe
        
    }

    function ingridientAppend(myFood)
    {
        // This function adds or removes fields to add ingridients
        // Due to time constraint it emptys the div deleting other input
        // In future developemnt this can be fixed
        $("div.foodContainer").empty();
        var thisText = ""
        for (var y = 0; y< ingridientCount; y++)
        {
            thisText += '<p>Foods</p><select id="fN'+y+'" name="food_'+y+'">';
            for (var i = 0; i< myFood.length; i++)
            {
                thisText += '<option value="'+myFood[i].foodID+'">'+myFood[i].foodName+'</option>';
            }
            thisText += '</select>';
            thisText += '<p>Count</p><input id="fC'+y+'" name="foodCount_'+y+'"><br/>'
            thisText += '<p>Amount</p><input id="fA'+y+'"name="foodAmount_'+y+'"><br/>'
        }

        $("div.foodContainer").append(thisText);
    }

    // This function is here to allow some delay, because without this delay
    // The DOM doesn't have enough time to react to input and the Javascript
    // thread tries to access elements which have not been created yet
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    // Async to allow to use the delay
    async function inputRecipeContents(myRecipe)
    {
        ingridientCount = 0;
        for (i = 0;i < myRecipe.foodList.length;i++)
        {
            $("button#addFood").click();
        }
        await sleep(200);

        // Construct the full steps string 
        newStepsString = "";
        for (i = 0; i < myRecipe.steps.length;i++)
        {
            if (i == myRecipe.steps.length-1)
            {
                newStepsString += myRecipe.steps[i];
            }
            else
            {
                newStepsString += myRecipe.steps[i] + "+";
            }
        }

        // Input all the recipe attributes inside the appropriate DOM elements
        $("input#recipeTitle").val(myRecipe.title);
        $("input#recipeImage").val(myRecipe.image);
        $("textarea#recipeSteps").val(newStepsString);
        $("input#recipeAddedCost").val(myRecipe.recipeAddedCost);
        $("input#recipeTags").val(myRecipe.recipeTags);
        $("textarea#recipeDescription").val(myRecipe.description);
        for (i = 0;i < myRecipe.foodList.length;i++)
        {
            $('select[id="fN'+i+'"] option[value="'+myRecipe.foodList[i].foodID+'"]').prop('selected',true);
            $('input[id="fC'+i+'"]').val(myRecipe.foodQuantity[i].count);
            $('input[id="fA'+i+'"]').val(myRecipe.foodQuantity[i].amount);
        }

    }

    // This functions sends a request for an recipe object
    function editRecipe()
    {
        $.post("../Controller/RecipeService.php",{ "recipeID":$('select[name="recipe_edit"]').val() } ,inputRecipeContents);
    }

    // This adds a field for an additional ingridient
    function addFood()
    {
        ingridientCount += 1;
        $.post("../Controller/FoodService.php",{ "name":"nothing" } ,ingridientAppend)
    }

    // This removes a field for an ingridient
    function removeFood()
    {
        if (ingridientCount > 0)
        {
            ingridientCount -= 1;
            $.post("../Controller/FoodService.php",{ "name":"nothing" } ,ingridientAppend)
        }
    }

    // Create a value to store the number of ingridients
    var ingridientCount = 0;

    // Assign add and remove ingridient buttons
    $("button#addFood").click(addFood);
    $("button#removeFood").click(removeFood);

    // Send the recipe data to the add recipe service
    $("button#submitBtn").click(addRecipe);

    // Assign edit button to the appropriate service
    $("button#editBtn").click(editRecipe);
    



});