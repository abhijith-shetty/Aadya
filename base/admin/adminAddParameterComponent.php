<?php
/**
 * Author : Abhijth Shetty
 * Date   : 22-03-2015
 * Desc   : This is a controller file for adminAddParameter Component 
 */
class adminAddParameterComponent extends baseComponent
{
  public $isSecured = USER_ROLE_ADMIN;
  
  public $layoutName = "admin_layout";
  
  public function execute()
  {
    autoload::loadFile('base', 'restBase.class.php');
    autoload::loadFile('base', 'baseInitializer.class.php');
    $params = $this->param = array();
    $this->options = array("security"=>false, 'httpMethod'=>array('GET', 'POST'));
    $this->result = array('error'=>false);
    
    if(isset($_GET['methodName']) && $_GET['methodName']!="")
    {
      $apiDirName = $_GET['methodName'];
      $arr = explode('.', $apiDirName);
      $apiName = $arr[0].ucfirst($arr[1]);
      $apiInitClassName = $apiName.'Initialize';
      autoload::loadFile('methods', $apiDirName.'/'.$apiName.'Initialize.class.php');
      $inst = new $apiInitClassName;
      $params = $inst->getParameter();              
      $this->options = array('security'=>$inst->isSecured, 'httpMethod'=>$inst->requestMethod);
      $path = autoload::getPath('methods', $apiDirName.'/'.$apiName.'Initialize.class.php');
      if(!is_writable($path))
      {
        $this->result = array('error'=>true, 'message'=>"No permission to update file. Please make this file ".$path . " writable.");
        return false;
      }
    }
    
    $this->params = $params;
    
    if(isPost())
    {
      $newParams = array();
      for($i=0; $i<count($_POST['parameter']); $i++)
      {
        $newParams[$_POST['parameter'][$i]] = array("name" => $_POST['name'][$i],
                                                    "required" => $_POST['required'][$i],
                                                    "default" => $_POST['default'][$i],
                                                    "description" => $_POST['description'][$i]                                           
                                                   );
      }
      
      $settings = array('security'=>$_POST['security'], 'httpMethod'=>('"'.implode('", "', $_POST['http_method']).'"'));
      $this->createRestInitializeClass($_GET['methodName'], $newParams, $settings);
      $this->redirectTo(getComponentUrl('admin', 'console', array('methodName'=>$_GET['methodName'])));
    }
  }
  
  private function createRestInitializeClass($methodName, $params, $settings)
  {
    $initContents = <<< 'EOT'
<?php
class ##$##Initialize extends baseInitialize{

  public $requestMethod = array(##HTTPMETHOD##);
  public $isSecured = ##SECURITY##;
	
  public function getParameter()
  {
    $parameter = array();
    
    ##PARAM##    
    return $parameter;
  }
}
EOT;

    $arr = explode('.', $methodName);
    $apiName = $arr[0].ucfirst($arr[1]);
    $initFilePath = autoload::getPath('methods', $methodName.'/'.$apiName.'Initialize.class.php');
    
    $paramTemp = "";
    foreach($params as $key=>$param)
    {
      $paramTemp .= '$parameter["'.$key.'"] = array("name"=>"'.$param['name'].'",
                                  "required"=>'.(($param['required']=="true")?"true":"false").',
                                  "default"=>"'.$param['default'].'",
                                  "description"=>"'.$param['description'].'"
    );
    
    ';
    }

    $initContents = str_replace("##$##", $apiName, $initContents);
    $initContents = str_replace("##PARAM##", $paramTemp, $initContents);
    $initContents = str_replace("##SECURITY##", $settings['security'], $initContents);
    $initContents = str_replace("##HTTPMETHOD##", $settings['httpMethod'], $initContents);
    file_put_contents($initFilePath, $initContents);
    
    return true;
  }
}