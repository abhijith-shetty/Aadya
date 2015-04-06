<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminConsole Component 
 */
class adminConsoleComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js,jquery.jsonview.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css,jquery.jsonview.css");

    autoload::loadFile('base', 'restBase.class.php');
    autoload::loadFile('base', 'baseInitializer.class.php');
    $path = autoload::getpath("methods", "");
    $this->apiList = scandir($path);
    $params = array();
    
    for($i=0; $i<count($this->apiList); $i++)
    {
      if(substr($this->apiList[$i], 0, 1) == "."){
        unset($this->apiList[$i]);
      }
    }
    
    if(isset($_GET['methodName']) && $_GET['methodName']!="")
    {
      $apiDirName = $_GET['methodName'];
      $arr = explode('.', $apiDirName);
      $apiName = $arr[0].ucfirst($arr[1]);
      $apiInitClassName = $apiName.'Initialize';
      autoload::loadFile('methods', $apiDirName.'/'.$apiName.'Initialize.class.php');
      $inst = new $apiInitClassName;
      $params = $inst->getParameter();              
      $defaultParameter = $inst->getDefaultParameter();
      if(!empty($inst->isSecured))
      {
        $authParams = $inst->getAuthParameter();
        $defaultParameter = array_merge($defaultParameter, $authParams);
      }
      $params = array_merge($defaultParameter, $params);
    }
    
    $this->params = $params;
  }
}