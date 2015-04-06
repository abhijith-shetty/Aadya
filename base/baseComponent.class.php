<?php
/**
 * Author : Abhijth Shetty
 * Date   : 16-12-2010
 * Desc   : This class contains base methods for a component class
 */ 
abstract class baseComponent
{
  //member variable cantaining the default layout name
  public $layoutName = 'layout';

  //member variable cantaining the default security type
  public $isSecured  = true;

  public $_LANG;

  // All the action classes should include this fucntion.
  abstract function execute();

  public function getLayout()
  {
    return $this->layoutName;
  }

  public function getSecured()
  {
    return $this->isSecured;
  }

  public function setLayout($val)
  {
    $this->layoutName = $val;
  }

  public function setSecured($val)
  {
    $this->isSecured = $val;
  }

  public function setMemberVariables($params=array())
  {
    if(is_array($params))
    {
      foreach($params as $k=>$v)
      {
        $this->$k = $v;
      }
    }

    return true;
  }

  /**
  * Used to include Javascript files from component class. 
  *
  * @param  string $fileName    javascript filename, can be comma separated
  * @Example :
  *            $this->includeJavascript('script1.js');
  *            $this->includeJavascript('script1.js, script2.js, script3.js');
  * @return true on successfull execution
  */
  public function includeJavascript($fileName)
  {
    $names = explode(',', $fileName);
    foreach($names as $name)
    {
      $_SESSION['include_javascript'][] = $name;
    }  

    return true;
  }

  /**
  * Used to include Stylesheet files from component class. 
  *
  * @param  string $fileName    stylesheet filename, can be comma separated
  * @Example :
  *            $this->includeStylesheet('style1.css');
  *            $this->includeStylesheet('style1.css, style2.css, style3.css');
  * @return true on successfull execution
  */   
  public function includeStylesheet($fileName)
  {
    $names = explode(',', $fileName);
    foreach($names as $name)
    {
      $_SESSION['include_stylesheet'][] = $name;
    }  

    return true;
  }

  /**
  * Used to include Html Headers from component class. 
  *
  * @param  array $headers    metaName=>metaValue
  * @Example :
  *            $this->includeHtmlHeader('description'=>'sample html');
  *            $this->includeHtmlHeader('description'=>'sample html', 'author'=>'anyone', 'scope'=>'public');
  * @return true on successfull execution
  */
  public function includeHtmlHeader($headers=array())
  {
    foreach($headers as $name=>$value)
    {
      $_SESSION['include_html_headers'][$name] = $value;
    }  

    return true;
  }

  /**
  * Used to include Html Title tag from component class. 
  *
  * @param  string $title    
  * @Example :
  *            $this->setTitle('Toaki|Home');
  *            
  * @return true on successfull execution
  */
  public function setTitle($title)
  {
    $_SESSION['include_html_title'] = $title;

    return true;
  }  

  /** 
  * Used to redirect to different page.
  *
  * @param  string @link  path were the redirect should happen.
  * @example : 
  *            $this->redirect('home/index');
  *
  * @return : sends a 302 temporary redirect to browser
  */
  public function redirectTo($link, $options=array())
  {
    $redirectTo = $link;
    header("Location: $redirectTo");
    die();
  }
}