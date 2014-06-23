<?php
class chatGetRoomInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = true;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["roomId"]	= array("name"=>"roomId",
                                  "required"=>true,
                                  "description"=>"Which room user going to start"
    );
	
  	$parameter["lastId"]	= array("name"=>"lastId",
                                  "required"=>true,
                                  "description"=>"last chat room message id"
    );    
    
    return $parameter;
  }
}