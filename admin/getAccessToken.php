<?php
require_once(dirname(__FILE__).'/../base/autoload.class.php');
autoload::initRest(dirname(__FILE__).'/../');
autoload::loadConfiguration();

$userId = $_REQUEST['userId'];
$result = database::doSelectOne("SELECT * FROM user WHERE user_id = ".$userId);
echo json_encode(array("accessToken"=>$result['access_token']));
?>