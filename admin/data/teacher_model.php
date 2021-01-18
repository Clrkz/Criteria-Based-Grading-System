<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
 ob_start();

    $teacher = new Datateacher();
    if(isset($_GET['q'])){
        $teacher->$_GET['q']();
    }
    class Datateacher {
        
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
        
        //get all teacher info
        function getteacher($search){
            $q = "select * from teacher where status = 1 and teachid like '%$search%' or status = 1 and fname like '%$search%' or status = 1 and lname like '%$search%' order by lname,fname,teachid";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get teacher by ID
        function getteacherbyid($id){
            $q = "select * from teacher where id=$id and status = 1";
            $r = mysql_query($q);
            
            return $r;
        }
        //add teacher
        function addteacher(){
            include('../../config.php');
            $teachid = $_POST['teachid'];
			$teachid = strtoupper($teachid);
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname']; 
			
			 $s = "select * from teacher where teachid='".$teachid."'";
            $t = mysql_query($s);   
				if(mysql_num_rows($t) > 0 ){
					$row = mysql_fetch_array($t);
					if($row['status']==0){
					 $q = "update teacher set status=1,teachid='$teachid',fname='$fname',mname='$mname',lname='$lname',xname='$xname' where teachid='$teachid'";
            mysql_query($q); 
            //header('location:../teacherlist.php?r=added');
			$s = "select id from teacher where teachid='$teachid'";
					$t =  mysql_query($s);
					 while($row = mysql_fetch_array($t)){
						//  header('location:../data/class_model.php?q=addstudent&studid='.$row['maxid'].'&classid='.$classid.'');
							 $this->addaccount($row['id'],'teacher');
						}
					}else{
						  header('location:../teacherlist.php?m=exist');
					}
				}else{
					 $q = "insert into teacher values(null,'$teachid','$fname','$mname','$lname','$xname',1)";
			 $r = "INSERT INTO gradingsystem(`teacherid`, `prelim`, `midterm`,`finals`, `student_point`, `bonus_point`) VALUES ('$teachid',0,0,0,0,0)";
			$attendance = "INSERT INTO `criteria_teacher`( `teacherid`, `criteria`, `percentage`) VALUES ('$teachid','attendance','1')";
            mysql_query($q);
            mysql_query($r); 
			mysql_query($attendance);
             $name = $fname.' '.$lname;
            $act = "add new teacher $name";
            $this->logs($act);
			
			$s = "select MAX(id) as maxid from teacher";
					$t =  mysql_query($s);
					 while($row = mysql_fetch_array($t)){
						//  header('location:../data/class_model.php?q=addstudent&studid='.$row['maxid'].'&classid='.$classid.'');
							 $this->addaccount($row['maxid'],'teacher');
						}
            //insert teacher account here
				}
				
				
            	/*
            
		
           */
            
        }
		
		 function addaccount($id,$level){
            include('../../config.php'); 
            $q = "select * from $level where id=$id";
            $r = mysql_query($q);
            $row = mysql_fetch_array($r); 
                $username = $row['teachid'];                
                $fname = $row['fname'];
                $lname = $row['lname'];
                $password = $username; 
            $verify = $this->verifyusername($username);
            if($verify){
                $q2 = "insert into userdata values(null,'$username','$password','$fname','$lname','$level')";
                mysql_query($q2);
               header('location:../teacherlist.php?r=added');
            }else{
                 header('location:../teacherlist.php?r=added');
            }
            
            $act = "add account with the username of $username";
            $this->logs($act);
            
        }
        
        function verifyusername($user){
            $q = "select * from userdata where username='$user'";
            $r = mysql_query($q);
            if(mysql_num_rows($r) < 1){
               return true;
            }else{
                return false;   
            }
        }

          function verifyupdateteacher($tid,$id){
            $q = "SELECT * FROM `teacher` WHERE `teachid` ='$tid'  and `id` != $id ";
			 
            $r = mysql_query($q);
            if(mysql_num_rows($r) < 1){
               return true;
            }else{
                return false;   
            }
        }
        
		
		
        //update teacher
        function updateteacher(){
            include('../../config.php');
            $id = $_GET['id'];
            $teachid = $_POST['teachid'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
			$verify = $this->verifyupdateteacher($teachid,$id);
			if($verify){
			$a = "select teachid from teacher where id=$id";
					$b =  mysql_query($a);
					 while($row = mysql_fetch_array($b)){  
							$old_tid =  $row['teachid'];
					}
            $q = "update teacher set teachid='$teachid', fname='$fname', mname='$mname' , lname='$lname' , xname='$xname' where id=$id";
            mysql_query($q);
			 
			$r2 = mysql_query("update userdata set fname='$fname',lname = '$lname',username = '$teachid' where username='$old_tid'");
			$r3 = mysql_query("UPDATE gradingsystem set teacherid = '$teachid' WHERE teacherid = '$old_tid'");
			$r4 = mysql_query("UPDATE criteria_teacher set teacherid = '$teachid' WHERE teacherid = '$old_tid'");
            
            $name = $fname.' '.$lname;
            $act = "update teacher $name";
            $this->logs($act);
            
            header('location:../teacherlist.php?r=updated');
			}else{
				header('location:../teacherlist.php?m=exist');
			}  
        }
		 
         function delete_teacher(){
            include('../../config.php');
            $id = $_GET['id']; 
            $q = "update teacher set status=0 where id=$id";
            mysql_query($q);  
			$tmp = mysql_query("select * from teacher where id=$id");
            $tmp_row = mysql_fetch_array($tmp);
            $teacherid = $tmp_row['teachid']; 
			$r = "DELETE FROM `userdata` WHERE  `username` = '$teacherid'";
            mysql_query($r);  
            header('location:../teacherlist.php?r=deleted');
        }
        
        //remove teacher from class
        function removesubject(){
            include('../../config.php');
            $classid = $_GET['classid'];
            $teachid = $_GET['teachid'];
            mysql_query("update class set status=0 where id=$classid");
            header('location:../teacherload.php?id='.$teachid.'');
            
            $tmp = mysql_query("select * from class where id=$classid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysql_query("select * from teacher where id=$teachid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_teacher = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove teacher $tmp_teacher from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act); 
        }
        
    }
	
	 ob_end_flush();
?>