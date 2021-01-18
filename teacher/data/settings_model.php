<?php
    $settings = new Datasettings();
    if(isset($_GET['q'])){
        $settings->$_GET['q']();
    }

    class Datasettings {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }
        
        //create logs
        function logs($act){            
            $date = date('m-d-Y h:i:s A');
             $q = "INSERT INTO log(date, activity) VALUES ('$date','$act')";   
            mysql_query($q);
            return true;
        }
		
		
        
        function changepassword(){
            include('../../config.php');
            $username = $_GET['username'];
            $current = ($_POST['current']);
            $new = ($_POST['new']);
            $confirm = ($_POST['confirm']);
            $q = "select * from userdata where username='$username' and password='$current'";
            $r = mysql_query($q);
            if(mysql_num_rows($r) > 0){
                if($new == $confirm){
                    $act = $username.' changed his/her password.';
                    $this->logs($act);
                    $r2 = mysql_query("update userdata set password='$new' where username='$username' and password='$current'");
                    header('location:../settings.php?msg=success&username='.$username.'');   
                }else{
                    header('location:../settings.php?msg=error&username='.$username.'');   
                }
            }else{
                header('location:../settings.php?msg=error&username='.$username.'');   
            }   
        }
		
		 
        function changepassword1(){
            include('../../config.php');
            $username = $_GET['username'];
            //$current = ($_POST['current']);
            $new = ($_POST['new']);
            $confirm = ($_POST['confirm']); 
                if($new == $confirm){
                    $act = $username.' changed his/her password.';
                    $this->logs($act);
                    $r2 = mysql_query("update userdata set password='$new' where username='$username'");
                    header('location:../index.php');   
                }else{
                    header('location:../changepass.php?msg=error&username='.$username.'');   
                }
             
        }
                
    }
?>