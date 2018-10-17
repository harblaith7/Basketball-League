<?php

/**
 * Invloves all Database assets.
 *
 */
class DB
{
  private static $db;
  private $connection;

  /**
   * Adjusts the value of $connection based on the environment, as different environments have their own database credentials.
   *
   */
  private function __construct()
  {
    switch($_SERVER['SERVER_NAME']){
      case "localhost":
        $this->connection = new MySQLi("localhost", "root", "", "anklebreaker");
        break;
      case "anklebreaker":
        $this->connection = new MySQLi("localhost", "anklhtor_anklebreaker", ".61u?]thdf]U", "anklhtor_anklebreaker");
        break;
    }
  }

  /**
   * Insantiates the databse function.
   *
   */
  public static function connect()
  {
    if(self::$db == null){
      self::$db = new DB();
    }
    return self::$db->connection;
  }

  /**
   * Sanitizes first and second dimension values of the post array.
   *
   */
  public static function sanitize()
  {
    if($_POST){
      foreach($_POST as $key => $value){
        if(is_array($value)){
          foreach($value as $sub_key => $sub_value){
            $value[$sub_key] = mysqli_real_escape_string(self::connect(), $value[$sub_key]);
          }
        } else {
          $_POST[$key] = mysqli_real_escape_string(self::connect(), $_POST[$key]);
        }
      }
    }
  }

  public static function timestamp()
  {
    return date("Y-m-d H:i:s", strtotime('now')).'-04:00';
  }
}
