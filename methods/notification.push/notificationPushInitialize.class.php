<?php
class notificationPushInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = true;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["message"] = array("name"=>"message",
                                 "required"=>true,
                                 "description"=>"push notification message"
                                );
    
    
    
    return $parameter;
  }
}
