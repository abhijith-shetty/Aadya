<?php
/**
 * Author : Abhijth Shetty
 * Date   : 16-12-2010
 * Desc   : This class is responsible for creating an entire requested page
 */ 
 class page
 {
   public static $_LANG;
   
  /**
    * Description: Responsible for identifying the module name and component 
    *              that to be executed and creating the instance of that class.
    */
  public function createPage()
  {
    $this->initializeRequestVariables();
    $this->className  = $this->pageName.'Component';
   
    return $this;
  }
   
  /**
  * Description: Responsible for calling the execute function in main component,
  *              generates html from  its template
  */
   public function renderMainAction()
   {
     if(is_file(autoload::getpath('baseModules', $this->moduleName.'/'.$this->pageName.'Component.php'))) {
       if(!getConfig('enable_test_console')) {header("HTTP/1.0 401 Unauthorized");die("Page 832 - Access Denied. You are not authorized to view this page!");}
       autoload::loadFile('baseModules', $this->moduleName.'/'.$this->pageName.'Component.php');
	   } else {
       autoload::loadFile('modules', $this->moduleName.'/'.$this->pageName.'Component.php');
     }
     
     $pageInstance = new $this->className();
     $this->checkSecuredOrNot($pageInstance->isSecured);
     $pageInstance->execute();
     $this->layoutName = $pageInstance->getLayout();

     ob_start();
     ob_implicit_flush(0);
     extract(get_object_vars($pageInstance));
     if(is_file(autoload::getpath('baseModules', $this->moduleName.'/'.$this->pageName.'Component.php'))) {
       require(autoload::getpath('baseModules', $this->moduleName.'/'.$this->pageName.'Tpl.php'));
     } else {
       require(autoload::getpath('modules', $this->moduleName.'/'.$this->pageName.'Tpl.php'));
     }
    
     return ob_get_clean();
   }
   
  /**
  * Description: Responsible for generating the layout contents and 
  *              integrating the contents of component with the main layout.
  */
  public function renderPage($aadya_contents)
  {
    if($this->layoutName!="") 
    {  
      ob_start();
      ob_implicit_flush(0);
      require(autoload::getpath('layout', $this->layoutName.'.php'));
      return ob_get_clean();
    }
   
    return $aadya_contents;
  }
   
  /**
  * Description: Responsible for generating the contents from sub component
  *              or the included components.
  */   
  static public function renderComponent($moduleName, $actionName, $params=array())
  {
    if(is_file(autoload::getpath('baseModules', $moduleName.'/'.$actionName.'Component.php'))) {
      autoload::loadFile('baseModules', $moduleName.'/'.$actionName.'Component.php');
	  } else {
      autoload::loadFile('modules', $moduleName.'/'.$actionName.'Component.php');
    }
    
    $className = $actionName.'Component';
    $block = new $className();
    $block->setMemberVariables($params);
    $block->execute();

    ob_start();
    ob_implicit_flush(0);
    extract(get_object_vars($block));
    if(is_file(autoload::getpath('baseModules', $moduleName.'/'.$actionName.'Component.php'))) {
      require(autoload::getpath('baseModules', $moduleName.'/'.$actionName.'Tpl.php'));
    } else {
      require(autoload::getpath('modules', $moduleName.'/'.$actionName.'Tpl.php'));
    }
    return ob_get_clean();
  }
   
  /**
  * Description: Responsible for generating the contents from sub component
  *              or the included components.
  */   
  static public function renderTemplate($moduleName, $templateName, $params=array())
  {
    ob_start();
    ob_implicit_flush(0);
    extract($params);
    if(is_file(autoload::getpath('baseModules', $moduleName.'/'.$templateName.'Tpl.php'))) {
      require(autoload::getpath('baseModules', $moduleName.'/'.$templateName.'Tpl.php'));
    } else {
      require(autoload::getpath('modules', $moduleName.'/'.$templateName.'Tpl.php'));
    }
    return ob_get_clean();
  }
   
  /**
  * Description: Resposible for verifying the requested component is secured or not,
  *              if secured then allow the request else redirect to home page .
  */   
  public function checkSecuredOrNot($val, $options=array())
  {
   
    $redirectTo = isset($options['redirectTo'])?$options['redirectTo']:getConfig('home_page');

    if($val===false){
      return true;
    }

    if($val===true && isLoggedInUser())
    {
      return true;
    }

    if($val!="" && in_array($_SESSION['user_role'], explode(",", $val)))
    {
      return true;
    }

    header("Location: $redirectTo");
    exit;	
  }
   
  /**
   * Description: This fucntion decodes module name and component name from pretty URL,
   *              also decodes request variabled from pretty URL and assigns it to $_GET
   *              like it was a normal GET request.
   */
  public function initializeRequestVariables()
  {
    //currently we do not support pretty URL 
	
    $moduleName = (isset($_GET['module']) && $_GET['module']!="")?$_GET['module']:getConfig('default_module');
    $compName = $moduleName.ucwords((isset($_GET['component']) && $_GET['component']!="")?$_GET['component']:getConfig('default_component'));
	
    $this->moduleName = (is_dir(autoload::getpath('baseModules',$moduleName)) || is_dir(autoload::getpath('modules',$moduleName)))?$moduleName:getConfig('default_module');
    $this->pageName = (is_file(autoload::getpath('baseModules',$this->moduleName.'/'.$compName.'Component.php')) || is_file(autoload::getpath('modules',$this->moduleName.'/'.$compName.'Component.php')))?$compName:$this->moduleName."Index";
		 
    if(!isLoggedInUser() && isset($_COOKIE['rememberMe'])){  
      $this->setUserFromRememberMe($_COOKIE['rememberMe']);
    }	
	
    return true;
  }
  
  public function setUserFromRememberMe($rememberCookie)
  {
    if($rememberCookie!='')
    {
      $rememberCookieValue = explode("##$$##", base64_decode($rememberCookie));
      if(isset($rememberCookieValue[0]) && isset($rememberCookieValue[1])) 
      {	  
        $userId = autoload::loadLibrary('queryLib','user')->checkCredential($rememberCookieValue[0], $rememberCookieValue[1]);
        if($userId > 0) {
          autoload::loadLibrary('utilityLib', 'userUtility')->setCredential($userId);
        }
      }
    }	
  }
 }