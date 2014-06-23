<?php
$response['METHOD_NOT_FOUND'] = array("code"=>'201', "message"=>'api_method does not exists');
$response['VERSION_NOT_FOUND'] = array("code"=>'202', "message"=>'The requested version does not exists');
$response['INVALID_REQUEST_METHOD'] = array("code"=>'203', "message"=>'The requested request method does not exists');
$response['INVALID_AUTH_TOKEN'] = array("code"=>'204', "message"=>'The auth token in invalid');
$response['SUCCESS'] = array("code"=>'001', "message"=>'Everything worked as expected');
$response['RESPONSE_CODE_NOT_FOUND'] = array("code"=>'205', "message"=>'Response code failure');
$response['INVALID_EMAIL'] = array("code"=>'206', "message"=>'paramName should be a Valid email address');
$response['PARAMETER_IS_MANDATORY'] = array("code"=>'207', "message"=>'paramName Mandatory Parameter');
$response['INVALID_INPUT_EMPTY'] = array("code"=>'208', "message"=>'paramName should not be empty');
$response['INVALID_BOOLEAN_INPUT'] = array("code"=>'209', "message"=>'paramName should be a boolean value');
$response['PARAMETER_DESCRIPTION_UNDEFINED'] = array("code"=>'210', "message"=>'paramName should have a description');
$response['INVALID_INPUT_INTEGER'] = array("code"=>'210', "message"=>'paramName should be a integer');
$response['INVALID_INPUT_STRING'] = array("code"=>'211', "message"=>'paramName should be a string');
$response['INVALID_STRING_MAX_SIZE'] = array("code"=>'212', "message"=>'paramName lenght should be a less than size characters');
$response['INVALID_STRING_MIN_SIZE'] = array("code"=>'213', "message"=>'paramName length should be a greater than size characters');
$response['INVALID_INPUT_INTEGER_MAX'] = array("code"=>'214', "message"=>'paramName should be less than value');
$response['INVALID_INPUT_INTEGER_MIN'] = array("code"=>'215', "message"=>'paramName should be greater than value');
$response['ERROR_LOGIN'] = array("code"=>'216', "message"=>'Invalid Credential, Please try again.');
$response['CUSTOM_ERROR'] = array("code"=>'228', "message"=>'error');
?>