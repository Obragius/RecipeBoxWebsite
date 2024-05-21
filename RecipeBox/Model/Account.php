<?php

// This class represents Customers and Workers of the website
class Account implements JsonSerializable
{
    private $accountID;
    private $firstname;
    private $surname;
    private $address;
    private $telephone;
    private $username;
    private $password;
    private $orderHistory;
    private $isAdmin;

    function __construct()
    {
        
    }

    // This class tells the system if the user is admin and therfore is allowed to add ingridients and recipe boxes
    function isAdmin()
    {
        if ($this->isAdmin == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    function __get($name)
    {
        return $this->$name;
    }

    // This is basic function which would be used if there would be and account page
    function getFullname()
    {
        return $this->firstname + ", " + $this->surname;
    }

    // This is to allow json encoding and AJAX functionality
    function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    
}

?>