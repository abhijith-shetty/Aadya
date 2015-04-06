<?php
/**
 * Author : Abhijth Shetty
 * Date   : 06-06-2013
 * Desc   : This is a controller file for homeIndex Component 
 */
class homeIndexComponent extends baseComponent
{
  public $isSecured = false;
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css");
    
    $this->message = "Welcome to ".getConfig('project_title')." !!!";
  }
}