<?php
/**
 * Author : Abhijth Shetty
 * Date   : 31-03-2015
 * Desc   : This is a controller file for adminCreateLibrary Component 
 */
class adminCreateLibraryComponent extends baseComponent
{
  public function execute()
  {
	  $this->result = array('error'=>false, "success"=>false, 'message'=>"");
    if(isPost())
    {
      if($_GET['action'] == "createLibrary" )
      {
        if($_POST['libraryDirectory'] == "" || $_POST['libraryName'] == "")
        {
          $this->result = array('error'=>true, 'message'=>"Library Directory and Library Name are mandatory.");
          return false;
        }
        
        $path = (is_dir(autoload::getPath('library', $_POST['libraryDirectory'])))?autoload::getPath('library', $_POST['libraryDirectory']):autoload::getPath('library', "");
        if(!is_writable($path))
        {
          $this->result = array('error'=>true, 'message'=>"library directory is not writable. Please make this directory ".$path . " writable.");
          return false;
        }
        
        $response = exec("php ".autoload::getPath('task', 'createLibrary.task.php')." ".$_POST['libraryName']." ".$_POST['libraryDirectory']);
        if($response != "")
        {
          $this->result = array('error'=>true, 'message'=>$response);
          return false;
        }
        
        $this->result = array('success'=>true, 'message'=>"New library \"".$_POST['libraryDirectory']." / ".$_POST['libraryName']."\" has been created");
        $_POST['libraryDirectory'] = "queryLib"; $_POST['libraryName'] = "";
        return true;
      }
    }
  }
}