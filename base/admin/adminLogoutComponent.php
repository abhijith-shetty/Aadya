<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminLogout Component 
 */
class adminLogoutComponent extends baseComponent
{
  public function execute()
  {
	  $userUtilityLib = autoload::loadLibrary('utilityLib', 'userUtility');
    $userUtilityLib->clearCredential();
    
    $this->redirectTo(getComponentUrl('admin','index'));
  }
}