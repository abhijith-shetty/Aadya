<?php
/**
 * Author : Abhijth Shetty
 * Date   : 28-05-2014
 * Desc   : This is a controller file for chatAddGlobal Action 
 */
class chatAddGlobalAction extends baseAction{
  
  public function execute()
  {
  	$chatGlobalLib = autoload::loadLibrary('queryLib', 'chatGlobal');
    $chatRoomLib = autoload::loadLibrary('queryLib', 'chatRoom');
	  $userLib = autoload::loadLibrary('queryLib', 'user');
    $result = array();
	
	  if(!$chatRoomLib->validateMessageLength($this->message)){		
	    $this->setResponse('CUSTOM_ERROR', array('error'=>'message length should be less than 500 character'));
	    return false;
	  }
	
	  $userDetail = $userLib->getUserDetail($this->userId);
	
	  $chatGlobalId =$chatGlobalLib->insertChatGlobal(array("user_id"	=> $this->userId,
                                                    "user_name"  	=> $userDetail['name'],
                                                    "message"  	    => $this->message,                                                    
                                                    "created_at"	=> date('Y-m-d H:i:s'),
                                                    "status"     	=> CONTENT_PENDING
                                    		 ));	
    
    $this->setResponse('SUCCESS');
    return array('chatGlobalId' => $chatGlobalId);
  }  
}