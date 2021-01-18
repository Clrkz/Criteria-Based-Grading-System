<?php
    $selectedcriteria = new Datacriteria();
    if(isset($_GET['q'])){
        $function = $_GET['q'];
        $selectedcriteria->$function();
    }
    
    class Datacriteria {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
              header('location:../../');   
            }
        }
		
		function getcriteria($classid,$term,$criteria){
            $q = "SELECT * FROM `criteria` WHERE `classid`= '$classid' and `term` = '$term' and `criteria` = '$criteria' order by id asc";  
            $r = mysql_query($q);
            return $r; 
        }
		
		
			 function getcriteriabyclass($classid,$criteria,$term){   
           $q = "select * from criteria where classid=$classid and criteria='$criteria' and term='$term' order by id desc";   
            $r = mysql_query($q);
            return $r;  
        }
		function getcriteriascore($sid,$criteriaid){
            $q = "SELECT score FROM `criteria_class` WHERE  `studentid` = '$sid' and criteriaid = '$criteriaid' ";  
            $r = mysql_query($q);
            return $r; 
        }
		
		function update_attendance(){
            include('../../config.php');
            $criteriaid = $_GET['criteriaid']; 
            $name = $_POST['criteria']; 
            $term = $_GET['term']; 
            $classid = $_GET['classid'];
            $q = "UPDATE `criteria` SET  `name`='$name' WHERE `id` = $criteriaid";
            mysql_query($q); 
			
            header('location:../student.php?classid='.$classid.'&term='.$term.''); 
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
		
		/////////////////////////////////////////////////////////////////////////////////////
		//add criteria
        function add_criteria(){
            include('../../config.php'); 
            $name = $_POST['name'];
			$percent = $_POST['percent']; 
            $tid = $_GET['tid']; 
			$nameuc = ucfirst($name);
			if(strcasecmp($name,'attendance') == 0){ 
					
			}else{
				$q = "INSERT INTO `criteria_teacher`(`teacherid`, `criteria`, `percentage`) VALUES ('$tid','$nameuc','$percent')";
					mysql_query($q);    
			}
					header('location:../gradingsystem.php?status=1'); 
        }
		
		function getcriterialist($tid){
            $q = "SELECT `id`, `teacherid`, `criteria`, `percentage` FROM `criteria_teacher` WHERE `teacherid` = '$tid' and criteria not in ('attendance') order by criteria asc ";  
            $r = mysql_query($q);
            return $r;
        }
		function getcriterialistgradingsystem($tid){
            $q = "SELECT `id`, `teacherid`, `criteria`, `percentage` FROM `criteria_teacher` WHERE `teacherid` = '$tid' order by FIELD(criteria,'attendance') desc,criteria asc ";  
            $r = mysql_query($q);
            return $r;
        }
		
		function update_criteria(){  
            include('../../config.php'); 
            $percent = $_POST['percent'];
            $id = $_POST['id'];
			if($_POST['action']=='update'){
				$q = "UPDATE `criteria_teacher` SET `percentage`='$percent' WHERE id = '$id'";   
			}else{
				 $q = "DELETE FROM `criteria_teacher` WHERE id = '$id'";   
			}
            
			$r = mysql_query($q); 
			header('location:../gradingsystem.php?status=1'); 
        }
		
		function getcriterialistsum($tid){
            $q = "SELECT sum(percentage) as total FROM `criteria_teacher` WHERE `teacherid` = '$tid' LIMIT 1 ";  
            $r = mysql_query($q);
            return $r;
        }
		
		 
		/////////////////////////////////////////////////////////////////////////////////////
		
		//add criteria for attendance only
        function addcriteria(){
            include('../../config.php'); 
			$search = isset($_GET['search']) ? $_GET['search'] : null;        
            $name = $_POST['name'];
			$total = $_POST['total']; 
            $criteria = $_GET['criteria']; 
            $term = $_GET['term']; 
            $selectedtab = $_GET['selectedtab']; 
            $classid = $_GET['classid']; 
					$q = "insert into criteria values(null,'$classid','$term','$criteria','$name','$total')";
					mysql_query($q);   
					//header('location:../criteria.php?classid='.$classid.'&criteria='.$criteria.'&term='.$term.'');  
					header('location:../student.php?classid='.$classid.'&term='.$term.'&selectedtab='.$selectedtab.'&search='.$search.'');
        }
	 
		//add criteria all type 
        function addcriteria1(){
            include('../../config.php'); 
			$search = isset($_GET['search']) ? $_GET['search'] : null;   
            $name = $_POST['name'];
			$total = $_POST['total']; 
            $criteria = $_GET['criteria']; 
            $term = $_GET['term']; 
            $selectedtab = $_GET['selectedtab']; 
            $classid = $_GET['classid']; 
					$q = "insert into criteria values(null,'$classid','$term','$criteria','$name','$total')";
					mysql_query($q);   
					//header('location:../criteria.php?classid='.$classid.'&criteria='.$criteria.'&term='.$term.'');  
					header('location:../student.php?classid='.$classid.'&term='.$term.'&criteria='.$criteria.'&selectedtab='.$selectedtab.'&search='.$search.'');
        }
		
		function getcriteriabyid($id){
            $q = "select * from criteria where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
		 //update quiz
        function updatecriteria(){
            include('../../config.php');
            $id = $_GET['id']; 
            $term = $_GET['term'];
            $criteria = $_GET['criteria'];
            $classid = $_GET['classid'];
            $name = $_POST['name'];
            $total = $_POST['total']; 
            $q = "update criteria set name='$name', total=$total where id=$id";
            mysql_query($q); 
            header('location:../criteria.php?classid='.$classid.'&criteria='.$criteria.'&term='.$term.'');
        }
        
		
		function deletecriteria(){
            include('../../config.php');
			$search = isset($_GET['search']) ? $_GET['search'] : null;    
            $id = $_GET['id']; 
            $term = $_GET['term'];
            $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null;    
            $classid = $_GET['classid'];  
            $table = $_GET['table']; 
            $selectedtab = $_GET['selectedtab']; 
			
            $q = "delete from $table where id=$id"; 
            mysql_query($q);
			if($criteria == 'attendance'){
			header('location:../student.php?classid='.$classid.'&term='.$term.'&selectedtab='.$selectedtab.'&search='.$search.'');
			}else{
			header('location:../student.php?classid='.$classid.'&term='.$term.'&criteria='.$criteria.'&selectedtab='.$selectedtab.'&search='.$search.'');
			}
            //header('location:../criteria.php?classid='.$classid.'&criteria='.$criteria.'&term='.$term.'');
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
		
		
		function updatecriteriascore(){ 
		 include('../../config.php'); 
					$stdid = $_GET['studentid'];
					$criteria = $_GET['criteria'];
            $term = $_GET['term'];
					$cname = $_GET['criterianame'];
					$maxscore = $_GET['maxscore'];
					$cid = $_GET['criteriaid'];
					$score = $_POST['score'];
					$classid = $_GET['classid'];
					$q1 = 'select * from criteria_class where criteriaid='.$cid.' and studentid='.$stdid.'';   
                    $r1 = mysql_query($q1);
					  
				  if(mysql_num_rows($r1) > 0) {
                    //update
					$q2 = "UPDATE `criteria_class` SET `criteriaid`=$cid,`studentid`=$stdid,`score`=$score where criteriaid=$cid  and studentid=$stdid ";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }else{
					//add
					$q2 = "INSERT INTO `criteria_class`(`criteriaid`, `studentid`, `score`) VALUES ($cid,$stdid,$score)";  
					//echo $q2;
                    $r2 = mysql_query($q2);
				   }
					header('location:../criteriaclass.php?id='.$cid.'&classid='.$classid.'&criterianame='.$cname.'&criteria='.$criteria.'&maxscore='.$maxscore.'&term='.$term.'');  
				 
					
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
            return $student;
        }
        
		  function getstudentbycriteriaclass($classid,$criteria_id,$criteria){
            $q = "select * from studentsubject where classid=$classid";
            $r = mysql_query($q);
            $student = array();
            if($classid != null){
               while($row = mysql_fetch_array($r)){
				    $q1 = 'select s.*,qc.criteriaid,qc.score from student s
inner join criteria_class qc
on s.id=qc.studentid 
where qc.studentid='.$row['studid'].' AND qc.criteriaid='.$criteria_id.'';  
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
        
        function getstudentgrade($studid,$classid){
            $q = "select * from studentsubject where studid='$studid' and classid='$classid'";
            $r = mysql_query($q);
            if($row = mysql_fetch_array($r)){
			$tid = $_SESSION['id'];
			$s = "select * from gradingsystem where teacherid='$tid' ";
            $t = mysql_query($s); 
			 if($row1 = mysql_fetch_array($t)){
				 
			 
                $act1 = ($row['act1']) * ($row1['act']/100);   
                $act2 = ($row['act2']) * ($row1['act']/100) ;   
                $act3 = ($row['act3']) * ($row1['act']/100); 
				  
                $hoe1 = ($row['hoe1']) * ($row1['hoe']/100);   
                $hoe2 = ($row['hoe2']) * ($row1['hoe']/100);
                $hoe3 = ($row['hoe3']) * ($row1['hoe']/100); 
				 
                $ass1 = ($row['ass1']) * ($row1['ass']/100);
                $ass2 = ($row['ass2']) * ($row1['ass']/100);   
                $ass3 = ($row['ass3']) * ($row1['ass']/100); 
				 
				 
                $att1 = ($row['att1']) * ($row1['att']/100);   
                $att2 = ($row['att2']) * ($row1['att']/100);   
                $att3 = ($row['att3']) * ($row1['att']/100); 
                
                $exam1 = ($row['exam1']) * ($row1['exam']/100); 
                $exam2 = ($row['exam2']) *($row1['exam']/100); 
                $exam3 = ($row['exam3']) * ($row1['exam']/100); 
                
                $quiz1 = ($row['quiz1']) * ($row1['quiz']/100);  
                $quiz2 = ($row['quiz2']) * ($row1['quiz']/100); 
                $quiz3 = ($row['quiz3']) * ($row1['quiz']/100); 
                
                $project1 = ($row['project1']) * ($row1['project']/100); 
                $project2 = ($row['project2']) * ($row1['project']/100); 
                $project3 = ($row['project3']) * ($row1['project']/100); 
				
                 $prelim =  $act1 +  $hoe1 + $ass1 + $att1 + $exam1 + $quiz1 + $project1;
                $midterm =  $act2 +  $hoe2 + $ass2 + $att2 + $exam2 + $quiz2 + $project2;
                $final = 	$act3 +  $hoe3 + $ass3 + $att3 + $exam3 + $quiz3 + $project3;
                
                
                $total = ($prelim * ($row1['prelim']/100)) + ($midterm * ($row1['midterm']/100)) + ($final * ($row1['finals']/100));
                
                $data = array(
                    'eqprelim' => $this->gradeconversion($prelim),
                    'eqmidterm' => $this->gradeconversion($midterm),
                    'eqfinal' => $this->gradeconversion($final),
                    'eqtotal' => $this->gradeconversion($total),
                    'prelim' => round($prelim),
                    'midterm' => round($midterm),
                    'final' => round($final),
                    'total' => round($total),
					
                    'act1' => $row['act1'],
                    'act2' => $row['act2'],
                    'act3' => $row['act3'],
					
                    'hoe1' => $row['hoe1'],
                    'hoe2' => $row['hoe2'],
                    'hoe3' => $row['hoe3'],
					
                    'ass1' => $row['ass1'],
                    'ass2' => $row['ass2'],
                    'ass3' => $row['ass3'],
					
                    'att1' => $row['att1'],
                    'att2' => $row['att2'],
                    'att3' => $row['att3'],
					
                    'exam1' => $row['exam1'],
                    'exam2' => $row['exam2'],
                    'exam3' => $row['exam3'],
					
                    'quiz1' => $row['quiz1'],
                    'quiz2' => $row['quiz2'],
                    'quiz3' => $row['quiz3'],
					
                    'project1' => $row['project1'],
                    'project2' => $row['project2'],
                    'project3' => $row['project3']
                );
				}
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
                switch ($grade) {
                     case $grade > 94:
                         $data = 1.0;
                         break;
                     case 94:
                         $data = 1.1;
                         break;
                    case 93:
                         $data = 1.2;
                         break;
                    case 92:
                         $data = 1.3;
                         break;
                    case 91:
                         $data = 1.4;
                         break;
                    case 90:
                         $data = 1.5;
                         break;
                    case 89:
                         $data = 1.6;
                         break;
                    case 88:
                         $data = 1.7;
                         break;
                    case 87:
                         $data = 1.8;
                         break;
                    case 86:
                         $data = 1.9;
                         break;
                    case 85:
                         $data = 2.0;
                         break;
                    case 84:
                         $data = 2.1;
                         break;
                    case 83:
                         $data = 2.2;
                         break;
                    case 82:
                         $data = 2.3;
                         break;
                    case 81:
                         $data = 2.4;
                         break;
                    case 80:
                         $data = 2.5;
                         break;
                   case 79:
                         $data = 2.6;
                         break;
                    case 78:
                         $data = 2.7;
                         break;
                    case 77:
                         $data = 2.8;
                         break;
                    case 76:
                         $data = 2.9;
                         break;
                    case 75:
                         $data = 3.0;
                         break;                

                     default:
                         $data = 5.0;
                }
            }
            return $data;
        }
    }
?>