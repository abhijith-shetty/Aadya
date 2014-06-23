<?php
/**
 * Author : Abhijth Shetty
 * Date   : 27-05-2014
 * Desc   : This is a controller file for chatGetRoom Action 
 */
class chatGetRoomAction extends baseAction{
  
  public function execute()
  {
    $chatRoomLib = autoload::loadLibrary('queryLib', 'chatRoom');
    $roomLib = autoload::loadLibrary('queryLib', 'room');
    $result = array();
	
    //validation for roomId		
	  if(!$roomLib->validateRoomId($this->roomId)){
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'roomId does not Exist'));
	    return false;
	  }
    
    //validation for lastId
	  if(!$chatRoomLib->validateLastId($this->lastId)){		
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'lastId should be numeric only'));
	    return false;
	  }
		
	  $result = $chatRoomLib->getChatRoom($this->roomId, $this->lastId);
    
    if($this->lastId == 0){
      $result = array_reverse($result);
    }
    
    $this->setResponse('SUCCESS');
	  return $result;
  }  
}