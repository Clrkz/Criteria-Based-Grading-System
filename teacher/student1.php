<?php
    include('include/header.php');
    include('include/sidebar.php');
    //include('data/subject_model.php');
    include('data/student_model.php');
    include('data/criteria_model.php');
    //$mysubject = $subject->getallsubject($id); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;    
    $search = isset($_POST['search']) ? $_POST['search'] : null;     
    $term = isset($_GET['term']) ? $_GET['term'] : null;    
    $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null;    
    if(isset($_POST['search'])){
       // $classid = $_POST['subject'];   
        $mystudent = $student->getstudentbysearch($classid,$search);
    }else{
        $mystudent = $student->getstudentbyclass($classid);
    }
	$r2 = mysql_query("SELECT concat(`course`,' ',`year`,' ',`section`) as coursename FROM `class` WHERE `id` = $classid ");
    $classname = mysql_fetch_array($r2);
	$r1 = mysql_query("SELECT count(*) FROM `criteria` WHERE `classid`='$classid' and `criteria`='attendance' and term = 'midterm' ");
    $count1 = mysql_fetch_array($r1);
	 //echo "<script>console.log('aiw $count1[0]')</script>";
	 if($count1[0] < 1){
		 for($i = 0; $i < 16; $i++){
		//$query = "INSERT INTO `criteria`(`classid`, `term`, `criteria`, `name`, `total`) VALUES ('$classid','midterm','attendance','',1)";
		//mysql_query($query);
		 }
		 for($i = 0; $i < 16; $i++){
		//$query = "INSERT INTO `criteria`(`classid`, `term`, `criteria`, `name`, `total`) VALUES ('$classid','finals','attendance','',1)";
		//mysql_query($query);
		 }
	 }
	 
	 
    $attendancelist = $selectedcriteria->getcriteria($classid,$term,'attendance'); 
	$criterialist = $selectedcriteria->getcriterialist($_SESSION['id']); //for attendance
	$criterialist1 = $selectedcriteria->getcriterialist($_SESSION['id']); //all criteria 
	$attendanceids = array(); 
	
	
	$getallcriteriadata = array();
	
	// echo "<script>console.log('aiw $attendanceids[1]')</script>";
	
	 
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="test.js"></script>
<script src="test1.js"></script>
</head>

