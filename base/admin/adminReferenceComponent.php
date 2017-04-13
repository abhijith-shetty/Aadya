<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for homeIndex Component 
 */
class adminReferenceComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
	  $this->includeJavascript('jquery-1.10.1.min.js,bootstrap.min.js');
    $this->includeStylesheet("bootstrap.min.css,admin.css");
    
    autoload::loadFile('base', 'restBase.class.php');
    autoload::loadFile('base', 'baseInitializer.class.php');
    require(autoload::getpath('i18n', 'response.en.php'));

    $path = autoload::getpath("methods", "");
    $apiDirNameList = scandir($path);
    $apiList = array();
    
    foreach($apiDirNameList as $apiDirName)
    {
      if(substr($apiDirName, 0, 1) == "."){
        continue;
      }
      
      $apiList[$apiDirName] = array();
      $arr = explode('.', $apiDirName);
      $apiName = $arr[0].ucfirst($arr[1]);
      $apiInitClassName = $apiName.'Initialize';
      autoload::loadFile('methods', $apiDirName.'/'.$apiName.'Initialize.class.php');
      $inst = new $apiInitClassName;
      $params = $inst->getParameter();
      $desc = $inputParam = "";
      foreach($params as $param) 
      {
        $opt = ($param['required'])?"":" (optional)";
        $inputParam .= $param['name'].$opt."<br/>";
        $desc .= $param['name']."<b>&nbsp;:&nbsp;</b>".$param['description']."<br/>";
      }
      
      $apiList[$apiDirName]['inputParam'] = $inputParam;
      $apiList[$apiDirName]['desc'] = $desc;
    }   
    
    //constant values
    $constantList = get_defined_constants(true)['user'];
    $this->constantList = $constantList;
    $this->responseList = $response;  //included via i18n/response.en.php
    $this->apiList = $apiList;  
  }
}