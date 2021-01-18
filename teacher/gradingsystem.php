<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/criteria_model.php'); 
    include('data/gradingsystem_model.php');  
	$subject = $student->getsubjectbyid($_SESSION['id']);   
	$criterialist = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialistsum = $selectedcriteria->getcriterialistsum($_SESSION['id']); 

?>
<style>
#btnAddCriteria{ 
	width : 75px;
	text-align:center;
	display:inline-block; 
}
#btnRemove{ 
	text-align:center;
	display:inline-block; 
}
#txtValue{  
	width : 70%;
	padding: 4px 10px;  
}
</style>
<div id="page-wrapper">

    <div class="container-fluid">

       

       <div class="row">
	   <?php while($row = mysql_fetch_array($subject)): ?>
	   
            <div class="col-lg-12">
                 <?php if(isset($_GET['status'])): ?>
                    <?php if($_GET['status'] == 1): ?>
                        <div class="alert alert-success">
                            <strong>Done!</strong>
                        </div>
                    <?php endif; ?>
                <?php endif;?>
                 
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
								 <?php $row1 = mysql_fetch_array($criterialistsum); ?>
                                    <div class="huge"><?php $str = $row1['total']; if($str > 0 ){echo $str."%";}else{echo "0%";}  ?></div>
                                    <div>CRITERIA</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
						<!--
                            <form action="data/gradingsystem_model.php?q=criteria&tid=<?php echo $_SESSION['id'];?>" method="POST">
							-->
							<label><strong>ADD CRITERIA</strong></label>  
							<form action="data/criteria_model.php?q=add_criteria&tid=<?php echo $_SESSION['id'];?>" method="post">
                        
								<tr> 
									<td class="text-center"> 
									<input type="text" name="name" placeholder="Criteria Name"  id="txtValue" required>  
										</td>  
										<td class="text-center"> 
									<input type="number" name="percent" placeholder="Percentage" min=1 max=100  id="txtValue" required>  
										</td>  
											<td class="text-center"> 
												<button type="submit" class="btn btn-primary" id="btnAddCriteria" ><i class=""></i>  ADD </button>
											</td>
											 
										</tr>
							</form>
							<hr style="border-top: 1px solid #900e0e;">
							  
							  <?php $c=0; ?>
							 <?php while($row2 = mysql_fetch_array($criterialist)): ?>
							  <form action="data/criteria_model.php?q=update_criteria" method="post">
							  <label><strong><?php echo ucfirst($row2['criteria']);?></strong></label>  
							 
							<div class="form-group">
								<tr> 
								<input type="number" name="id"  id="txtValue" value="<?php echo $row2['id'];?>" hidden> 
									<input type="number" name="percent" placeholder="Percentage" min=1 max=100  id="txtValue" value="<?php echo $row2['percentage'];?>" > 
										</td>  
											<td class="text-center"> 
												<button name="action" type="submit" class="btn btn-primary" id="btnRemove" value="update" ><i class=""></i> ✓</button>
											</td>
											<td class="text-center">  
											<?php if($row2['criteria'] != 'attendance' ): ?>
												<button name="action" value="delete" type="submit" class="btn btn-danger confirmation" id="btnRemove" ><i class=""></i> X</button>
										<?php endif; ?>
											 </td>
										</tr>
							</div>
							
							</form>
                    <?php $c++; ?>
							 <?php endwhile; ?> 
							<?php if($c <= 0 ): ?>
							<div class="text-center">  <label ><strong>NO CRITERIA RECORD</strong></label>   </div>
							<?php endif; ?>
							 
							 <!--
                            <label><strong>Attendance</strong></label>  
							<div class="form-group">
								<tr> 
									<input type="number" name="score" placeholder="Score" min=1 max=100  id="txtValue" name=""> 
										</td>  
											<td class="text-center"> 
												<button type="submit" class="btn btn-primary" id="btnRemove" ><i class=""></i> ✓</button>
											</td>
											<td class="text-center"> 
												<button type="submit" class="btn btn-danger" id="btnRemove" ><i class=""></i> X</button>
											</td>
										</tr>
							</div>
						
						
                              <div class="form-group">
                                    <label><strong>Attendance</strong></label><input type="number" max=100  min=1 class="form-control" value="<?php echo $row['att'];?>" name="att" />
                                </div>

								<div class="form-group">
                                    <label><strong>Assignment</strong></label><input type="number" max=100 min=1  class="form-control" value="<?php echo $row['ass'];?>" name="ass" />
                                </div>
								
							  <div class="form-group">
                                    <label><strong>Activity</strong></label><input type="number" max=100 min=1  class="form-control" value="<?php echo $row['act'];?>" name="act" />
                                </div>
								
								<div class="form-group">
                                    <label><strong>Hands On Exam</strong></label><input type="number"  max=100 min=1  class="form-control" value="<?php echo $row['hoe'];?>" name="hoe" />
                                </div>
								 
                                <div class="form-group">
                                    <label><strong>Quiz</strong></label><input type="number"   max=100 min=1  class="form-control" value="<?php echo $row['quiz'];?>" name="quiz"/>
                                </div>
                                <div class="form-group">
                                    <label><strong>Project</strong></label><input type="number"  max=100 min=1  class="form-control" value="<?php echo $row['project'];?>" name="project"/>
                                </div>
                                <div class="form-group">
                                    <label><strong>Exam</strong></label><input type="number"   max=100 min=1   class="form-control" value="<?php echo $row['exam'];?>" name="exam"/>
                                </div>
								
								-->
								
								 <!--
							
                                <button type="submit" class="btn btn-success">Update Percentage Criteria</button>
                            </form>
							-->
                        </div>
                    </div>
                </div>
				
				 <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['student_point']+$row['bonus_point'].'%';?></div>
                                    <div>GRADE COMPUTATION</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                           <form action="data/gradingsystem_model.php?q=gradecompute&tid=<?php echo $_SESSION['id'];?>" method="POST">
                                   <div class="form-group">
                                    <label><strong>STUDENT</strong></label><input type="number" max=100  class="form-control" value="<?php echo $row['student_point'];?>" name="student" />
                                </div>
								
								<div class="form-group">
                                    <label><strong>BONUS</strong></label><input type="number"  max=100  class="form-control" value="<?php echo $row['bonus_point'];?>" name="bonus" />
                                </div>
								
                                 
								 
                                <button type="submit" class="btn btn-success">Update Grade Computation</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['prelim']+$row['midterm']+$row['finals'].'%';?></div>
                                    <div>TOTAL GRADE COMPUTATION</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                           <form action="data/gradingsystem_model.php?q=compute&tid=<?php echo $_SESSION['id'];?>" method="POST">
                                
								  <div class="form-group" hidden>
                                    <label><strong>PRELIM</strong></label><input type="number" max=100  class="form-control" value="<?php echo $row['prelim'];?>" name="prelim" />
                                </div>
								
								<div class="form-group">
                                    <label><strong>MIDTERM</strong></label><input type="number" max=100  class="form-control" value="<?php echo $row['midterm'];?>" name="midterm" />
                                </div>
								
                                
								 <div class="form-group">
                                    <label><strong>FINALS</strong></label><input type="number" max=100   class="form-control" value="<?php echo $row['finals'];?>" name="finals" />
                                </div>
								
								 
                                <button type="submit" class="btn btn-success">Update Total Grade Computation</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['final'];?></div>
                                    <div>FINAL</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=3&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
	
							   <div class="form-group">
                                    <label><strong>Attendance</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['att3'];?>" name="att3" />
                                </div>
								
								
								<div class="form-group">
                                    <label><strong>Assignment</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['ass3'];?>" name="ass3" />
                                </div>
							
								 <div class="form-group">
                                    <label><strong>Activity</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['act3'];?>" name="act3" />
                                </div>
								
								<div class="form-group">
                                    <label><strong>Hands On Exam</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['hoe3'];?>" name="hoe3" />
                                </div>
								
                                
                                <div class="form-group">
                                    <label><strong>Quiz</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['quiz3'];?>" name="quiz3"/>
                                </div>
                                <div class="form-group">
                                    <label><strong>Project</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['project3'];?>" name="project3"/>
                                </div>
                                <div class="form-group">
                                    <label><strong>Exam</strong></label><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['exam3'];?>" name="exam3"/>
                                </div>
                                <button type="submit" class="btn btn-success">Update Grade Percentage</button>
                            </form>
                        </div>
                    </div>
                </div>
				
				-->
            </div>
			
			    <?php endwhile; ?>
        </div>
        <!-- /.row -->        


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');