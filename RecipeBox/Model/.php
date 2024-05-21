<?php

class Nutrition
{
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


}

?>