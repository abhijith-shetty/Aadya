<?php
class userSigninInitialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = false;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["type"]       = array( "name"=>"type",
	                              "required"=>true,
                                      "description"=>"1- Guest Login and 2- Facebook Login."
    );
    
    $parameter["facebookId"] = array( "name"=>"facebookId",
                                      "required"=>false,
                                      "description"=>"facebookId of the user"
    );
    
	$parameter["name"]       = array( "name"=>"name",
                                      "required"=>false,
                                      "description"=>"name of the user"
    );
	
	$parameter["thumbnail"]  = array( "name"=>"thumbnail",
                                      "required"=>false,
                                      "description"=>"thumbnail of the user"
    );
	
	$parameter["iosPushId"]  = array( "name"=>"iosPushId",
                                      "required"=>false,
                                      "description"=>"iosPushId of the user"
    );
	
	$parameter["androidPushId"] = array( "name"=>"androidPushId",
                                         "required"=>false,
                                         "description"=>"androidPushId of the user"
    );
    
	return $parameter;
  }
}
