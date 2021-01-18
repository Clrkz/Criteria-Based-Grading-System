<?php 
$serverhost = $_SERVER['HTTP_HOST']; //check if localhost or hosted
if($serverhost == 'localhost' || $serverhost == '127.0.0.1'){
		//DATABASE INFORMATION [LOCALHOST]
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'grading';
	}else{
		//DATABASE INFORMATION [HOSTED]
		$host = 'localhost'; 
		$user = 'id14541207_root'; 
		$pass = 'hPYKwwKc|AS(-1TX'; 
		$db = 'id14541207_grading'; 
	} 
?>