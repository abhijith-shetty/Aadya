<?php
class userUtility{
  //Singleton
  protected static $objInstance;

  public static function get(){
    if(!isset(self::$objInstance)){
      $class=__CLASS__;
      self::$objInstance=new $class;
    }
    return self::$objInstance;
  }
  
  public function isValidEmail($email, $options=array())
  {
    return (!filter_var($email, FILTER_VALIDATE_EMAIL))?true:false;
  }
  
  public function setCredential($userId, $options=array())
  {
    $userLib = autoload::loadLibrary('queryLib', 'user');
	
    $user = $userLib->getUserDetail($userId);
    
    $_SESSION['user_id']   = $user['user_id'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['user_name'] = $user['name'];
    
    if(isset($options['rememberMe']) && $options['rememberMe']===true){
      setcookie("rememberMe",base64_encode($user['username']."##$$##".$user['password']),time()+3600*24*7,'/','',0);
    }
    
    return true;
  }
  
  public function clearCredential($options=array())
  {
    $_SESSION['user_id'] = "";
    $_SESSION['user_role'] = "";
    $_SESSION['user_name'] = "";
    setcookie("rememberMe","",time()-3600,'/','',0);
    
    return true;
  }
  
  public function generateAccessToken($userId, $options=array())
  {
    $accessToken = md5(time().$userId.rand());
    
    return $accessToken;
  }
  
  public function getUserStatus($status, $options=array())
  {
    switch($status)
    {
      case CONTENT_ACTIVE: return "Active";
      
      case CONTENT_PENDING: return "Pending";
      
      case CONTENT_REJECTED: return "Denied";
      
      case CONTENT_PENDING: return "Rejected";
    }
  }
}
?>