<style>
th,td {
    white-space: nowrap;
}
th{background-color:#f9f9f9}
td{background-color:#f9f9f9}
tr{background-color:#f9f9f9}
</style>
<body class="meow">
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small><?php echo strtoupper($classname[0]).' '.strtoupper($term).' RECORDS' ;?></small>
                </h1>
                 <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="subject.php">My Class</a>
                    </li> 
                    <li class="active">
                        <?php echo ucfirst($term).' Records' ;?>
                    </li>
                </ol>
            </div>
        </div>
		<!--
		   <a href="criteria.php?classid=<?php echo $classid;?>&criteria=<?php echo $row['criteria'];?>&term=<?php echo $term; ?>" class="btn btn-primary"><?php echo ucfirst($row['criteria']);?></a>  
               -->
		<div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if($criteria == '' || $criteria == null){ echo 'active'; } ?>"><a href="#data1" role="tab" data-toggle="tab">Attendance</a></li>
					<?php while($row = mysql_fetch_array($criterialist)): ?>
					<li  class="<?php if($criteria == $row['criteria']){ echo 'active'; } ?>"><a href="#<?php echo ($row['id']);?>" role="tab" data-toggle="tab"><?php echo ucfirst($row['criteria']);?></a></li> 
					<?php  $getallcriteriadata[] = $selectedcriteria->getcriteria($classid,$term,$row['criteria']);  ?>
					<?php endwhile; ?> 
				  </ul> 
                <div class="tab-content"> 
            <div class="tab-pane <?php if($criteria == '' || $criteria == null){ echo 'active'; } ?>" id="data1">
					<br> 
					     <div class="row">
						<div class="col-lg-12">
							<div class="form-inline form-padding">
								<form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=attendance&term=<?php echo $term; ?>" method="post">
								 <input type="text" size=10 class="form-control" name="name" placeholder="Date" value="<?php echo date("m/d/y");?>" required> 
								   <input type="text"   name="total" placeholder="Total" value="1"  hidden/>
							   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Attendance</button>   
							   </form>
							   
							</div>
						</div>
					</div>  
					<div class="table-responsive">  
                    <table class="table table-striped table-bordered"> 
                        <thead>
						 <tr>
							<td class="text-center text-danger" colspan="3"  > <strong>ATTENDANCE</strong></td>    	
						  <?php while($row1 = mysql_fetch_array($attendancelist)): ?>
						  <?php $attendanceids[] = $row1['id'];   ?>
						    <form action="data/criteria_model.php?q=update_attendance&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>&criteriaid= <?php echo $row1['id'];   ?>" method="post">
						  <td class="text-center">
						  <!--<input size="6" type="text" placeholder="Date" name="criteria" value= "" /> -->
						  <?php echo $row1['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row1['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>" title="Delete Attendance Record"><i class="fa fa-times-circle  text-danger "></i></a></td>
						  </td>  
						   <input type="submit" name="SubmitButton" hidden/>
						  </form>
						   <?php endwhile; ?> 
						 </tr> 
                        </thead> 
                        <tbody> 
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
                        <tr>
                            <td><?php echo $c; ?></td>     
                            <td class="text-center"><?php echo $row['studid']; ?></td>    
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname']; ?></td>  
							 
							 <?php for($i = 0; $i < count($attendanceids); $i++): ?>
                            <?php  $attendancescore = $selectedcriteria->getcriteriascore($row['id'],$attendanceids[$i]); ?> 
							    <?php $row2 = mysql_fetch_array($attendancescore); ?> 
								<?php 
								if($row2['score'] == null || $row2['score'] == '0'){
									?>  <td class="text-center"> <input type="checkbox"  id="<?php echo  $attendanceids[$i].''.$row['id']  ?>" name="checkbox" value="<?php echo  $attendanceids[$i].' '.$row['id']  ?>" > </td> <?php
								}else{
									?>  <td class="text-center"> <input type="checkbox" id="<?php echo  $attendanceids[$i].''.$row['id']  ?>"   name="checkbox" value="<?php echo  $attendanceids[$i].' '.$row['id']  ?>" checked> </td> <?php
								} 
								?> 
								  <?php endfor; ?> 
                        </tr>
                    <?php $c++; ?> 
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>  <!--table-responsive-->
            </div><!-- tab-pane active -->
			
			
			<!--START TAB 2--->
			<?php $counter=0; ?>
			<?php while($row3 = mysql_fetch_array($criterialist1)): ?>
			<?php $getallcriteriadataids = array();  ?>
				<div class="tab-pane <?php if($criteria == $row3['criteria']){ echo 'active'; } ?>" id="<?php echo ($row3['id']);?>">
					<br> 
					     <div class="row">
						<div class="col-lg-12">
							<div class="form-inline form-padding">
								<form action="data/criteria_model.php?q=addcriteria1&classid=<?php echo $classid; ?>&criteria=<?php echo $row3['criteria']; ?>&term=<?php echo $term; ?>" method="post">
								 <input type="text" size=15 class="form-control" name="name" placeholder="Name" value="" required> 
								  <input type="number" class="form-control" name="total" placeholder="Total" min=1 max=9999 value="" required>  
							  <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add <?php echo ucfirst($row3['criteria']);?></button>   
							   </form>
							   
							</div>
						</div>
					</div>  
					<div class="table-responsive">  
                    <table class="table table-striped table-bordered"> 
                        <thead>
						 <tr>
							<td class="text-center text-danger" colspan="3"  > <strong><?php echo strtoupper($row3['criteria']);?></strong></td>  
							 
						  <?php while($row4 = mysql_fetch_array($getallcriteriadata[$counter])): ?>
						  <?php $getallcriteriadataids[] = $row4['id']; ?>
						    <form action="" method="post">
						  <td class="text-center"> 
						  <?php echo $row4['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row4['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>&criteria=<?php echo $row3['criteria']; ?>" title="Delete <?php echo ucfirst($row3['criteria']);?>"><i class="fa fa-times-circle  text-danger "></i></a></td>
						  </td>   
						  </form>
						   <?php endwhile; ?> 
						 </tr> 
                        </thead> 
                        <tbody> 
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
                        <tr>
                            <td><?php echo $c; ?></td>     
                            <td class="text-center"><?php echo $row['studid']; ?></td>    
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname']; ?></td>  
							 
							 <?php for($i = 0; $i < count($getallcriteriadataids); $i++): ?>
                            <?php  $criteriascore = $selectedcriteria->getcriteriascore($row['id'],$getallcriteriadataids[$i]); ?> 
							    <?php $row2 = mysql_fetch_array($criteriascore); ?> 
					<td class="text-center"> 
					<?php
						$msQ = mysql_query("SELECT `total` FROM `criteria` WHERE `id` = $getallcriteriadataids[$i] ");
						$maxscore = mysql_fetch_array($msQ);
					?> 
					
					 <input type="number"  class="form-control" name="score" id="<?php echo $getallcriteriadataids[$i].'_'.$row['id']  ?>"  placeholder="Score" min=0 max=<?php echo $maxscore[0]; ?> value="<?php echo $row2['score'];  ?>" >  
					<!--<input type="number" placeholder="Score"name="checkbox" value="<?php echo $row2['score'];  ?>" > --->
					</td> 
								  
								  <?php endfor; ?> 
                        </tr>
                    <?php $c++; ?> 
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>  <!--table-responsive-->
            </div><!-- tab-pane active -->
			
			 <?php $counter++; ?>
			<?php endwhile; ?> 
			<!-- TAB 2 -->
        </div>  <!-- tab-content -->
		</div> <!-- /.="col-lg-12  --> 
		</div> <!-- /.row  -->
		 </div> <!-- /.container fluid-fluid --> 
   
 </div>
</body>

<script> 

</script>

<!-- /#page-wrapper -->    
<?php //include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>