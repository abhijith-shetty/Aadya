<?php
/**
  * Author : Abhijith Shetty
  * Date   : 04-08-2014
  * Description : Handles mongo db connection and data transfer
  */

class mongoLib
{
  static public $db;
 
  public static function init($config)
  {
    $connection = new MongoClient("mongodb://".$config['mongo_server'].":".$config['mongo_port']);
    self::$db = $connection->$config['mongo_db_name'];

    return (self::$db)?true:false;
  }
}