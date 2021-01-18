<?php
    $student = new Datastudent();
    if(isset($_GET['q'])){
        $function = $_GET['q'];
        $student->$function();
    }
    
    class Datastudent {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
               header('location:../../');   
            }
        }
		
		//add student
        function addstudent(){
            include('../../config.php'); 
            $studid = $_POST['studid'];
			$fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
            $classid = $_GET['classid'];
			
			 $s = "select * from student where studid='".$studid."'";
            $t = mysql_query($s);   
				if(mysql_num_rows($t) > 0 ){
					$q2 = "select id from student where studid='$studid'";  
					 
					$r2 = mysql_query($q2);
						while($row2 = mysql_fetch_array($r2)){
					    header('location:../data/class_model.php?q=addstudent&studid='.$row2['id'].'&classid='.$classid.'');
						 } 
				
				}else{
					//echo "add";
					$q = "insert into student values(null,'$studid','$fname','$mname','$lname','$xname')";
					mysql_query($q);  
					$s = "select MAX(id) as maxid from student";
					$t =  mysql_query($s);
					 while($row = mysql_fetch_array($t)){
						  header('location:../data/class_model.php?q=addstudent&studid='.$row['maxid'].'&classid='.$classid.'');
							
						}
				} 
        }
		//add criteria
        function addcriteria(){
            include('../../config.php'); 
            $name = $_POST['name'];
			$total = $_POST['total']; 
            $criteria = $_GET['criteria']; 
            $classid = $_GET['classid']; 
					$q = "insert into criteria values(null,'$classid','$criteria','$name','$total')";
					mysql_query($q);   
					header('location:../'.$criteria.'.php?classid='.$classid.''); 
        }
		
		
	 
		 function addexam(){
            include('../../config.php'); 
            $name = $_POST['name'];
			$total = $_POST['total']; 
            $classid = $_GET['classid']; 
					$q = "insert into exam values(null,'$classid','$name','$total')";
					mysql_query($q);   
					header('location:../exam.php?classid='.$classid.''); 
        }
		function updatequiz(){ 
		 include('../../config.php'); 
					$stdid = $_GET['studentid'];
					$cname = $_GET['criterianame'];
					$cid = $_GET['criteriaid'];
					$score = $_POST['score'];
					$classid = $_GET['classid'];
					$q1 = 'select * from quiz_class where quizid='.$cid.' and studentid='.$stdid.'';   
                    $r1 = mysql_query($q1);
					  
				  if(mysql_num_rows($r1) > 0) {
                    //update
					$q2 = "UPDATE `quiz_class` SET `quizid`=$cid,`studentid`=$stdid,`score`=$score where quizid=$cid  and studentid=$stdid ";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }else{
					//add
					$q2 = "INSERT INTO `quiz_class`(`quizid`, `studentid`, `score`) VALUES ($cid,$stdid,$score)";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }  
					header('location:../quizclass.php?id='.$cid.'&classid='.$classid.'&quizname='.$cname.''); 
				 
					
        }
		
	 
        
		 function getquizbyclass($classid){   
           $q = "select * from quiz where classid=$classid order by id desc";   
            $r = mysql_query($q);
            return $r;  
        }
		
		
		 function getexambyclass($classid){   
           $q = "select * from exam where classid=$classid order by id desc";   
            $r = mysql_query($q);
            return $r;  
        }
		
        function getstudentbyclass($classid){
            $q = "select * from studentsubject where classid=$classid";
            $r = mysql_query($q);
            $student = array();
            if($classid != null){
               while($row = mysql_fetch_array($r)){
                    $q2 = 'select * from student where id='.$row['studid'].'';  
                    $r2 = mysql_query($q2);
                    $student[] = mysql_fetch_array($r2);    
                } 
            }
			sort($student);
            return $student;
        }
        
		  function getstudentbyquizclass($classid,$criteria_id){
            $q = "select * from studentsubject where classid=$classid";
            $r = mysql_query($q);
            $student = array();
            if($classid != null){
               while($row = mysql_fetch_array($r)){
				    $q1 = 'select s.*,qc.quizid,qc.score from student s
inner join quiz_class qc
on s.id=qc.studentid 
where qc.studentid='.$row['studid'].' AND qc.quizid='.$criteria_id.'';  
                    $r1 = mysql_query($q1); 
				   if(mysql_num_rows($r1) > 0 ){ 
                    $student[] = mysql_fetch_array($r1); 
				   }else{
					$q2 = 'select *,0 as `score` from student where id='.$row['studid'].'';  
                    $r2 = mysql_query($q2);
                    $student[] = mysql_fetch_array($r2); 
				   }
                } 
            }
            return $student;
        }
		
		  function getstudentbyexamclass($classid,$criteria_id){
            $q = "select * from studentsubject where classid=$classid";
            $r = mysql_query($q);
            $student = array();
            if($classid != null){
               while($row = mysql_fetch_array($r)){
				    $q1 = 'select s.*,qc.quizid,qc.score from student s
inner join exam_class qc
on s.id=qc.studentid 
where qc.studentid='.$row['studid'].' AND qc.quizid='.$criteria_id.'';  
                    $r1 = mysql_query($q1); 
				   if(mysql_num_rows($r1) > 0 ){ 
                    $student[] = mysql_fetch_array($r1); 
				   }else{
					$q2 = 'select *,0 as `score` from student where id='.$row['studid'].'';  
                    $r2 = mysql_query($q2);
                    $student[] = mysql_fetch_array($r2); 
				   }
                } 
            }
            return $student;
        }
        
        function getstudentbysearch($classid,$search){
            $q = "select * from student where fname like '%$search%' or lname like '%$search%' or studid like '%$search%'";
            $r = mysql_query($q);
            $student = array();
            while($row = mysql_fetch_array($r)){
                $q2 = 'select * from studentsubject where studid='.$row['id'].' and classid='.$classid.'';  
                $r2 = mysql_query($q2);
                if(mysql_num_rows($r2) > 0) {
                    $student[] = $row;
                }

            }
            return $student;        
        }
		
		function getCriteriaTotal($classid,$term,$criteria){
			$query_total = "SELECT sum(total) as `total` FROM `criteria` WHERE `classid` = $classid and term = '$term' and criteria = '$criteria'";
            $query_total_x = mysql_query($query_total);  
			 if($row_total = mysql_fetch_array($query_total_x)){ 
				 if($row_total['total']<=0){
					 return 1;
				 }else{
					 return $row_total['total']; 
				 }
				
			 }
			 
			 return 1;
		}
        function getCriteriaStudentTotal($studid,$term,$criteria,$classid){
			
			$query_student_total = "SELECT sum(cc.score) as `total` FROM `criteria_class` cc INNER JOIN criteria c ON cc.criteriaid=c.id where cc.studentid = $studid and c.term = '$term' and c.criteria='$criteria' and c.classid=$classid";
            $query_student_total_x = mysql_query($query_student_total);  
			 if($row_student_total = mysql_fetch_array($query_student_total_x)){ 
				 if($row_student_total['total']<=0){
					 return 0;
				 }else{
					 return $row_student_total['total']; 
				 }
			 }
			 
			 return 0;
			 
		}
        function getstudentgrade($studid,$classid){
			$tid = $_SESSION['id'];
			$query_teacherid = "select * from teacher where teachid='$tid' ";
            $query_teacherid_x = mysql_query($query_teacherid); 
			 if($row_teacherid = mysql_fetch_array($query_teacherid_x)){
				$teacherid = $row_teacherid['id'];
				echo "<script>console.log('TEACHER ID: ' + $teacherid)</script>";
			 } 
			
			 $query_grading_system = "SELECT * FROM `gradingsystem` where `teacherid` = '$tid'";
            $query_grading_system_x = mysql_query($query_grading_system);  
			 if($row_grading_system = mysql_fetch_array($query_grading_system_x)){
				$prelim_gs = $row_grading_system['prelim'];
				$midterm_gs = $row_grading_system['midterm'];
				$finals_gs = $row_grading_system['finals'];
				$student_point = $row_grading_system['student_point'];
				$bonus_point = $row_grading_system['bonus_point'];
				 
			 }
			 
            $criteria_name = array();
			$criteria_percentage = array();
			$prelim_total_criteria_grade =array();
			$prelim_criteria_grade =array();
			
			$midterm_total_criteria_grade =array();
			$midterm_criteria_grade =array();
			
			$finals_total_criteria_grade =array();
			$finals_criteria_grade =array();
				
			$counter = 0;
			 $get_criteria = "SELECT `id`, `teacherid`, `criteria`, `percentage` FROM `criteria_teacher` WHERE `teacherid` = '$tid' order by criteria asc";
            $get_criteria_x = mysql_query($get_criteria);  
			 while($row_get_criteria = mysql_fetch_array($get_criteria_x)){
				  $criteria_name[$counter] = $row_get_criteria[2];
				  $criteria_percentage[$counter] = $row_get_criteria[3]; 
				  echo "<script>console.log('CRITERIA: $criteria_name[$counter]')</script>";
				  $counter++;
			 }
			 
				$criteria_count = count($criteria_name); 
				//PRELIM
				for($i = 0; $i<$criteria_count; $i++){  
					 $prelim_criteria_total = $this->getCriteriaTotal($classid,'prelim',$criteria_name[$i]); 
					 $prelim_student_criteria_total = $this->getCriteriaStudentTotal($studid,'prelim',$criteria_name[$i],$classid); 
					 $prelim_total_criteria_grade[$i] = ((($prelim_criteria_total/$prelim_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100); 
					 $prelim_criteria_grade[$i] = ((($prelim_student_criteria_total/$prelim_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100);   
				}
				//MIDTERM
				for($i = 0; $i<$criteria_count; $i++){  
					 $midterm_criteria_total = $this->getCriteriaTotal($classid,'midterm',$criteria_name[$i]); 
					 $midterm_student_criteria_total = $this->getCriteriaStudentTotal($studid,'midterm',$criteria_name[$i],$classid); 
					 $midterm_total_criteria_grade[$i] = ((($midterm_criteria_total/$midterm_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100); 
					 $midterm_criteria_grade[$i] = ((($midterm_student_criteria_total/$midterm_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100);   
				}
				//FINALS
				for($i = 0; $i<$criteria_count; $i++){  
					 $finals_criteria_total = $this->getCriteriaTotal($classid,'finals',$criteria_name[$i]); 
					 $finals_student_criteria_total = $this->getCriteriaStudentTotal($studid,'finals',$criteria_name[$i],$classid); 
					 $finals_total_criteria_grade[$i] = ((($finals_criteria_total/$finals_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100); 
					 $finals_criteria_grade[$i] = ((($finals_student_criteria_total/$finals_criteria_total)*$student_point)+$bonus_point)*($criteria_percentage[$i]/100);   
					  
				}
				  
			
			
			$prelim = 0;
			for($i = 0; $i<$criteria_count; $i++){  
				 $prelim =  $prelim + $prelim_criteria_grade[$i];
			} 
			$midterm = 0;
			for($i = 0; $i<$criteria_count; $i++){  
				 $midterm =  $midterm + $midterm_criteria_grade[$i];
			}
			$final = 0;
			for($i = 0; $i<$criteria_count; $i++){  
				 $final =  $final + $finals_criteria_grade[$i];
			}
			
			
				 
                $total = ($prelim * ($prelim_gs/100)) + ($midterm * ($midterm_gs/100)) + ($final * ($finals_gs/100));
                
                $data = array(
                    'eqprelim' => $this->gradeconversion($prelim),
                    'eqmidterm' => $this->gradeconversion($midterm),
                    'eqfinal' => $this->gradeconversion($final),
                    'eqtotal' => $this->gradeconversion($total),
                    'prelim' => round($prelim),
                    'midterm' => round($midterm),
                    'final' => round($final),
                    'total' => round($total),  
					 
                ); 
				for($i = 0; $i<$criteria_count; $i++){  
				   $data['prelim_'.$criteria_name[$i]] = $prelim_criteria_grade[$i];
			} for($i = 0; $i<$criteria_count; $i++){  
				   $data['midterm_'.$criteria_name[$i]] = $midterm_criteria_grade[$i];
			} for($i = 0; $i<$criteria_count; $i++){  
				   $data['finals_'.$criteria_name[$i]] = $finals_criteria_grade[$i];
			} 
            return $data;
        }
	 
        function getstudentbyid($studid){
            $q = "select * from student where id=$studid";   
            $r = mysql_query($q);
            $data = array();
            $data[] = mysql_fetch_array($r);
            return $data;
        }
		
		   function getstudentbyidedit($id){
            $q = "select * from student where id=$id";
            $r = mysql_query($q); 
            return $r;
        }
		 
        //update student
        function updatestudent(){
            include('../../config.php');
            $id = $_GET['id'];
            $classid = $_GET['classid'];
            $studid = $_POST['studid'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $xname = $_POST['xname'];
            $q = "update student set studid='$studid', fname='$fname', mname='$mname', lname='$lname', xname='$xname' where id=$id";
            mysql_query($q);
           
            header('location:../student.php?classid='.$classid.'');
           // header('location:../edit.php?type=student&id='.$id.'&classid='.$classid.'');
        }
        
        function gradeconversion($grade){
            $grade = round($grade);
            if($grade==0){
                 $data = 0;
            }else{
			
				if($grade>=98){
					$data = 1.00;
				}else if($grade>=95){
					$data = 1.25;
				}else if($grade>=92){
					$data = 1.5;
				}else  if($grade>=89){
					$data = 1.75;
				}else  if($grade>=86){
					$data = 2.00;
				}else  if($grade>=83){
					$data = 2.25;
				}else  if($grade>=80){
					$data = 2.5;
				}else  if($grade>=77){
					$data = 2.75;
				}else  if($grade>=74.56){
					$data = 3.00;
				 }else {
					 $data = 5.00; 
				 }
			
			 
            }
            return $data;
        }
    }
?>