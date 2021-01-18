<?php

    $section = new Datasection();
    if(isset($_GET['q'])){
        $section->$_GET['q']();
    }
    class Datasection {
        
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
        
        //get all section info
        function getsection($search){
            $q = "select * from section where status=1 and name like '%$search%'  order by name";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get section by ID
        function getsectionbyid($id){
            $q = "select * from section where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add section
        function addsection(){
            include('../../config.php'); 
            $name = $_POST['name'];
            
            $q = "insert into section values(null,'$name',1)";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "add new section $name";
            $this->logs($act);
            
            header('location:../sectionlist.php?r=added');
        }
        
        //update section
        function updatesection(){
            include('../../config.php');
            $id = $_GET['id'];
            $name = $_POST['name']; 
            $q = "update section set name='$name' where id=$id";
            mysql_query($q);
            
            $name = $fname.' '.$lname;
            $act = "update section $name";
            $this->logs($act);
            
            header('location:../sectionlist.php?r=updated');
        }
        
		  //update section
        function deletesection(){
            include('../../config.php');
            $id = $_GET['id']; 
            $q = "update section set status=0 where id=$id";
            mysql_query($q);
             
            
            header('location:../sectionlist.php?r=deleted');
        }
        
        
        
    }
?>