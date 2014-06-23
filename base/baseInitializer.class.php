<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-01-2012
 * Desc   : This class is base class for all Initializers
 */ 
class baseInitialize extends restBase
{
  public $requestMethod;
  
  public $isSecured=false;
  
  public $parameter=array();
  
  public $_LANG = array();
  
  public $_CONFIG = array();
    
  public function getAuthParameter()
  {
    $authParameter = array();
    $authParameter['userId']  = array('name'=>'userId', 'required'=>true, 'description'=>'user_id of the logged in user');
    $authParameter['accessToken']  = array('name'=>'accessToken', 'required'=>true, 'description'=>'this parameter holds the access token');
	
    return $authParameter;
  }
  
  public function isValidAuthToken()
  {
    $sql = "SELECT count(*) as count from user where user_id=".$this->userId." and access_token='".$this->accessToken."'";
    $result = database::doSelectOne($sql);
	
    return ($result['count']>0)?true:false;
  }  
}
?> 