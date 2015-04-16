<?php 
if(!isset($argv[1]))
{
	die("enter module name\n");
}
$moduleName = $argv[1];
$componentName = $moduleName.ucfirst(isset($argv[2])?$argv[2]:'index');

$dirPath = dirname(dirname(__FILE__)).'/modules/'.$moduleName;
$componentFilePath = $dirPath.'/'.$componentName.'Component.php';
$templateFilePath  = $dirPath.'/'.$componentName.'Tpl.php';

if(!is_dir($dirPath))
{
	mkdir($dirPath);
  chmod($dirPath, 0777);
}

if(is_file($componentFilePath) || is_file($templateFilePath))
{
  die("files already exists\n");
}

$componentContents = <<< STRUCT
<?php
/**
 * Author : Abhijth Shetty
 * Date   : ddmmyyyy
 * Desc   : This is a controller file for ##$## Component 
 */
class ##$##Component extends baseComponent
{
  public function execute()
  {
	
  }
}
STRUCT;

$componentContents = str_replace("##$##", $componentName, $componentContents);
$componentContents = str_replace("ddmmyyyy", date('d-m-Y'), $componentContents);

file_put_contents($componentFilePath, $componentContents);
file_put_contents($templateFilePath, "");

chmod($componentFilePath, 0777);
chmod($templateFilePath, 0777);
?>