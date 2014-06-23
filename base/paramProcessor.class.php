<?php
/**
 * Author : Abhijth Shetty
 * Date   : 26-01-2012
 * Desc   : This class is responsible for processing the input parameters
 */
class paramProcessor extends restBase{
  
  private $value="";
  
  public function processParameter($param, $options=array())
  {
    $param['required'] = (isset($param['required']))?$param['required']:false;
    $param['validation'] = (isset($param['validation']))?$param['validation']:array();
	
    if(!isset($param['name']) || (trim($param['name'])==""))
    {
      $this->setResponse('PARAMETER_NAME_UNDEFINED');
      return array('result'=>false);
    }
    
    if($param['required'] && ((!(isset($_REQUEST[$param['name']]))) || $_REQUEST[$param['name']] ==""))
    {
      $this->setResponse('PARAMETER_IS_MANDATORY',array('paramName'=>$param['name']));
      return array('result'=>false);
    }
	
    if(!isset($param['description']) || (trim($param['description'])==""))
    {
      $this->setResponse('PARAMETER_DESCRIPTION_UNDEFINED', array('paramName'=>$param['name']));
      return array('result'=>false);
    }
	
    if(isset($_REQUEST[$param['name']]))
    {
      $this->value = $_REQUEST[$param['name']];
	  
      foreach($param['validation'] as $validation => $options)
      {
        if(is_int($validation)){
          $validation = $options;
          $options = "";
        }
		
        $validationLib = library::load("validationLib", $validation);
        $options = isset($param['validation'][$validation])?$param['validation'][$validation]:"";
        $response = $validationLib->validate($this->value, $options);
	 
        if($response['result']!==true){
          $options = isset($response['options'])?$response['options']:array();
          $this->setResponse($response['result'], array_merge(array('paramName'=>$param['name']),$options));
          return array('result'=>false);
        }
      }
    }
	
    if((!$param['required']) && (!isset($_REQUEST[$param['name']])))
    {
      $this->value = isset($param['default'])?$param['default']:"";
    }
	
    return array('result'=>true, "value"=>$this->value);
  }
}
?>