<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-01-2012
 * Desc   : This class is base for all base classes.
 */ 
class restBase{
  
  protected function setResponse($code, $options=array())
  {
    if(!isset(autoload::$_RESPONSE[$code]))
	  { 
      $code = 'RESPONSE_CODE_NOT_FOUND';
    }
    autoload::$responseCode = autoload::$_RESPONSE[$code]['code'];
    autoload::$responseInfo = str_replace(array_keys($options), array_values($options), autoload::$_RESPONSE[$code]['message']);
	
    return true;
  }
  
  protected function setMemberVariable($name, $value, $options=array())
  {
    $this->$name = $value;
    return true;
  }
}
?>