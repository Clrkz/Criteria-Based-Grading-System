<?php
    include('include/header.php');
    include('include/sidebar.php');
    //include('data/subject_model.php');
    include('data/student_model.php');
    include('data/criteria_model.php');
    //$mysubject = $subject->getallsubject($id); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;    
    $search = isset($_GET['search']) ? $_GET['search'] : null;        
    $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null; 
	$selectedtab = isset($_GET['selectedtab']) ? $_GET['selectedtab'] : null; 	 
    if(isset($_GET['search'])){
       // $classid = $_POST['subject'];   
        $mystudent = $student->getstudentbysearch($classid,$search);
    }else{
        $mystudent = $student->getstudentbyclass($classid);
    }
	
	$r2 = mysql_query("SELECT concat(`course`,' ',`year`,' ',`section`) as coursename FROM `class` WHERE `id` = $classid ");
    $classname = mysql_fetch_array($r2);
	$r1 = mysql_query("SELECT count(*) FROM `criteria` WHERE `classid`='$classid' and `criteria`='attendance' and term = 'midterm' ");
    $count1 = mysql_fetch_array($r1);
	
	   
?>
<head>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
-->

<script src="../js/jquery.min.js"></script> 
<script src="test.js"></script>
<script src="test1.js"></script>
</head>

