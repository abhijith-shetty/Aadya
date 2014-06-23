<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-01-2012
 * Desc   : This class is responsible for executing entire REST API
 */ 
class executor extends restBase{
  
  private $responseMsg="";
	
  public function executeMethod()
  {
    autoload::loadStrings();
    
    if(!$this->verifyDefaultParameter($this->getDefaultParameter()))
    {
      return false;
    }
    
    autoload::loadConfiguration();
    autoload::loadStrings($this->language);	

    
    if(!$this->methodExists($this->methodName))
    {
      $this->setResponse("METHOD_NOT_FOUND");
      return false;
    }
    
    if(!$this->versionExists($this->version))
    {
      $this->setResponse("VERSION_NOT_FOUND");
      return false;
    }
    
    if(!$this->executeInitializer())
    {
      return false;
    }
    
    if(!$this->executeAction())
    {
      return false;
    }
    
    return true;
  }
  
  public function getResponse($options=array())
  {
    header('Content-type: application/json');
	
    $response = json_encode(array('responseCode'=>autoload::$responseCode, "responseMsg"=>$this->responseMsg, "responseInfo"=>autoload::$responseInfo));
    return $response;
  }
  
  private function executeInitializer($options=array())
  {   
    $initializeClass = str_replace(" ", "", lcfirst(ucwords(str_replace(".", " ", $this->methodName)))).'Initialize';
    autoload::loadFile("methods", $this->methodName.'/'.$this->version.'/'.$initializeClass.'.class.php');
    $initialize = new $initializeClass();
	
    if(!$this->isValidRequestMethod($initialize->requestMethod))
    {
      $this->setResponse('INVALID_REQUEST_METHOD');
      return false;
    }
	 
    if($initialize->isSecured)
    {
      $authParameters = $initialize->getAuthParameter();
      foreach($authParameters as $parameter=>$description)
      { 
        $response = $this->verifyParameter($parameter, $description);
        if(!$response['result']){return false;}
      
        $initialize->setMemberVariable($parameter, $response['value']);
      }
          
      if(!$initialize->isValidAuthToken())
      {
        $this->setResponse('INVALID_AUTH_TOKEN');
        return false;
      }
    }
	
    $initialize->_CONFIG = autoload::$_CONFIG;
    $initialize->_LANG   = autoload::$_STRING;
      
    return true;    	
  }
  
  private function executeAction($options=array())
  {
    $initializeClass = str_replace(" ", "", lcfirst(ucwords(str_replace(".", " ", $this->methodName)))).'Initialize';
    autoload::loadFile("methods",$this->methodName.'/'.$this->version.'/'.$initializeClass.'.class.php');
    $initialize = new $initializeClass();
    
    $actionClass = str_replace(" ", "", lcfirst(ucwords(str_replace(".", " ", $this->methodName)))).'Action';
    autoload::loadFile("methods",$this->methodName.'/'.$this->version.'/'.$actionClass.'.class.php');
    $action = new  $actionClass();
	
    $parameters = $initialize->getParameter();
    foreach($parameters as $parameter=>$description)
    { 
      $response = $this->verifyParameter($parameter, $description);
      if(!$response['result']){return false;}
	  
      $action->setMemberVariable($parameter, $response['value']);
    }
	
    $defaultParameters = $this->getDefaultParameter();
    foreach($defaultParameters as $parameter=>$description)
    { 
      $action->setMemberVariable($parameter, $this->$parameter);
    }
    
    if($initialize->isSecured)
    {
      $authParameters = $initialize->getAuthParameter();
      foreach($authParameters as $parameter=>$description)
      { 
        $action->setMemberVariable($parameter, $_REQUEST[$description['name']]);//quick fix untill YAML is implemented
      }
    }
    $action->_CONFIG = autoload::$_CONFIG;
    $action->_LANG   = autoload::$_STRING;
    
    $this->responseMsg = $action->execute();
      
    return true;
  }
  
  private function methodExists($methodName, $options=array())
  {
    if($methodName!="")
    {
      if(is_dir(autoload::getPathByType('methods').'/'.$methodName))
      {
        $this->methodName = $methodName;
        return true;
      }
    }
    
    return false;
  }
  
  private function versionExists($version, $options=array())
  {
    if($version!="")
    {
      $this->version = (is_dir(autoload::getPathByType('methods').'/'.$this->methodName.'/'.$version))?$version:"";
    }
    
    return true;
  }
  
  private function isValidRequestMethod($requestMethod, $options=array())
  {
    if(!in_array($_SERVER['REQUEST_METHOD'],$requestMethod))
    {
      $this->setResponse('INVALID_REQUEST_METHOD');
      return false;
    }
    
    return true;
  }
  
  private function verifyParameter($name, $description, $options=array())
  {
    autoload::loadFile("base","paramProcessor.class.php");
    $paramProcessor = new paramProcessor();
    $response = $paramProcessor->processParameter($description);
    if(!$response['result'])
    {
      return array("result"=>false);
    }
    
    return array("result"=>true, "value"=>$response['value']);
  }
  
  private function verifyDefaultParameter($parameters, $options=array())
  {
    foreach($parameters as $parameter=>$description)
    { 
      $response = $this->verifyParameter($parameter, $description);
      if(!$response['result']){return false;}
	  
      $this->setMemberVariable($parameter, $response['value']);
    }
	
    return true;
  }
  
  private function getDefaultParameter($options=array())
  {
    $defaultParameter = array();
    $defaultParameter['language']       = array('name'=>'language', 'required'=>false, 'default'=>'en', 'description'=>'this parameter tells what response language should be');
    $defaultParameter['methodName']     = array('name'=>'methodName', 'required'=>true, 'description'=>'this parameter holds the api name');
    $defaultParameter['version']        = array('name'=>'version', 'required'=>false, 'description'=>'this parameter holds the api version number');
    $defaultParameter['applicationKey'] = array('name'=>'applicationKey', 'required'=>true, 'description'=>'this parameter holds the application key');
    $defaultParameter['responseFormat'] = array('name'=>'responseFormat', 'required'=>false, 'default'=>'json', 'description'=>'this parameter tells what response format should be');
    
    return $defaultParameter;
  }
}
?>