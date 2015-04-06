<?php
  /*************************************************************************
   * Author: Abhijith Shetty
   * Description: Including autoloader class and initiating core functions.
   */ 	 
     require_once(dirname(__FILE__).'/base/autoload.class.php');
     autoload::init(dirname(__FILE__));
	   $aadya = new page();
     echo $aadya->renderPage($aadya->createPage()->renderMainAction());
     database::close();
  /*************************************************************************/
?>