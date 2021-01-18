<?php

    $student = new Datastudent();
    if(isset($_GET['q'])){
        $student->$_GET['q']();
    }
    class Datastudent {
        
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
		//add student
        function addstudent1(){
            include('../../config.php'); 
            $studid = $_POST['studid'];
			$fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
            $classid = $_GET['classid'];
            $tid = $_GET['id'];
			
			 $s = "select * from student where studid='".$studid."'";
            $t = mysql_query($s);   
				if(mysql_num_rows($t) > 0 ){
					$q2 = "select id from student where studid='$studid'";  
					 
					$r2 = mysql_query($q2);
						while($row2 = mysql_fetch_array($r2)){
					    header('location:../data/class_model.php?q=addstudent1&studid='.$row2['id'].'&classid='.$classid.'&id='.$tid.'');
						 } 
				
				}else{
					//echo "add";
					$q = "insert into student values(null,'$studid','$fname','$mname','$lname','$xname')";
					mysql_query($q);  
					$s = "select MAX(id) as maxid from student";
					$t =  mysql_query($s);
					 while($row = mysql_fetch_array($t)){
						  header('location:../data/class_model.php?q=addstudent1&studid='.$row['maxid'].'&classid='.$classid.'&id='.$tid.'');
							
						}
				} 
        }
        
        //get all student info
        function getstudent($search){
            $q = "select * from student where studid like '%$search%' or fname like '%$search%' or lname like '%$search%' order by lname,fname,studid";
            $r = mysql_query($q);
            
            return $r;
        }
		
        
        //get class by ID
        function getstudentbyid($id){
            $q = "select * from student where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add student
        function addstudent(){
            include('../../config.php');
            $studid = $_POST['studid'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
			
			 
			
			 $s = "select * from student where studid='".$studid."'";
            $t = mysql_query($s);   
				if(mysql_num_rows($t) > 0 ){ 
            header('location:../studentlist.php?m=exist');
				}else{
			$q = "insert into student values(null,'$studid','$fname','$mname','$lname','$xname')";
            mysql_query($q);  
            $name = $fname.' '.$lname;
            $act = "add new student $name";
            $this->logs($act);
            header('location:../studentlist.php?r=added');
				}
			
			
            
          
            
        }
        
        //update student
        function updatestudent(){
            include('../../config.php');
            $id = $_GET['id'];
            $studid = $_POST['studid'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
            $q = "update student set studid='$studid', fname='$fname', mname='$mname', lname='$lname', xname='$xname' where id=$id";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "update student $name";
            $this->logs($act);
            
            header('location:../studentlist.php?r=updated');
        }
        //remove from class
        function removesubject(){
            include('../../config.php');
            $studid = $_GET['studid'];
            $classid = $_GET['classid'];
            mysql_query("delete from studentsubject where studid=$studid and classid=$classid");
            
            $tmp = mysql_query("select * from class where id=$classid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysql_query("select * from student where id=$studid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove student $tmp_student from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../studentsubject.php?id='.$studid.'');
        }
    }
?>