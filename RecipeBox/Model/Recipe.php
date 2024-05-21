<?php

// The recipe class is used ot instanciate all recipe objects on the website
// which are then used to diplay the recipes to the user

class Recipe implements JsonSerializable
{
    private $recipeID;
    private $title;
    private $steps;
    private $stepList;
    private $description;
    private $recipeCost;
    private $recipeTags;
    private $image;

    private $recipeAddedCost;

    private $foodList = [];

    private $foodQuantity = [];


    // Method to add a ingridient to a recipe object
    // (foodlist) -> ingridient
    // (foodquantity) -> ingridient amount or count
    function addFood($food,$quantity)
    {
        array_push($this->foodList,$food);
        array_push($this->foodQuantity,$quantity);
    }

    // Method to convert a string from the database into a list
    function makeStepsList()
    {
        $this->stepList = $this->steps;
        $this->steps = explode("+",$this->steps);
    }

    // This is to allow json encoding and AJAX functionality
    function jsonSerialize()
    {
        return get_object_vars($this);
    }

    // Method to collect the tags that are stored in the ingridients and append it to the recipe itself
    // This allows to avoid repeating tags
    function gatherTags()
    {
        $givenRecipeTags = explode(",",$this->recipeTags);
        $this->recipeTags = array_unique($givenRecipeTags);
    }

    // Method used by views to display cost in a format which is human readble
    function displayCostInPounds()
    {
        $returnValue = "£".number_format((float)($this->recipeCost/100), 2, '.', '');
        return $returnValue;
    }

    // Method to calculate the cost of the recipe by the cost of each ingridient
    // as well as added cost of the recipe box itself
    function calculateCost()
    {
        $total = 0;
        $count = 0;
        foreach ($this->foodList as $foodItem)
        {
            $rate = 1;
            if ($this->foodQuantity[$count]->amount != 0)
            {
                $rate = $this->foodQuantity[$count]->amount/1000;
            }
            else
            {
                $rate = $this->foodQuantity[$count]->count;
            }
            $total += $foodItem->foodCost*$rate;
            $count += 1;
        }
        $this->recipeCost = $total + $this->recipeAddedCost;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }
}

?>