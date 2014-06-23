<?php
class chatGetGlobalInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = true;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["lastId"]	= array("name"=>"lastId",
                                  "required"=>true,
                                  "description"=>"last chat global message id"
    ); 
    
    return $parameter;
  }
}