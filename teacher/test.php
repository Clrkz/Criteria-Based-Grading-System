<?php  
//include('../config.php'); 
    include('../db.php'); 
    mysql_connect($host,$user,$pass) or die(mysql_error());
    mysql_select_db($db);
$cid =  $_POST['cid']; 
$sid =  $_POST['sid'];
$score  = $_POST['score'];  
if($score == ''){
	$score ='0';
}
$q1 = "select * from `criteria_class` where `criteriaid`='$cid' and `studentid`=$sid ";  
                    $r1 = mysql_query($q1);  
				  if(mysql_num_rows($r1) > 0) {
                    //update
					$q2 = "UPDATE `criteria_class` SET `criteriaid`=$cid,`studentid`=$sid,`score`=$score where criteriaid=$cid  and studentid=$sid ";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }else{
					//add
					$q2 = "INSERT INTO `criteria_class`(`criteriaid`, `studentid`, `score`) VALUES ($cid,$sid,$score)";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }


?>
