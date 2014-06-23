<?php
  function getConfig($key)
  {
    return isset(autoload::$_CONFIG[$key])?autoload::$_CONFIG[$key]:"";
  }
  
  function setConfig($key, $value)
  {
    autoload::$_CONFIG[$key] = $value;
    return isset(autoload::$_CONFIG[$key])?autoload::$_CONFIG[$key]:"";
  }
 
  function getString($key)
  {
    return isset(autoload::$_STRING[$key])?autoload::$_STRING[$key]:"";
  }
  
  function getComponentUrl($moduleName, $componentName)
  {
    return '/'.$moduleName.'/'.$componentName;
  }
  
  function isPost()
  {
    return ($_SERVER['REQUEST_METHOD'] == 'POST')? true:false;
  }
  
  function getUserId()
  {
    return ($_SESSION['user_id']>0)?$_SESSION['user_id']:0;
  }
  
  function getUserRole()
  {
   return $_SESSION['user_role'];
  }
  
  function isAdmin()
  {
    return (isset($_SESSION['user_role']) && $_SESSION['user_role'] == USER_ROLE_ADMIN)?true:false;
  }
  
  function isUserRole($roleId)
  {
    return (getUserRole()==$roleId)?true:false;
  }
  
  function isOwner($userId)
  {
    return ($userId==getUserId())?true:false;
  }
  
  function isLoggedInUser()
  {
    if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='' && is_numeric($_SESSION['user_id']))
    {
      return true;
    } else {
      return false;
    }
  }
  
  function sendAjaxResponse($status=true, $message="", $options=array())
  {
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header('Content-Type: application/json');
    echo json_encode(array('status'=>$status, 'message'=>$message));
    die();
  }
  
  //getDevicePixelRatio
  function getDR($devicePixelRatio, $options = array())
  {
    if($devicePixelRatio == 1){
      return "mdpi";
    } elseif($devicePixelRatio == 0.75){
      return "ldpi";
    } elseif($devicePixelRatio == 1.5){
      return "hdpi";
    } elseif($devicePixelRatio == 2){
        if(isset($options['width']) && $options['width'] == 320){
          return "iphone";
        } else {
          return "xhdpi";
        }
    } elseif($devicePixelRatio == 3){
      return "xxhdpi";
    }
    
    return "hdpi";
  }
  
?>