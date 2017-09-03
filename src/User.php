<?php namespace App;

class User
{
    public $id;
    public $email;
    public $logkey;


    //public function __set($name, $value) {}
    
    public function __construct($data = null)
    {
        //echo 'The class "', __CLASS__, '" was created.<br />';
    }

    public function __destruct()
    {
        //echo 'The class "', __CLASS__, '" was destroyed.<br />';
    }

    public function getTotalTransaction()
    {
        return $totaltransaction;
    }
    
}