<?php
    $grade = new Datagrade();

    function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }

    class Datagrade {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
                header('location:../../');   
            }
        }
        
        function getid(){
            $studid = $_SESSION['id'];
            $r = mysql_query("select * from student where studid='$studid'");
            $row = mysql_fetch_array($r);
            $id = $row['id'];
            return $id;
        }
        
        function getsubject(){
            $id = $this->getid();
            $q = "select * from studentsubject where studid=$id";
            $r = mysql_query($q);
            $data = array();
            while($row = mysql_fetch_array($r)){
                $classid = $row['classid'];
                $q2 = "select * from class where id=$classid";   
                $r2 = mysql_query($q2);  
                $data[] = mysql_fetch_array($r2);
            }
            return $data;
        }
        
        function getsubjectitle($code){
            $q = "select * from subject where code='$code'";
            $r = mysql_query($q);
            $data = array();
            $data[] = mysql_fetch_array($r);
            return $data;
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
		 

        function getgrade($classid){
			 $studid = $this->getid();  
			 
			  
			   $get_teacher_id = mysql_query("SELECT `teachid` FROM `teacher` where `id` = (SELECT `teacher` FROM `class` where `id` = '$classid' LIMIT 1) LIMIT 1");
            $row_get_teacher_id = mysql_fetch_array($get_teacher_id);
            $teacherid2= $row_get_teacher_id['teachid']; 
			
 $query_grading_system = "SELECT * FROM `gradingsystem` where `teacherid` = '$teacherid2'"; 
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
			 $get_criteria = "SELECT `id`, `teacherid`, `criteria`, `percentage` FROM `criteria_teacher` WHERE `teacherid` = '$teacherid2' order by criteria asc";
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
       
        function getteacher($teachid){
            $r = mysql_query("select * from teacher where id=$teachid");
            $result = mysql_fetch_array($r);
            $data = $result['fname'].' '.$result['lname'];
            return $data;
        }
        
    }
?>