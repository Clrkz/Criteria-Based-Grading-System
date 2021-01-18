<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/student_model.php');
    include('data/criteria_model.php'); 
    $classid = isset($_GET['classid']) ? $_GET['classid']:null;    
    $studid = isset($_GET['studid']) ? $_GET['studid']:null;    
    $studentgrade = $student->getstudentgrade($studid,$classid);
    $mystudent = $student->getstudentbyid($studid);
	$criterialist = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialist1 = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
	$criterialist2 = $selectedcriteria->getcriterialistgradingsystem($_SESSION['id']); 
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Grade Computations</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="subject.php">My Class</a>
                    </li>
                    <li>
                        <a href="student.php?classid=<?php echo $classid?>">Masterlist</a>
                    </li>
                    <li class="active">
					 <?php foreach($mystudent as $row1): ?>
                       <?php echo $row1['studid'];?> Grade
					     <?php endforeach;?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

       <div class="row">
            <div class="col-lg-12">
                 <?php if(isset($_GET['status'])): ?>
                    <?php if($_GET['status'] == 1): ?>
                        <div class="alert alert-success">
                            <strong>Done!</strong>
                        </div>
                    <?php endif; ?>
                <?php endif;?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-primary">
                            <td><strong>Student ID</strong></td>
                            <td><strong>Fullname</strong></td>
							<!--
                            <td><strong>Prelim</strong></td>
							-->
                            <td><strong>Midterm</strong></td>
                            <td><strong>Final</strong></td>
                            <td><strong>TOTAL GRADE</strong></td>
                            <td><strong>EQUIVALENT</strong></td>
                        </tr>
                        <?php foreach($mystudent as $row): ?>
                        <tr class="bg-info">
                            <td><?php echo $row['studid'];?></td>
                            <td><?php echo $row['lname'].', '.$row['fname'];?></td>
							<!--
                            <td><?php echo $studentgrade['prelim'];?></td>
							-->
                            <td><?php echo $studentgrade['midterm'];?></td>
                            <td><?php echo $studentgrade['final'];?></td>
                            <td><?php echo $studentgrade['total'];?></td>
                            <td><?php echo $studentgrade['eqtotal'];?></td>
                        </tr>
                        <?php endforeach;?>
                        
                    </table>                    
                </div>    
<!--				
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['prelim'];?></div>
                                    <div>PRELIM</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=1&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
							
							
							 
							 <?php $c=0; ?>
							 <?php while($row2 = mysql_fetch_array($criterialist)): ?>
                              <div class="form-group">
                                    <label><strong><?php echo ucfirst($row2['criteria']);?></strong></label><input type="number" readonly  min=50 max=100 class="form-control" value="<?php echo number_format($studentgrade['prelim_'.$row2['criteria']],2);?>" name="" />
                                </div>
   <?php $c++; ?>
							 <?php endwhile; ?> 
							<?php if($c <= 0 ): ?>
							<div class="text-center">  <label ><strong>NO CRITERIA <a href="gradingsystem.php" >CLICK HERE</a> TO ADD</strong></label>   </div>
							<?php endif; ?>
							
							 
                            </form>
                        </div>
                    </div>
                </div>
				-->
                
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['midterm'];?></div>
                                    <div>MIDTERM</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=2&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
                               
							 
							 <?php $c=0; ?>
							 <?php while($row3 = mysql_fetch_array($criterialist1)): ?>
                              <div class="form-group">
                                    <label><strong><?php echo ucfirst($row3['criteria']);?></strong></label><input type="number" readonly  min=50 max=100 class="form-control" value="<?php echo number_format($studentgrade['midterm_'.$row3['criteria']],2);?>" name="" />
                                </div>
   <?php $c++; ?>
							 <?php endwhile; ?> 
							<?php if($c <= 0 ): ?>
							<div class="text-center">  <label ><strong>NO CRITERIA <a href="gradingsystem.php" >CLICK HERE</a> TO ADD</strong></label>   </div>
							<?php endif; ?>
							
							
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['final'];?></div>
                                    <div>FINAL</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=3&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
	 
							 <?php $c=0; ?>
							 <?php while($row4 = mysql_fetch_array($criterialist2)): ?>
                              <div class="form-group">
                                    <label><strong><?php echo ucfirst($row4['criteria']);?></strong></label><input type="number" readonly  min=50 max=100 class="form-control" value="<?php echo number_format($studentgrade['finals_'.$row4['criteria']],2);?>" name="" />
                                </div>
   <?php $c++; ?>
							 <?php endwhile; ?> 
							<?php if($c <= 0 ): ?>
							<div class="text-center">  <label ><strong>NO CRITERIA <a href="gradingsystem.php" >CLICK HERE</a> TO ADD</strong></label>   </div>
							<?php endif; ?>
							
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->        


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');