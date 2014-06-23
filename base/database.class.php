<?php
/**
  * Author : Abhijith Shetty
  * Date   : 15-10-2010
  * Description : Handles database connection and query
  */

class database
{
  static private $connection;
 
  public static function init($config)
  {
    self::$connection = mysql_connect($config['db_server'], $config['db_username'], $config['db_password']);
    if(!self::$connection) {
      return false;
    }
    if(!mysql_select_db($config['db_name'], self::$connection)){
      return false;
    }
    mysql_query("SET NAMES 'UTF8'", self::$connection);
    //mysql_query("SET time_zone = 'America/Sao_Paulo'", self::$connection);

    return true;
  }
 
  public static function close() 
  {
    $con = mysql_close(self::$connection);
    if(!$con) {
      return false;
    }

    return true;
  }
 
 //This function returns the resulting resource, data should be fetched later
  public static function doExecute($query, $options=array())
  {
    $resource = mysql_query($query, self::$connection);

    if(!$resource) {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return $resource;
  }
 
  public static function doSelect($query, $options=array())
  {
    $result = array();
    $resource = mysql_query($query, self::$connection);
    if($resource)
    {
      while($row = mysql_fetch_assoc($resource))
      {
        $result[] = $row;
      }

      return $result;
    } else {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return false;
  }
 
  public static function doSelectOne($query,  $options=array())
  {
    $resource = mysql_query($query, self::$connection);
    if($resource)
    {
      $row = mysql_fetch_assoc($resource);
      return $row;
    } else {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return false;
  }
 
  public static function doInsert($query,  $options=array())
  {
    $response = mysql_query($query, self::$connection);

    if($response) {
      return mysql_insert_id(self::$connection);
    } else {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return $response;
  }
 
  public static function doUpdate($query,  $options=array())
  {
    $response = mysql_query($query, self::$connection);

    if($response) {
      return $response;
    } else {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return $response;
  }
 
  public static function doDelete($query,  $options=array())
  {
    $response = mysql_query($query, self::$connection);

    if($response) {
      return $response;
    } else {
      echo "<pre>SQL ERROR :".mysql_error(self::$connection)."</pre><pre>$query</pre>";
    }

    return $response;
  }
 
  public static function doEscape($string)
  {
    $response = mysql_real_escape_string($string);
    return $response;
  }   
}