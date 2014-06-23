<?php
/**
 * Author : Abhijth Shetty
 * Date   : 07-01-2011
 * Desc   : This class is responsible for handling error logs
 */ 

class log
{
	/**
	 * 
	 * This fucntion writes a log entry into given file
	 * @param mixed $contents
	 * @param string $filename
	 * @example 
	 * 		log::file('msg to record', 'myfile');
	 * 		log::file('msg to default file');
	 */
	static public function file($contents, $filename='default')
	{
		$logFileName = autoload::getPath('log',$filename.'.log'); 
		if(!error_log(print_r($contents, true)."\n", 3, $logFileName))
		{
			die('Log file '.$logFileName.' failed to record the changes');
		}
				
		return true;
	}
	
	/**
	 * 
	 * This function displays the contents into browser in formatted way
	 * @param mixed $contents
	 * @example
	 * 		log::show('msg to show');
	 */
	static public function show($contents)
	{
		echo "<pre>";
		print_r($contents);
		echo "</pre>";
		
		return true;
	}
	
	/**
	 * 
	 * This function displays the contents into browser and
	 * terminated the thread.
	 * @param mixed $contents
	 * @example
	 * 		log::showd('msg to show');
	 */
	static public function showd($contents)
	{
		echo "<pre>";
		print_r($contents);
		echo "</pre>";
		
		exit(0);
	}
}