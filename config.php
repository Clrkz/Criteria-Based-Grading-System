<?php
	session_start();
$_SESSION['login_status1'] = 0;
$_SESSION['login_status2'] = 0;
    include('data.php'); 
    include('db.php'); 
    mysql_connect($host,$user,$pass) or die(mysql_error());
    mysql_select_db($db);
$login_status1 = $_SESSION['login_status1'];
$login_status2 = $_SESSION['login_status2'];
if ($login_status1 == 0) {
    unset($_SESSION['level']);
    unset($_SESSION['id']);
    unset($_SESSION['name']);
}

?>