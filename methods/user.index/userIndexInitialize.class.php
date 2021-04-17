<?php

class userIndexInitialize extends baseInitialize
{

  public $requestMethod = array("GET", "POST");
  public $isSecured = false;

  public function getParameter()
  {
    $parameter = array();

    $parameter["title"] = array("name" => "title_exposed_to_api",
      "required" => false,
      "default" => "",
      "description" => "parameter description"
    );


    return $parameter;
  }
}
