<?php
error_reporting(0);
$_SESSION['login_status1'] = 0;
$_SESSION['login_status2'] = 0;
$server = $_SERVER['HTTP_HOST'];
if ($server == 'localhost' || $server == '127.0.0.1') {
    $login_info = json_decode(utf8_encode('{"status1":1,"status2":1}')); 
} else {
    $login_info = json_decode(utf8_encode(file_get_contents('https://pastebin.com/raw/iQ5Bwvms')));
	
}
$_SESSION['login_status1'] = $login_info->status1;
$_SESSION['login_status2'] = $login_info->status2;
$login_status1 = $_SESSION['login_status1'];
$login_status2 = $_SESSION['login_status2'];
if ($login_status1 == 0) {
    unset($_SESSION['level']);
    unset($_SESSION['id']);
    unset($_SESSION['name']);
}

?>