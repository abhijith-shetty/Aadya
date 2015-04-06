<?php
/**
 * Author : Abhijth Shetty
 * Date   : 31-03-2015
 * Desc   : This is a controller file for adminCreateComponent Component 
 */
class adminCreateComponentComponent extends baseComponent
{
  public function execute()
  {
	  $this->result = array('error'=>false, "success"=>false, 'message'=>"");
    if(isPost())
    {
      if($_GET['action'] == "createModule" )
      {
        if($_POST['moduleName'] == "" || $_POST['componentName'] == "")
        {
          $this->result = array('error'=>true, 'message'=>"Module Name and Component Name are mandatory.");
          return false;
        }
        
        $path = (is_dir(autoload::getPath('modules', $_POST['moduleName'])))?autoload::getPath('modules', $_POST['moduleName']):autoload::getPath('modules', "");
        if(!is_writable($path))
        {
          $this->result = array('error'=>true, 'message'=>"modules directory is not writable. Please make this directory ".$path . " writable.");
          return false;
        }
        
        $response = exec("php ".autoload::getPath('task', 'createComponent.task.php')." ".$_POST['moduleName']." ".$_POST['componentName']);
        if($response != "")
        {
          $this->result = array('error'=>true, 'message'=>$response);
          return false;
        }
        
        $this->result = array('success'=>true, 'message'=>"New module created, access it at <br/>\"http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].getComponentUrl($_POST['moduleName'], $_POST['componentName']).'"');
        $_POST['moduleName'] = $_POST['componentName'] = "";
        return false;
      }
    }
  }
}