<?php
    include('include/header.php');
    include('include/sidebar.php'); 
    include('data/criteria_model.php'); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;   
    $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null;   
	if($criteria=='quiz'){
		$mystudent = $criteria->getquizbyclass($classid); 
	}
    
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>CRITERIA</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="student.php?classid=<?php echo $classid;?>">My Class</a>
                    </li>
                    <li class="active">
                        Quiz
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="student.php?classid=<?php echo $classid?>" method="post">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addquiz" ><i   ></i> Add Quiz</button>
						 <a href="student.php?classid=<?php echo $classid;?>" class="btn btn-primary"><i class="fa fa-user"  ></i> Student Masterlist</a> 
						  <a href="attendance.php?classid=<?php echo $classid;?>" class="btn btn-primary">Attendance</a> 
						 <a href="assignment.php?classid=<?php echo $classid;?>" class="btn btn-primary">Assignment</a> 
						 <a href="activity.php?classid=<?php echo $classid;?>" class="btn btn-primary">Activity</a> 
						 <a href="hoe.php?classid=<?php echo $classid;?>" class="btn btn-primary">HandsOnExam</a> 
						 <a href="quiz.php?classid=<?php echo $classid;?>" class="btn btn-primary">Quiz</a> 
						 <a href="project.php?classid=<?php echo $classid;?>" class="btn btn-primary">Project</a> 
						 <a href="exam.php?classid=<?php echo $classid;?>" class="btn btn-primary">Exam</a> 
					  </form>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">                

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Total</th> 
                                <th class="text-center">Score</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
						       
                        <tbody>
                    <?php $c=1; ?>
					 
					  <?php while($row = mysql_fetch_array($mystudent)): ?>
                        <tr>
                            <td><?php echo $c; ?></td>    
                            <td class="text-center"><?php echo $row['name']; ?></td>    
                            <td class="text-center"><?php echo $row['total']; ?></td>  
                         
                             <td class="text-center"> <a href="quizclass.php?id=<?php echo $row['id']?>&classid=<?php echo $classid;?>&quizname=<?php echo $row['name']; ?>" class="btn btn-primary">Students</a> </td>    
							<td class="text-center">                                                                               
                                        <a href="edit.php?type=quiz&id=<?php echo $row['id']?>&classid=<?php echo  $classid; ?>" title="update quiz"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/data_model.php?q=deleteGlobal&table=quiz&id=<?php echo $row['id']?>&classid=<?php echo  $classid; ?>" title="delete quiz"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a>
										</td>
                               
                        </tr>
                    <?php $c++; ?>
                                    <?php endwhile; ?>
					
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody> 
                    </table>
                </div>        
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>