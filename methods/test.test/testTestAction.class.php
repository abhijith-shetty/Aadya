<?php
/**
 * Author : Abhijth Shetty
 * Date   : 30-07-2014
 * Desc   : This is a controller file for testTest Action 
 */
class testTestAction extends baseAction{
  
  public function execute()
  {
    //$anyLib = autoload::loadLibrary('queryLib', 'any');
    $result = array();
    
    $this->setResponse('SUCCESS');
    return $result;
  }  
}