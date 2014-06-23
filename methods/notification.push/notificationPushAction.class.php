<?php
/**
 * Author : Abhijth Shetty
 * Date   : 10-06-2014
 * Desc   : This is a controller file for notificationPush Action 
 */
class notificationPushAction extends baseAction{
  
  public function execute()
  {
   
     $notificationLib = autoload::loadLibrary('utilityLib', 'pushNotification');
     $result = array();
     
     $deviceToken = "39a1677e101e49905aa37ff8bd2684e23f6feeb4cf3f56a3e47e31e57d55116b";
     $notificationLib->iOSPushNotification($deviceToken, "Hello World !!!");       

     $this->setResponse('SUCCESS');
     return true;	
    
  }  
}
