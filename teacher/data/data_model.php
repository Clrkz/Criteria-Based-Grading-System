<?php
    $data = new Data();
    if(isset($_GET['q'])){
        $data->$_GET['q']();
    }
    class Data {
        
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
        
        //get all subjects
        function getsubject($search,$id){
            $q = "select * from subject where  status=1 and teacherid=$id and code like '%$search%' or status=1 and teacherid=$id and title like '%$search%' order by code asc";
            $r = mysql_query($q);
            
            return $r;
        }
        //get subject by ID
        function getsubjectbyid($id){
            $q = "select * from subject where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add subject
        function addsubject(){
            include('../../config.php');
            $code = $_POST['code'];
            $title = $_POST['title'];
            $unit = $_POST['unit'];  
            $teacherid = $_GET['teacherid']; 
            $q = "insert into subject values(null,'$code','$title','$unit','$teacherid',1)";
            mysql_query($q);
            
           
            header('location:../subjectlist.php?r=added');
        }
        
        //update subject
        function updatesubject(){
            include('../../config.php');
            $id = $_GET['id'];
            $code = $_POST['code'];
            $title = $_POST['title'];
            $unit = $_POST['unit']; 
            $q = "update subject set code='$code', title='$title',unit=$unit where id=$id";
            mysql_query($q);
            
            $act = "update subject $code - $title";
            $this->logs($act);
            header('location:../subjectlist.php?r=updated');
        }
		
		   function deletesubject(){
            include('../../config.php');
            $id = $_GET['id']; 
            $q = "update subject set status=0 where id=$id";
            mysql_query($q);
        
            header('location:../subjectlist.php?r=deleted');
        }
        
		
		 function deleteGlobal(){
            include('../../config.php');
            $table = $_GET['table'];
            $id = $_GET['id']; 
			if($table=='class'){ 
            $q = "update $table set status=0 where id=$id";
			}else{
            $q = "delete from $table where id=$id";
			}
            $r = null;
           
            $tmp = mysql_query("select * from $table where id=$id");
            $tmp_row = mysql_fetch_array($tmp);
			
            
            mysql_query($q);
            
            if($table=='subject'){
                $record = $tmp_row['code'];
                header('location:../subjectlist.php?r=deleted');
                
            }else if($table=='class'){
                 $record = $tmp_row['subject'];
                header('location:../subject.php?r=deleted');
               
            }else if($table=='student'){
                $record = $tmp_row['fname'];
                header('location:../studentlist.php?r=deleted');
               
            }else if($table=='course'){
               $record = $tmp_row['fname'];
                header('location:../courselist.php?r=deleted');
            }else if($table=='section'){
               $record = $tmp_row['fname'];
                header('location:../sectionlist.php?r=deleted');
            }else if($table=='teacher'){
               $record = $tmp_row['fname'];
               $tid = $tmp_row['teachid'];
			   $r= "delete from  gradingsystem where teacherid=$tid";
			   mysql_query($r);
			   
			    
                header('location:../teacherlist.php?r=deleted');
            }else if($table=='userdata'){
                $record = $tmp_row['username'];
                header('location:../users.php?r=deleted');
            }else if($table=='quiz'){ 
			$classid = $_GET['classid'];
                header('location:../quiz.php?classid='.$classid.'');
            }else if($table=='exam'){ 
			$classid = $_GET['classid'];
                header('location:../exam.php?classid='.$classid.'');
            }
                    
            $act = "delete $record from $table";
            $this->logs($act);
        }
		
        //GLOBAL DELETION
        function delete(){
            include('../../config.php');
			$classid = $_GET['classid'];
            $table = $_GET['table'];
            $id = $_GET['id'];
            $q = "delete from $table where studid=$id and classid=$classid";
            $r = null;
            
            $tmp = mysql_query("select * from $table where id=$id");
            $tmp_row = mysql_fetch_array($tmp);
            
            mysql_query($q);
            
            if($table=='subject'){
                $record = $tmp_row['code'];
                header('location:../subject.php?r=deleted');
                
            }else if($table=='class'){
                 $record = $tmp_row['subject'];
                header('location:../class.php?r=deleted');
               
            }else if($table=='student'){
                $record = $tmp_row['fname'];
                header('location:../studentlist.php?r=deleted');
               
            }else if($table=='course'){
               $record = $tmp_row['fname'];
                header('location:../courselist.php?r=deleted');
            }else if($table=='section'){
               $record = $tmp_row['fname'];
                header('location:../sectionlist.php?r=deleted');
            }else if($table=='teacher'){
               $record = $tmp_row['fname'];
               $tid = $tmp_row['teachid'];
			   $r= "delete from  gradingsystem where teacherid=$tid";
			   mysql_query($r);
			   
			    
                header('location:../teacherlist.php?r=deleted');
            }else if($table=='userdata'){
                $record = $tmp_row['username'];
                header('location:../users.php?r=deleted');
            }else if($table=='studentsubject'){
				header('location:../student.php?classid='.$classid.'');
			}
                    
           
        }

    }
?>