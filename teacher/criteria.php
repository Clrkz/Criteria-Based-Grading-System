<?php
    include('include/header.php');
    include('include/sidebar.php'); 
    include('data/criteria_model.php'); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;   
    $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null;   
    $term = isset($_GET['term']) ? $_GET['term'] : null;   
	$type = $selectedcriteria->getcriteriabyclass($classid,$criteria,$term); 
	$criterialist = $selectedcriteria->getcriterialist($_SESSION['id']); 
	 $counter = 0;
    
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> 
                    <?php if( $criteria == 'select'): ?>
                    <small><?php echo strtoupper($criteria).' CRITERIA' ;?></small>
                    <?php endif; ?>
					
                   <?php if( $criteria != 'select'): ?>
                    <small><?php echo strtoupper($term).' '.strtoupper($criteria);?></small>
                    <?php endif; ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="student.php?classid=<?php echo $classid;?>">My Class</a>
                    </li>
                    <li class="active">
                        <?php echo ucfirst($criteria);?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="student.php?classid=<?php echo $classid?>" method="post">
					 
					<?php if($criteria != 'select'): ?>
							 <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#addrecord" ><i   ></i> Add  <?php echo ucfirst($criteria);?></button> 
					 <?php endif; ?>
							
                      
						 <a href="student.php?classid=<?php echo $classid;?>" class="btn btn-primary"><i class="fa fa-user"  ></i> Student Masterlist</a> 
						 
						   <?php while($row = mysql_fetch_array($criterialist)): ?>
						   <a href="criteria.php?classid=<?php echo $classid;?>&criteria=<?php echo $row['criteria'];?>&term=<?php echo $term; ?>" class="btn btn-primary"><?php echo ucfirst($row['criteria']);?></a> 
							
							<?php $counter++; ?>
							<?php endwhile; ?> 
							   <?php if( $counter <= 0): ?>
							<strong>NO CRITERIA <a href="gradingsystem.php" >CLICK HERE</a> TO ADD</strong> 
                    <?php endif; ?>
							
							
						 <!--
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=attendance&term=<?php echo $term; ?>" class="btn btn-primary">Attendance</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=assignment&term=<?php echo $term; ?>" class="btn btn-primary">Assignment</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=activity&term=<?php echo $term; ?>" class="btn btn-primary">Activity</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=handsonexam&term=<?php echo $term; ?>" class="btn btn-primary">HandsOnExam</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=quiz&term=<?php echo $term; ?>" class="btn btn-primary">Quiz</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=project&term=<?php echo $term; ?>" class="btn btn-primary">Project</a> 
						 <a href="criteria.php?classid=<?php echo $classid;?>&criteria=exam&term=<?php echo $term; ?>" class="btn btn-primary">Exam</a> 
						 -->
					  </form>
                </div>
            </div>
        </div>
        <hr />
		
                   <?php if( $criteria != 'select'): ?>
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
						
                    <?php $c2=0; ?>
                    <?php $c=1; ?>
					 
					  <?php while($row = mysql_fetch_array($type)): ?>
                        <tr>
                            <td><?php echo $c; ?></td>    
                            <td class="text-center"><?php echo $row['name']; ?></td>    
                            <td class="text-center"><?php echo $row['total']; ?></td>  
                         
                             <td class="text-center"> <a href="criteriaclass.php?id=<?php echo $row['id']?>&classid=<?php echo $classid;?>&criterianame=<?php echo $row['name']; ?>&criteria=<?php echo $criteria;?>&maxscore=<?php echo $row['total']; ?>&term=<?php echo $term;?>" class="btn btn-primary">Students</a> </td>    
							<td class="text-center">           
							
                                        <a href="edit.php?type=criteria&id=<?php echo $row['id']?>&classid=<?php echo  $classid; ?>&criteria=<?php echo $criteria;?>&term=<?php echo $term;?>" title=""><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/criteria_model.php?q=deletecriteria&table=criteria&id=<?php echo $row['id']?>&classid=<?php echo  $classid; ?>&criteria=<?php echo $criteria;?>&term=<?php echo $term;?>" title=""><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a>
										</td>
                               
                        </tr>
                    <?php $c++; ?>
                    <?php $c2++; ?>
                                    <?php endwhile; ?>
					
                   <?php if( $c2 <= 0): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody> 
                    </table>
                </div>        
            </div>
        </div>
		<?php endif; ?>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>