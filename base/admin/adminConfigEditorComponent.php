<?php
/**
 * Author : Abhijth Shetty
 * Date   : 31-03-2015
 * Desc   : This is a controller file for adminConfigEditor Component 
 */
class adminConfigEditorComponent extends baseComponent
{
  public function execute()
  {
    $path = autoload::getPath('config', 'settings.php');
    include($path);
    $this->data = $setting;
    
    if(!is_writable($path))
    {
      $this->result = array('error'=>true, 'message'=>"Config file is not writable. Please make this file ".$path . " writable.");
    }
    
    if(isPOST() && $_GET['action'] == "configEditor")
    {
      if(!is_writable($path))
      {
        $this->result = array('error'=>true, 'message'=>"Config file is not writable. Please make this file ".$path . " writable.");
        return false;
      }
      
      $content = "<?php \r\n";
      foreach($_POST as $key => $value)
      {
        $content .= '$setting["'.$key.'"] = "'.$value.'";'."\r\n";
      }
      $content .= "?>";
      file_put_contents($path, $content);
      
      $this->redirectTo(getComponentUrl('admin', 'developer', array('action'=>'configEditor')));
    }    
  }
}