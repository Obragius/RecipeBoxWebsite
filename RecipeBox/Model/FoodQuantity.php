<?php

// This object is stored inside recipe object and is responsible for the amount
// of a certain ingridient in a recipe for example 2 potatoes (count) or 500g of rice (amount)

class FoodQuantity implements JsonSerializable
{
    private $count;
    private $amount;

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }

    // This is to allow json encoding and AJAX functionality
    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}


?>