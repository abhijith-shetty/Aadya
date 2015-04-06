<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminIndex Component 
 */
class adminIndexComponent extends baseComponent
{
  public $isSecured = false;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css");
    
    $this->result = array('error'=>false);
    
    if(isLoggedInUser()){
      $this->redirectTo(getComponentUrl('admin','home'));
    }
    
    if(isPost())
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      //$rememberMe = (isset($_POST['rememberMe']) && $_POST['rememberMe']=="on")?true:false;
      
      if(($username!=getConfig('admin_username')) || ($password!=getConfig('admin_password'))){
        $this->result = array('error'=>true, 'message'=>'Invalid Credential. Try Again.');
        return true;
      }
      
      $_SESSION['user_id']   = "admin";
      $_SESSION['user_role'] = USER_ROLE_ADMIN;
      $_SESSION['user_name'] = "Administrator";
      
      $this->redirectTo(getComponentUrl('admin','home'));
    }
  }
}