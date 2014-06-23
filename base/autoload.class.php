<?php
/**
 * Author : Abhijth Shetty
 * Date   : 20-12-2010
 * Desc   : This class is responsible for loading files and resolving filepaths
 */ 

class autoload
{
  public static $basePath ;
  
  public static $_CONFIG;
  
  public static $_STRING;
  
  public static $_RESPONSE;
  
  public static $responseCode="";
  
  public static $responseInfo="";
    
  /**
   * Description: Includes basic files that are very necessary to execution.
   */
  static public function init($path, $options=array())
  {
    self::$basePath = $path;
    require_once(self::$basePath.'/base/database.class.php');
    require_once(self::$basePath.'/base/log.class.php');
    require_once(self::$basePath.'/library/global.php');
    require_once(self::$basePath.'/library/constants.php');
	
    self::loadConfiguration();
    self::loadStrings(getConfig('language'));	
	
    return true;
  }
  
  static public function initRest($path, $options=array())
  {
    self::$basePath = $path;
    require_once(self::$basePath.'/base/restBase.class.php');
    require_once(self::$basePath.'/base/executor.class.php');
    require_once(self::$basePath.'/base/baseInitializer.class.php');
    require_once(self::$basePath.'/base/baseAction.class.php');
    require_once(self::$basePath.'/base/database.class.php');
    require_once(self::$basePath.'/base/log.class.php');
    require_once(self::$basePath.'/library/global.php');
    require_once(self::$basePath.'/library/constants.php');
    require_once(self::$basePath.'/base/memcacheLib.class.php');
    
    return true;
  }
  
  static public function loadConfiguration($options=array())
  {
    require(self::$basePath.'/config/settings.php');
    
    if(!database::init($setting)){
      die('Could not connect to Database. Please contact administrator');
    }

    /* if(!memcacheLib::init($setting)){
      die('Could not connect to Memcache Server. Please contact administrator');
    } */
    
    self::$_CONFIG = $setting;
    self::init_php_settings();
    
    return true;
  }
  
  static public function loadStrings($language="en", $options=array())
  {
    //basically used for website.
    require(self::$basePath.'/i18n/string.'.$language.'.php');
    self::$_STRING = $string;
    
    //basically used for rest api
    require(self::$basePath.'/i18n/response.'.$language.'.php');
    self::$_RESPONSE = $response;

    return true;
  }
    
  /**
* Description: Handles php.ini settings here
*
*/
  static public function init_php_settings()
  {
    //displaying error messages only during the test mode
    //error_reporting(0);
    
    //setting the timezone
    if(getConfig("timezone")!=""){
      date_default_timezone_set(getConfig("timezone"));
    }
    
    return true;
  }

  /**
   * Description: Loads required file
   * Parameters:
   *              $type: type of file (example; modules, config, lib, ...) that is declared in getPathByType().
   *              $fileName: name of the file to include
   */  
  static public function loadFile($type, $fileName)
  {
    require_once(self::getpath($type, $fileName));
    return true;
  }

  /**
   * Description: Loads only library files
   * Parameters:
   *              $type: type of file (example; query, api, ...) that is declared in getPathByType().
   *              $className: name of the file to include
   */    
  static public function loadLibrary($type, $className)
  {
    require_once(self::getpath("library", $type.'/'.$className.'.lib.php'));
	
    if (method_exists($className,'get')) {
      $inst = $className::get();
    }else{
      $inst = new $className;
    }
    
    //require(autoload::getpath('lang', 'pt.php'));
    //$inst->_LANG = $_LANG;
    
    return $inst;
  }

  /**
   * Description: Returns complete path of a file
   * Parameters:
   *              $type: type of file (example; query, api, ...) that is declared in getPathByType().
   *              $fileName: name of the file to include
   */   
  static public function getpath($type, $fileName)
  {
    return self::$basePath.'/'.self::getPathByType($type).'/'.$fileName;  
  }

 
  /**
   * Description: Returns directory name or relative path to the project
   * Parameters:
   *              $type: type of file (example; query, api, ...) that is declared in getPathByType().
   */   
  static public function getPathByType($type, $options=array())
  {
    $pathArray = array( "modules"  => "modules",
                        "methods"  => "methods",
                        "base"     => "base",
                        "library"  => "library",
                        "layout"   => "layout",
                        "config"   => "config",
                        "lang"     => "lang",
                        "static"   => "static",
                        "log"	   => "log"
    );
	
    return isset($pathArray[$type])?$pathArray[$type]:'';
  }
}