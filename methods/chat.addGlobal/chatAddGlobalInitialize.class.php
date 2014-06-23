<?php
class chatAddGlobalInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = true;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["message"]	= array("name"=>"message",
                                  "required"=>true,
                                  "description"=>"user chat message, should be sent with url encode"
    );    
    
    return $parameter;
  }
}