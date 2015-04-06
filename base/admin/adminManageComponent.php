<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminManage Component 
 */
class adminManageComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css");
    
    autoload::loadFile('base', 'restBase.class.php');
    autoload::loadFile('base', 'baseInitializer.class.php');
    $path = autoload::getpath("methods", "");
    $this->apiList = scandir($path);
    $params = array();
    $this->result = array('error'=>false);
    
    for($i=0; $i<count($this->apiList); $i++)
    {
      if(substr($this->apiList[$i], 0, 1) == "."){
        unset($this->apiList[$i]);
      }
    }
  }
}