<?php

    $exam = new Dataexam();
    if(isset($_GET['q'])){
        $exam->$_GET['q']();
    }
    class Dataexam {
        
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
        
        //get all exam info
        function getexam($search){
            $q = "select * from exam where name like '%$search%'  order by name";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get exam by ID
        function getexambyid($id){
            $q = "select * from exam where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add exam
        function addexam(){
            include('../../config.php'); 
            $name = $_POST['name'];
            
            $q = "insert into exam values(null,'$name')";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "add new exam $name";
            $this->logs($act);
            
            header('location:../examlist.php?r=added');
        }
        
        //update exam
        function updateexam(){
            include('../../config.php');
            $id = $_GET['id']; 
            $classid = $_GET['classid'];
            $name = $_POST['name'];
            $total = $_POST['total']; 
            $q = "update exam set name='$name', total=$total where id=$id";
            mysql_query($q);
			
            header('location:../exam.php?classid='.$classid.'');
        }
        
        
        
    }
?>