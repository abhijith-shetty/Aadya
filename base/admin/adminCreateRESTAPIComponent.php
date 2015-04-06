<?php
/**
 * Author : Abhijth Shetty
 * Date   : 31-03-2015
 * Desc   : This is a controller file for adminCreateRESTAPI Component 
 */
class adminCreateRESTAPIComponent extends baseComponent
{
  public function execute()
  {
	  $this->result = array('error'=>false, "success"=>false, 'message'=>"");
    if(isPost())
    {
      if($_GET['action'] == "createRESTAPI" )
      {
        $path = autoload::getPath('methods', "");
        if(!is_writable($path))
        {
          $this->result = array('error'=>true, 'message'=>"Methods directory is not writable. Please make this directory ".$path . " writable.");
          return false;
        }
        
        $apiName = $_POST['apiName'];
        $arr = explode(".", $apiName);
        if(count($arr) != 2)
        {
          $this->result = array('error'=>true, 'message'=>"API Name should be in api.name format. Ex, user.index, article.share");
          return false;
        }
        
        $response = exec("php ".autoload::getPath('task', 'createRestMethod.task.php')." ".$apiName);
        if($response != "")
        {
          $this->result = array('error'=>true, 'message'=>$response);
          return false;
        }
        
        $this->redirectTo(getComponentUrl('admin', 'manage', array('methodName'=>$apiName)));
      }
    }
  }
}