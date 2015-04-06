<?php
/**
 * Author : Abhijth Shetty
 * Date   : 21-03-2015
 * Desc   : This is a controller file for adminHeader Component 
 */
class adminHeaderComponent extends baseComponent
{
  public function execute()
  {
    $this->page = (isset($_GET['component']))?$_GET['component']:'index';
  }
}