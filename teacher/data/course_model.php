<?php

    $course = new Datacourse();
    if(isset($_GET['q'])){
        $course->$_GET['q']();
    }
    class Datacourse {
        
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
        
        //get all course info
        function getcourse($search){
            $q = "select * from course where name like '%$search%'  order by name";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get course by ID
        function getcoursebyid($id){
            $q = "select * from course where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add course
        function addcourse(){
            include('../../config.php'); 
            $name = $_POST['name'];
            
            $q = "insert into course values(null,'$name')";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "add new course $name";
            $this->logs($act);
            
            header('location:../courselist.php?r=added');
        }
        
        //update course
        function updatecourse(){
            include('../../config.php');
            $id = $_GET['id'];
            $name = $_POST['name']; 
            $q = "update course set name='$name' where id=$id";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "update course $name";
            $this->logs($act);
            
            header('location:../courselist.php?r=updated');
        }
        
        
        
    }
?>