<?php

/**
 * Author : Abhijth Shetty
 * Date   : 21-01-2012
 * Desc   : This class is base class for all Initializers
 */
class baseInitialize extends restBase
{
  public $requestMethod;

  public $isSecured = false;

  public $parameter = array();

  public $_LANG = array();

  public $_CONFIG = array();

  public function getDefaultParameter($options = array())
  {
    $defaultParameter = array();
    $defaultParameter['language'] = array('name' => 'language', 'required' => false, 'default' => 'en', 'showInConsole' => false, 'description' => 'this parameter tells what response language should be');
    $defaultParameter['methodName'] = array('name' => 'methodName', 'required' => true, 'showInConsole' => false, 'description' => 'this parameter holds the api name');
    $defaultParameter['version'] = array('name' => 'version', 'required' => false, 'showInConsole' => false, 'description' => 'this parameter holds the api version number');
    $defaultParameter['applicationKey'] = array('name' => 'applicationKey', 'required' => true, 'default' => '12345', 'description' => 'this parameter holds the application key');
    $defaultParameter['responseFormat'] = array('name' => 'responseFormat', 'required' => false, 'showInConsole' => false, 'default' => 'json', 'description' => 'this parameter tells what response format should be');

    return $defaultParameter;
  }

  public function getAuthParameter()
  {
    $authParameter = array();
    $authParameter['userId'] = array('name' => 'user_id', 'required' => true, 'description' => 'user_id of the logged in user');
    $authParameter['accessToken'] = array('name' => 'access_token', 'required' => true, 'description' => 'this parameter holds the access token');

    return $authParameter;
  }

  public function isValidAuthToken()
  {
    $sql = "SELECT count(*) as count from user where user_id=" . $this->userId . " and access_token='" . $this->accessToken . "'";
    $result = database::doSelectOne($sql);

    return ($result['count'] > 0) ? true : false;
  }
}

?>
