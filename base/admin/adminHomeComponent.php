<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminHome Component 
 */
class adminHomeComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css");
    
    $protocol = explode('/', $_SERVER['SERVER_PROTOCOL']);
    $protocol = strtolower($protocol[0]).'://';
    $this->url = $protocol.$_SERVER['SERVER_NAME'].str_replace("index.php", "rest.php", $_SERVER['PHP_SELF']);
  }
}