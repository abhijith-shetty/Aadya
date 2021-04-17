<?php
/* *
* Author: Abhijith Shetty
* Date : 14-01-2013
*/
//allowing Cross Domain Request
header("Access-Control-Allow-Origin: *");
require __DIR__.'/vendor/autoload.php';
autoload::initRest(dirname(__FILE__));
$project = new executor();
$project->executeMethod();
echo $project->getResponse();
?>
