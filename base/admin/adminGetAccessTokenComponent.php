<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminGetAccessToken Component 
 */
class adminGetAccessTokenComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public function execute()
  {
	  $userId = $_REQUEST['userId'];
    $result = database::doSelectOne("SELECT * FROM user WHERE user_id = ".$userId);
    sendAjaxResponse("success", $result['access_token']);
  }
}