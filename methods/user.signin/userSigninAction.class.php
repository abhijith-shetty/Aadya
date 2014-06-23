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
    
	if(!($this->type == USER_FACEBOOK || $this->type == USER_GUEST))
	{
	  $this->setResponse('CUSTOM_ERROR', array('error'=>'type can be 1-guest, 2-facebook.'));
	  return $result;
	}
	
	//check facebookId
	
	if($this->type == USER_FACEBOOK)
	{	
		if(!isset($this->facebookId) || empty($this->facebookId))
		{
		  $this->setResponse('CUSTOM_ERROR', array('error'=>'facebookId Mandatory Paramenter'));
		  return false;
		}
	}
	
	//check facebookId in DB or not
		$facebookUser = $userLib->checkFacebookId($this->facebookId);
	   
		if($this->type == USER_FACEBOOK && $facebookUser['user_id'])	
		{
			$userDetail = $userLib->getUserDetail($facebookUser['user_id']);
			$this->setResponse('SUCCESS');
      return array('userId' => $userDetail['user_id'], "name"=> $userDetail['name'], "access_token" => $userDetail['access_token'] );	
		} else {
			 $this->name = (empty($this->name))?("guest_".str_pad(rand(0, pow(10, 10)-1), 10, '0', STR_PAD_LEFT)):$this->name;	
       $userId = $userLib->insertUser(array("name"          => $this->name,
                                            "facebook_id"    => $this->facebookId,
                                            "access_token"   => md5(md5($this->name).md5(time())),
                                            "image"          =>$this->thumbnail,
                                            "ios_push_id"    =>$this->iosPushId,
                                            "android_push_id"=>$this->androidPushId,
                                            "type"           =>$this->type,
                                            "created_at"	   =>date('Y-m-d H:i:s'),
                                            "status"         =>CONTENT_ACTIVE
                                     ));
										
	     $userDetail = $userLib->getUserDetail($userId);
		   
		   $this->setResponse('SUCCESS');
       return array('userId' => $userId, "name"=> $this->name, "access_token" => $userDetail['access_token'] );
		}
  }  
}
