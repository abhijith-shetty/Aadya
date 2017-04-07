<?php 
if(!isset($argv[1]))
{
	die("Enter method name\n");
}

$methodName = $argv[1];
$temp = explode('.', $methodName);

if(count($temp) != 2 ) {
  die("Error file name, format should be name.subname\n");
}

$className = $temp[0].ucfirst($temp[1]);

$dirPath = dirname(dirname(__FILE__)).'/methods/'.$methodName;
$initFilePath = $dirPath.'/'.$className.'Initialize.class.php';
$actionFilePath  = $dirPath.'/'.$className.'Action.class.php';

if(!is_dir($dirPath))
{
	mkdir($dirPath);
  chmod($dirPath, 0777);
}

if(is_file($initFilePath) || is_file($actionFilePath))
{
  die("API already exists\n");
}

$initContents = <<< 'EOT'
<?php
class ##$##Initialize extends baseInitialize{

  public $requestMethod = array("GET", "POST");
  public $isSecured = false;
	
  public function getParameter()
  {
    $parameter = array();
    
    $parameter["title"] = array(
      "name"=>"title_exposed_to_api",
      "type"=>"text",
      "required"=>false,
      "default"=>"",
      "description"=>"parameter description"
    );
    
    return $parameter;
  }
}
EOT;

$actionContents = <<< 'EOT'
<?php
/**
 * Author : Abhijth Shetty
 * Date   : ddmmyyyy
 * Desc   : This is a controller file for ##$## Action 
 */
class ##$##Action extends baseAction{
  
  public function execute()
  {
    //$anyLib = autoload::loadLibrary('queryLib', 'any');
    $result = array();
    
    $this->setResponse('SUCCESS');
    return $result;
  }  
}
EOT;

$initContents = str_replace("##$##", $className, $initContents);
$initContents = str_replace("ddmmyyyy", date('d-m-Y'), $initContents);

$actionContents = str_replace("##$##", $className, $actionContents);
$actionContents = str_replace("ddmmyyyy", date('d-m-Y'), $actionContents);

file_put_contents($initFilePath, $initContents);
file_put_contents($actionFilePath, $actionContents);

chmod($initFilePath, 0777);
chmod($actionFilePath, 0777);
?>