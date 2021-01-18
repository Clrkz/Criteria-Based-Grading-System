<?php

    $quiz = new Dataquiz();
    if(isset($_GET['q'])){
        $quiz->$_GET['q']();
    }
    class Dataquiz {
        
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
        
        //get all quiz info
        function getquiz($search){
            $q = "select * from quiz where name like '%$search%'  order by name";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get quiz by ID
        function getquizbyid($id){
            $q = "select * from quiz where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add quiz
        function addquiz(){
            include('../../config.php'); 
            $name = $_POST['name'];
            
            $q = "insert into quiz values(null,'$name')";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "add new quiz $name";
            $this->logs($act);
            
            header('location:../quizlist.php?r=added');
        }
        
        //update quiz
        function updatequiz(){
            include('../../config.php');
            $id = $_GET['id']; 
            $classid = $_GET['classid'];
            $name = $_POST['name'];
            $total = $_POST['total']; 
            $q = "update quiz set name='$name', total=$total where id=$id";
            mysql_query($q);
			
            header('location:../quiz.php?classid='.$classid.'');
        }
        
        
        
    }
?>