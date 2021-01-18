<?php
error_reporting(0);
    include('../../config.php'); 
    $student = new Datastudent();
	
    if(isset($_GET['q'])){
        $function = $_GET['q'];
        $student->$function();
		  if($function == 'criteria'){
        $student->criteria();   
    }else if($function == 'compute'){
        $student->compute();   
    }else if($function == 'gradecompute'){
        $student->gradecompute();   
    }
    }
    
    class Datastudent {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }
        
       
        function getsubjectbyid($id){
            $q = "select * from gradingsystem where teacherid='$id'";
            $r = mysql_query($q);
            
            return $r;
        }
		
		 function gradecompute(){
			  $tid = $_GET['tid'];
            $student = $_POST['student'];
            $bonus = $_POST['bonus']; 
            
            $q = "update gradingsystem set student_point=$student,bonus_point=$bonus where teacherid='$tid'";
		    mysql_query($q); 
                        
            header('location:../gradingsystem.php');
        }
		
	 
		  function criteria(){
			  $tid = $_GET['tid'];
            $att = $_POST['att'];
            $quiz = $_POST['quiz'];
            $project = $_POST['project'];
            $exam = $_POST['exam'];            
            $act = $_POST['act'];            
            $hoe = $_POST['hoe'];            
            $ass = $_POST['ass'];         
            $q = "update gradingsystem set act=$act,hoe=$hoe,ass=$ass,att=$att,quiz=$quiz, project=$project,exam=$exam where teacherid='$tid'";
			 mysql_query($q); 
                        
            header('location:../gradingsystem.php');
        }
         function compute(){
			  $tid = $_GET['tid'];
            $prelim = $_POST['prelim'];
            $midterm = $_POST['midterm'];
            $finals = $_POST['finals'];
            
            $q = "update gradingsystem set prelim=$prelim,midterm=$midterm,finals=$finals where teacherid='$tid'";
		    mysql_query($q); 
                        
            header('location:../gradingsystem.php');
        }
        
        
    }
?>







