<?php 
if(!isset($argv[1]))
{
	die("enter module name\n");
}
$moduleName = $argv[1];
$templateName = $moduleName.ucfirst(isset($argv[2])?$argv[2]:'index');

$dirPath = dirname(dirname(__FILE__)).'/modules/'.$moduleName;
$templateFilePath  = $dirPath.'/'.$templateName.'Tpl.php';

if(!is_dir($dirPath))
{
	mkdir($dirPath);
  chmod($dirPath, 0777);
}

if(is_file($templateFilePath))
{
  die("files already exists\n");
}

file_put_contents($templateFilePath, "");
chmod($templateFilePath, 0777);
?>