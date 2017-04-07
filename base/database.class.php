<?php
/**
  * Author : Abhijith Shetty
  * Date   : 15-10-2010
  * Updated: 07-04-2017 (Added PDO support with prepared statement)
  * Description : Handles database connection and query
  */

class database
{
  static private $connection;

  public static function init($config)
  {
    if($config['db_server']!= "")
    {
      try {
        self::$connection = new PDO(
            sprintf(
                "mysql:host=%s;dbname=%s;",
                $config['db_server'],
                $config['db_name']
            ),
            $config['db_username'],
            $config['db_password']
        );
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      } catch (PDOException $e) {
        if(getConfig('setup_mode') == "test") {
          echo "There was a problem connecting. " . $e->getMessage();
        }
        return false;
      }
    }

    return true;
  }

  public static function close()
  {
    self::$connection = false;

    return true;
  }

 //This function returns the resulting resource, data should be fetched later
  public static function doExecute($query, $options=array())
  {
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value, PDO::PARAM_STR);
    }
    $response = $resource->execute();

    if(!$response)
    {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }

    return $response;
  }

  public static function doSelect($query, $options=array())
  {
    $result = array();
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
    $response = $resource->execute();
    
    if($response)
    {
      $result = $resource->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } else {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }

    return false;
  }

  public static function doSelectOne($query,  $options=array())
  {
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
    $response = $resource->execute();

    if($response)
    {
      $row = $resource->fetch(PDO::FETCH_ASSOC);
      return $row;
    } else {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }

    return false;
  }

  public static function doInsert($query,  $options=array())
  {
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
    $response = $resource->execute();

    if($response) {
      $lastInsertedId = self::$connection->lastInsertId();
      return $lastInsertedId;
    } else {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }
    
    return $response;
  }

  public static function doUpdate($query,  $options=array())
  {
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value);
    }
    $response = $resource->execute();

    if($response) {
      return $resource->rowCount();
    } else {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }

    return $response;
  }

  public static function doDelete($query,  $options=array())
  {
    $resource = self::$connection->prepare($query);
    foreach($options as $key => $value) {
      $resource->bindValue(":".$key, $value, PDO::PARAM_STR);
    }
    $response = $resource->execute();

    if($response) {
      return $resource->rowCount();
    } else {
      if(getConfig('setup_mode') == "test") {
        log::show($resource->errorInfo());
        log::showd($query);
      }
    }

    return $response;
  }

  public static function doEscape($string)
  {
    return $data;
  }
}