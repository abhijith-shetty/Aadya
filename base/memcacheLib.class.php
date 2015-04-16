<?php
/**
  * Author : Abhijith Shetty
  * Date   : 27-05-2014
  * Description : Handles memcache connection and data transfer
  */

class memcacheLib
{
  static private $connection;
 
  public static function init($config)
  {
    self::$connection = new Memcached();
    //self::$connection->setOption(Memcached::OPT_CLIENT_MODE, Memcached::DYNAMIC_CLIENT_MODE);
    self::$connection->addServer($config['memcache_server'], $config['memcache_port']);
    
    return (self::$connection->getVersion())?true:false;
  }
  
  public static function get($key, $options = array()) 
  {
    $data = self::$connection->get($key);
    return $data;
  }
  
  public static function set($key, $data, $options = array()) 
  {
    $expiry = isset($options['expiry'])?$options['expiry']:3600;
    
    $data = self::$connection->set($key, $data, $expiry);
    return $data;
  }
 
  public static function delete($key, $options = array()) 
  {
    $data = self::$connection->delete($key);
    return $data;
  }
  
  public static function close() 
  {
    
  }
}