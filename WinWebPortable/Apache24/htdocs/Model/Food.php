<?php

// Sorry for the confusion, this is ingridient class
// All ingridient objects are instanciated using this class

error_reporting(0);

class Food implements JsonSerializable
{
    private $foodID;
    private $foodName;
    private $foodTag;
    private $foodCost;
    private $foodUnit;
    private $foodDescription;
    private $calories;
    private $carbohydrates;
    private $protein;
    private $fat;

    function __construct()
    {
        
    }

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