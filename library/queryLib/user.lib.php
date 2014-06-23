<?php
class user{
  //Singleton
  protected static $objInstance;

  public static function get(){
    if(!isset(self::$objInstance)){
      $class=__CLASS__;
      self::$objInstance=new $class;
    }
    return self::$objInstance;
  }
  
  public function checkCredential($username, $password, $options=array())
  {
    $sql = "Select user_id from user where username='".$username."' and password='".$password."'";
	  $result = database::doSelectOne($sql);

	  return isset($result['user_id'])?$result['user_id']:false;
  }
  
  public function getUserDetail($userId, $options=array())
  {
    $sql = "Select * from user where user_id=".$userId;
    $result = database::doSelectOne($sql);
	
    return $result;
  }
  
  public function insertUser($options=array())
  {
    $sql="INSERT INTO user SET "; 
    foreach($options as $key=>$value){
      $sql .= $key."='".$value."', ";
    }    
    $sql = rtrim($sql, ", ");
	  $result = database::doInsert($sql);
    
    return $result;
  }
  
  public function  updateUser($userId, $options=array())
  {
    $sql="UPDATE user SET "; 
    foreach($options as $key=>$value){
      $sql .= $key."='".$value."', ";
    }    
    $sql = rtrim($sql, ", ");
    $sql .= "WHERE user_id =".$userId;
	  $result = database::doUpdate($sql);
    
    return $result;
  }
  
  public function getUserList($options=array())
  {
    $sql = "SELECT *
            FROM user";
    
    $result = database::doSelect($sql);
    return $result;
  }
  
  public function validateUserId($userId, $options=array())
  {
    $sql = "SELECT status 
            FROM user
            WHERE user_id=".$userId;
    $result = database::doSelectOne($sql);
	
    return (isset($result['status']))? $result['status']:false;
  }
}
?>