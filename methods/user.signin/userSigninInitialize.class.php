<?php
class userSigninInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = false;
	
  public function getParameter()
  {
    $parameter = array();
  
    $parameter["name"] = array("name"=>"name",
                               "required"=>false,
                               "description"=>"name of the user"
    );
    
  	return $parameter;
  }
}