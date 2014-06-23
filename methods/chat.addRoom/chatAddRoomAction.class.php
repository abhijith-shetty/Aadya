<?php
/**
 * Author : Abhijth Shetty
 * Date   : 27-05-2014
 * Desc   : This is a controller file for chatAddRoom Action 
 */
class chatAddRoomAction extends baseAction{
  
  public function execute()
  {
    $chatRoomLib = autoload::loadLibrary('queryLib', 'chatRoom');
	  $roomLib = autoload::loadLibrary('queryLib', 'room');
	  $userLib = autoload::loadLibrary('queryLib', 'user');
	
    //validation for roomid
	  if(!$roomLib->validateRoomId($this->roomId)){
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'roomId does not Exist'));
	    return false;
	  }	
	
	  //message validation	
	  if(!$chatRoomLib->validateMessageLength($this->message)){		
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'message length should be less than 500 character'));
	    return false;
	  }
	
		
	  $userDetail = $userLib->getUserDetail($this->userId);
	
	  $chatRoomId =$chatRoomLib->insertChatRoom(array("room_id"   	=> $this->roomId,
	                                                  "user_id"	    => $this->userId,
                                                    "user_name"  	=> $userDetail['name'],
                                                    "message"  	  => $this->message,                                                    
                                                    "created_at"	=> date('Y-m-d H:i:s'),
                                                    "status"     	=> CONTENT_PENDING
                                    		 ));	
	
    
	  $this->setResponse('SUCCESS');
    return array('chatRoomId'=>$chatRoomId);
  }  
}