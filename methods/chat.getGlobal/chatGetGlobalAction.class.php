<?php
/**
 * Author : Abhijth Shetty
 * Date   : 28-05-2014
 * Desc   : This is a controller file for chatGetGlobal Action 
 */
class chatGetGlobalAction extends baseAction{
  
  public function execute()
  {
    $chatGlobalLib = autoload::loadLibrary('queryLib', 'chatGlobal');
  	$chatRoomLib = autoload::loadLibrary('queryLib', 'chatRoom');
    $result = array();
	
	  //validation for lastId
	  if(!$chatRoomLib->validateLastId($this->lastId)){		
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'lastId should be numeric only'));
	    return false;
	  }
	
	  $result = $chatGlobalLib->getChatGlobal($this->lastId);
	  
    if($this->lastId == 0){
      $result = array_reverse($result);
    }
    
    $this->setResponse('SUCCESS');
    return $result;
  }  
}