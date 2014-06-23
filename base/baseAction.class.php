<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-01-2012
 * Desc   : This class is base for all Actions
 */ 
abstract class baseAction extends restBase
{
  public $_responseCode = '001';
  
  public $_LANG = array();
  
  public $_CONFIG = array();
    
  abstract function execute();
  
  //deprecated function do not use
  public function setResponseCode($code, $options=array())
  {
    $this->_responseCode = $code;
	  return true;
  }
  
} 
?> 