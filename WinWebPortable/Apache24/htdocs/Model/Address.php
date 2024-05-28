<?php 

// This class represents both personal address of the customer and the address which the customer wants delivery for

error_reporting(0);

class Address implements JsonSerializable
{
    private $lineOne;
    private $lineTwo;
    private $postcode;
    private $town;
    private $city;
    private $country;

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