<style>
.form-control1{display:block;width:100%;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);-webkit-transition:border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s, box-shadow ease-in-out .15s}
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
                    <small><?php echo strtoupper($classname[0]).' RECORDS' ;?></small>
                </h1>
                 <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="subject.php">My Class</a>
                    </li> 
                    <li class="active">
                        <?php echo strtoupper($classname[0]).' Records' ;?>
                    </li>
                </ol>
            </div>
        </div>
		
		<div class="row">
		 <div class="col-lg-12">
		   <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if($selectedtab == '' || $selectedtab == null){ echo 'active'; } ?>"><a href="#masterlist" id="mlist" role="tab" data-toggle="tab">Master List</a></li>
                    <li class="<?php if($selectedtab == 'midtermrecord'){ echo 'active'; } ?>"><a href="#midtermrecord" role="tab" data-toggle="tab">Midterm Records</a></li>
                     <li class="<?php if($selectedtab == 'finalsrecord'){ echo 'active'; } ?>"><a href="#finalrecord" role="tab" data-toggle="tab">Finals Records</a></li>
                </ul>
				<br>
		  <div class="tab-content">
		  <div class="tab-pane  <?php if($selectedtab == '' || $selectedtab == null){ echo 'active'; } ?>"  id="masterlist"> 
        <div class="row">
            <div class="col-lg-12">                
 <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="" method="get">
                        <input type="hidden" class="form-control" name="classid" value="<?php echo $classid; ?>"> 
                        <input type="text" class="form-control" name="search" value="<?php echo $search; ?>" placeholder="Search by ID or Name"> 
                        <button type="submit" name="" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>      
                        <a href="excel.php?classid=<?php echo $classid; ?>&classname=<?php echo ($classname[0]); ?>" target="_blank"><button type="button" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Print and Save</button></a>            
                    </form>
                </div>
            </div>
        </div>
                <div class="table-responsive"> 
					<?php  
	$criterialistmidterm = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialistfinals = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']);  
					?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Name</th> 
								 <?php while($row3 = mysql_fetch_array($criterialistmidterm)): ?> 
                                 <th style="background-color:#efff00;" class="text-center"><?php echo ucfirst($row3['criteria']);?></th> 
							 <?php endwhile; ?> 
                                <th style="background-color:#efff00;" class="text-center">Midterm Total</th>
                                <th style="background-color:#efff00;" class="text-center">Midterm EQ.</th>
								
								 <?php while($row3 = mysql_fetch_array($criterialistfinals)): ?> 
                                 <th style="background-color:#45eeff;" class="text-center"><?php echo ucfirst($row3['criteria']);?></th> 
							 <?php endwhile; ?> 
                                <th style="background-color:#45eeff;" class="text-center">Finals</th>
                                <th style="background-color:#45eeff;" class="text-center">Finals EQ.</th>
                                <th  style="background-color:#ff454580;" class="text-center">Total</th>
                                <th  style="background-color:#ff454580;" class="text-center">Total EQ.</th>
                                <th class="text-center">Computations</th> 
                            </tr>
                        </thead>
                        <tbody>
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
					<?php 
					
	$criterialistmidterm = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialistfinals = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']);  
					?>
                        <tr>
                            <td><?php echo $c; ?></td>     
                            <td class="text-center"><?php echo $row['studid']; ?></td>    
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname']; ?></td>  
							<?php $grade = $student->getstudentgrade($row['id'],$classid); ?> 
							 <?php while($row3 = mysql_fetch_array($criterialistmidterm)): ?> 
                              <td style="background-color:#efff00;" class="text-center"><?php echo number_format($grade['midterm_'.$row3['criteria']],2);?></td> 
							 <?php endwhile; ?>  
                            <td style="background-color:#efff00;" class="text-center"><?php echo $grade['midterm'];?></td>   
                            <td style="background-color:#efff00;" class="text-center"><?php   $meow=$grade['eqmidterm']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; } ?></td>  
							 <?php while($row3 = mysql_fetch_array($criterialistfinals)): ?> 
                              <td style="background-color:#45eeff;" class="text-center"><?php echo number_format($grade['finals_'.$row3['criteria']],2);?></td> 
							 <?php endwhile; ?>  
                            <td style="background-color:#45eeff;" class="text-center"><?php echo $grade['final'];?></td>     
                            <td style="background-color:#45eeff;" class="text-center"><?php $meow=$grade['eqfinal']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; } ?></td>    
                            <td style="background-color:#ff454580;" class="text-center"><?php echo $grade['total'];?></td>    
                            <td  style="background-color:#ff454580;"  class="text-center"><strong><?php $meow=$grade['eqtotal']; if($meow>3){echo "<label  style='color:red;' >$meow</label>"; }else{echo "<label  style='color:green;' >$meow</label>"; }  ?></strong></td>    
                            <td class="text-center"><a href="calculate.php?studid=<?php echo $row['id']; ?>&classid=<?php echo $classid ?>" class="btn btn-primary"><i class="fa fa-gear fa-lg" title="calculate grade"></i></a>
							 </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
		  </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		   
		  
		  
		  
		  
		  
		  <div class="tab-pane <?php if($selectedtab == 'midtermrecord'){ echo 'active'; } ?>" id="midtermrecord"> 
		  <?php 
		  $term = 'midterm';
    $attendancelist = $selectedcriteria->getcriteria($classid,$term,'attendance'); 
	$criterialist = $selectedcriteria->getcriterialist($_SESSION['id']); //for attendance
	$criterialist1 = $selectedcriteria->getcriterialist($_SESSION['id']); //all criteria 
	$attendanceids = array();  
	$getallcriteriadata = array();
		  ?>
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
								<form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=attendance&term=<?php echo $term; ?>&selectedtab=midtermrecord&search=<?php echo $search; ?>" method="post">
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
							<td class="text-center text-danger" colspan="3"  > <strong>MIDTERM ATTENDANCE</strong></td>    	
						  <?php while($row1 = mysql_fetch_array($attendancelist)): ?>
						  <?php $attendanceids[] = $row1['id'];   ?>
						    <form action="data/criteria_model.php?q=update_attendance&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>&criteriaid= <?php echo $row1['id'];?>" method="post">
						  <td class="text-center">
						  <!--<input size="6" type="text" placeholder="Date" name="criteria" value= "" /> -->
						  <?php echo $row1['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row1['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>&selectedtab=midtermrecord&search=<?php echo $search; ?>" title="Delete Attendance Record"><i class="fa fa-times-circle  text-danger "></i></a></td>
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
								<form action="data/criteria_model.php?q=addcriteria1&classid=<?php echo $classid; ?>&criteria=<?php echo $row3['criteria']; ?>&term=<?php echo $term; ?>&selectedtab=midtermrecord&search=<?php echo $search; ?>" method="post">
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
							<td class="text-center text-danger" colspan="3"  > <strong>MIDTERM <?php echo strtoupper($row3['criteria']);?></strong></td>  
							 
						  <?php while($row4 = mysql_fetch_array($getallcriteriadata[$counter])): ?>
						  <?php $getallcriteriadataids[] = $row4['id']; ?>
						    <form action="" method="post">
						  <td class="text-center"> 
						  <?php echo $row4['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row4['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $term; ?>&criteria=<?php echo $row3['criteria']; ?>&selectedtab=midtermrecord&search=<?php echo $search; ?>" title="Delete <?php echo ucfirst($row3['criteria']);?>"><i class="fa fa-times-circle  text-danger "></i></a></td>
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
					
					 <input type="number"  class="form-control1" height="12" name="score" id="<?php echo $getallcriteriadataids[$i].'_'.$row['id']  ?>"  placeholder="Score" min="0" max="<?php echo $maxscore[0]; ?>" value="<?php echo $row2['score'];  ?>" >  
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
		</div> <!-- /.end midterm  -->
		
		
		
		  
		
		
		
		
		
		 
		
		
		
		
		<div class="tab-pane <?php if($selectedtab == 'finalsrecord'){ echo 'active'; } ?>" id="finalrecord"> 
  <?php 
		  $termfinals = 'finals';
    $attendancelistfinals = $selectedcriteria->getcriteria($classid,$termfinals,'attendance'); 
	$criterialistfinals = $selectedcriteria->getcriterialist($_SESSION['id']); //for attendance
	$criterialist1finals = $selectedcriteria->getcriterialist($_SESSION['id']); //all criteria 
	$attendanceidsfinals = array();  
	$getallcriteriadatafinals = array();
		  ?>
		<div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if($criteria == '' || $criteria == null){ echo 'active'; } ?>"><a href="#finals1" role="tab" data-toggle="tab">Attendance</a></li>
					<?php while($row = mysql_fetch_array($criterialistfinals)): ?>
					<li  class="<?php if($criteria == $row['criteria']){ echo 'active'; } ?>"><a href="#finals<?php echo ($row['id']);?>" role="tab" data-toggle="tab"><?php echo ucfirst($row['criteria']);?></a></li> 
					<?php  $getallcriteriadatafinals[] = $selectedcriteria->getcriteria($classid,$termfinals,$row['criteria']);  ?>
					<?php endwhile; ?> 
				  </ul> 
                <div class="tab-content"> 
            <div class="tab-pane <?php if($criteria == '' || $criteria == null){ echo 'active'; } ?>" id="finals1">
					<br> 
					     <div class="row">
						<div class="col-lg-12">
							<div class="form-inline form-padding">
								<form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=attendance&term=<?php echo $termfinals; ?>&selectedtab=finalsrecord&search=<?php echo $search; ?>" method="post">
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
							<td class="text-center text-danger" colspan="3"  > <strong>FINALS ATTENDANCE</strong></td>    	
						  <?php while($row1 = mysql_fetch_array($attendancelistfinals)): ?>
						  <?php $attendanceidsfinals[] = $row1['id'];   ?>
						    <form action="data/criteria_model.php?q=update_attendance&classid=<?php echo $classid; ?>&term=<?php echo $termfinals; ?>&criteriaid= <?php echo $row1['id'];?>" method="post">
						  <td class="text-center">
						  <!--<input size="6" type="text" placeholder="Date" name="criteria" value= "" /> -->
						  <?php echo $row1['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row1['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $termfinals; ?>&selectedtab=finalsrecord&search=<?php echo $search; ?>" title="Delete Attendance Record"><i class="fa fa-times-circle  text-danger "></i></a></td>
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
							 
							 <?php for($i = 0; $i < count($attendanceidsfinals); $i++): ?>
                            <?php  $attendancescore = $selectedcriteria->getcriteriascore($row['id'],$attendanceidsfinals[$i]); ?> 
							    <?php $row2 = mysql_fetch_array($attendancescore); ?> 
								<?php 
								if($row2['score'] == null || $row2['score'] == '0'){
									?>  <td class="text-center"> <input type="checkbox"  id="<?php echo  $attendanceidsfinals[$i].''.$row['id']  ?>" name="checkbox" value="<?php echo  $attendanceidsfinals[$i].' '.$row['id']  ?>" > </td> <?php
								}else{
									?>  <td class="text-center"> <input type="checkbox" id="<?php echo  $attendanceidsfinals[$i].''.$row['id']  ?>"   name="checkbox" value="<?php echo  $attendanceidsfinals[$i].' '.$row['id']  ?>" checked> </td> <?php
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
			<?php while($row3 = mysql_fetch_array($criterialist1finals)): ?>
			<?php $getallcriteriadataidsfinals = array();  ?>
				<div class="tab-pane <?php if($criteria == $row3['criteria']){ echo 'active'; } ?>" id="finals<?php echo ($row3['id']);?>">
					<br> 
					     <div class="row">
						<div class="col-lg-12">
							<div class="form-inline form-padding">
								<form action="data/criteria_model.php?q=addcriteria1&classid=<?php echo $classid; ?>&criteria=<?php echo $row3['criteria']; ?>&term=<?php echo $termfinals; ?>&selectedtab=finalsrecord&search=<?php echo $search; ?>" method="post">
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
							<td class="text-center text-danger" colspan="3"  > <strong>FINALS <?php echo strtoupper($row3['criteria']);?></strong></td>  
							 
						  <?php while($row4 = mysql_fetch_array($getallcriteriadatafinals[$counter])): ?>
						  <?php $getallcriteriadataidsfinals[] = $row4['id']; ?>
						    <form action="" method="post">
						  <td class="text-center"> 
						  <?php echo $row4['name']."&nbsp;"; ?>
						    <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row4['id'];?>&classid=<?php echo $classid; ?>&term=<?php echo $termfinals; ?>&criteria=<?php echo $row3['criteria']; ?>&selectedtab=finalsrecord&search=<?php echo $search; ?>" title="Delete <?php echo ucfirst($row3['criteria']);?>"><i class="fa fa-times-circle  text-danger "></i></a></td>
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
							 
							 <?php for($i = 0; $i < count($getallcriteriadataidsfinals); $i++): ?>
                            <?php  $criteriascore = $selectedcriteria->getcriteriascore($row['id'],$getallcriteriadataidsfinals[$i]); ?> 
							    <?php $row2 = mysql_fetch_array($criteriascore); ?> 
					<td class="text-center"> 
					<?php
						$msQ = mysql_query("SELECT `total` FROM `criteria` WHERE `id` = $getallcriteriadataidsfinals[$i] ");
						$maxscore = mysql_fetch_array($msQ);
					?> 
					
					 <input type="number"  class="form-control1" height="12" name="score" id="<?php echo $getallcriteriadataidsfinals[$i].'_'.$row['id']  ?>"  placeholder="Score" min=0 max=<?php echo $maxscore[0]; ?> value="<?php echo $row2['score'];  ?>" >  
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
		</div>
		
        </div>  <!-- tab-content -->
		</div> <!-- /.="col-lg-12  --> 
		</div> <!-- /.row  -->
		
		 </div> <!-- /.container fluid-fluid --> 
   
 </div>
</body>

<script> 
$('#mlist').click(function() {
	 var search = "<?php echo  $search; ?>"; 
	 var classid = "<?php echo  $classid; ?>";  
	window.location.href = 'student.php?classid='+classid+'&search='+search;
});
</script>

<!-- /#page-wrapper -->    
<?php //include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>