<?php
    include('../../config.php');
    $studid = $_GET['studid'];
    $classid = $_GET['classid'];
    $term = $_GET['term'];
    
    $grade = new Datagrade();
	
    if($term == 1){
        $grade->prelim($studid,$classid);   
    }else if($term == 2){
        $grade->midterm($studid,$classid);   
    }else if($term == 3){
        $grade->finalterm($studid,$classid);   
    }
    class Datagrade {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }
        
        function logs($act){            
            $date = date('m-d-Y h:i:s A');
             $q = "INSERT INTO log(date, activity) VALUES ('$date','$act')";   
            mysql_query($q);
            return true;
        }
        
        function prelim($studid,$classid){
            $att = $_POST['att1'];
            $quiz = $_POST['quiz1'];
            $project = $_POST['project1'];
            $exam = $_POST['exam1'];            
            $act = $_POST['act1'];            
            $hoe = $_POST['hoe1'];            
            $ass = $_POST['ass1'];         
            $q = "update studentsubject set act1=$act,hoe1=$hoe,ass1=$ass,att1=$att, quiz1=$quiz, project1=$project, exam1=$exam where studid=$studid and classid=$classid";
            mysql_query($q);
            $term = 'prelim';
            $this->createlog($studid,$classid,$term);
                        
            header('location:../calculate.php?studid='.$studid.'&classid='.$classid.'&status=1');
        }
        
        function midterm($studid,$classid){
            $att = $_POST['att2'];
            $quiz = $_POST['quiz2'];
            $project = $_POST['project2'];
            $exam = $_POST['exam2'];             
            $act = $_POST['act2'];            
            $hoe = $_POST['hoe2'];            
            $ass = $_POST['ass2'];             
            $q = "update studentsubject set act2=$act,hoe2=$hoe,ass2=$ass,att2=$att, quiz2=$quiz, project2=$project, exam2=$exam where studid=$studid and classid=$classid";
            mysql_query($q);
            $term = 'midterm';
            $this->createlog($studid,$classid,$term);
            header('location:../calculate.php?studid='.$studid.'&classid='.$classid.'&status=1');
        }
        
        function finalterm($studid,$classid){
            $att = $_POST['att3'];
            $quiz = $_POST['quiz3'];
            $project = $_POST['project3'];
            $exam = $_POST['exam3'];           
            $act = $_POST['act3'];            
            $hoe = $_POST['hoe3'];            
            $ass = $_POST['ass3'];               
            $q = "update studentsubject set act3=$act,hoe3=$hoe,ass3=$ass,att3=$att, quiz3=$quiz, project3=$project, exam3=$exam where studid=$studid and classid=$classid";
            mysql_query($q);
            $term = 'final';
            $this->createlog($studid,$classid,$term);
            header('location:../calculate.php?studid='.$studid.'&classid='.$classid.'&status=1');
        }
        
        function createlog($studid,$classid,$term){
            $student = mysql_query("select * from student where id=$studid");
            $student = mysql_fetch_array($student);
            $student = $student['fname'].' '.$student['lname'];
            
            $subject = mysql_query("select * from class where id=$classid");
            $subject = mysql_fetch_array($subject);
            $subject = $subject['subject'];
            
            $act = $_SESSION['id'].' calculated the grades of '.$student.' in '.$subject.' in '.$term.'';
            $this->logs($act);
            return true;
        }
    }
?>