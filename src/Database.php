<?php namespace App;

date_default_timezone_set('Asia/Manila');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//error_reporting(0);

use PDO;
 
class Database
{
  private static $host = "";
  private static $db_name = "";
  private static $username = "";
  private static $password = "";
  public static $dao;
  public static $server = "";
  public static $env = "";
  
  private function __construct(){}

  public static function connect() {
    self::checkEnv();

    try
    {

      if(!empty(self::$dao)){
        //echo "<br> dao found, loading dao... ";
        return self::$dao;
      }
      //echo "<br> dao is empty, reinstantiating dao... ";
      
      self::$dao = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
      self::$dao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch(PDOException $exception)
    {
      echo "Connection error: " . $exception->getMessage();
    }
         
    return self::$dao;
  }

  public static function checkEnv()
  {
    $server = $_SERVER['SERVER_NAME'];

    self::$host = "localhost";
    self::$db_name = "psr4test";
    self::$username = "root";
    self::$password = "";
    self::$env = "dev";
  }

}