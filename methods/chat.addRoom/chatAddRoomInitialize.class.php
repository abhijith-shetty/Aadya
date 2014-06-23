<?php
class chatAddRoomInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = true;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["roomId"]	= array("name"=>"roomId",
                                  "required"=>true,
                                  "description"=>"Which room user going to add message"
    );
	
	  $parameter["message"]	= array("name"=>"message",
                                  "required"=>true,
                                  "description"=>"user chat message, should be sent with url encode"
    );
    
    return $parameter;
  }
}