<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-05-2014
 * Desc   : This is a controller file for userSignin Action 
 */
class userSigninAction extends baseAction{
  
  public function execute()
  {
    $userLib = autoload::loadLibrary('queryLib', 'user');
    $result = array();
    
	  $userId = $userLib->insertUser(array("name" => $this->name,
                                         "access_token" => md5(md5($this->name).md5(time())),
                                         "created_at" => date('Y-m-d H:i:s'),
                                         "status" => CONTENT_ACTIVE
                                     ));
										
	  $userDetail = $userLib->getUserDetail($userId);
		   
		$this->setResponse('SUCCESS');
    return array('userId' => $userId, "name"=> $this->name, "access_token" => $userDetail['access_token'] );
  }  
}