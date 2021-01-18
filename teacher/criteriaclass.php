<?php
    include('include/header.php');
    include('include/sidebar.php'); 
    include('data/criteria_model.php'); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;   
    $criteria = isset($_GET['criteria']) ? $_GET['criteria'] : null;   
    $term = isset($_GET['term']) ? $_GET['term'] : null;   
    $criteria_id = isset($_GET['id']) ? $_GET['id'] : null;   
    $criteria_name = isset($_GET['criterianame']) ? $_GET['criterianame'] : null;    
	$type = $selectedcriteria->getstudentbycriteriaclass($classid,$criteria_id,$criteria);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small><?php echo $criteria_name; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="criteria.php?classid=<?php echo $classid;?>&criteria=<?php echo $criteria; ?>&term=<?php echo $term; ?>"><?php echo ucfirst($criteria); ?></a>
                    </li>
                    <li class="active">
                        Score
                    </li>
                </ol>
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
                                <th class="text-center">Student No.</th> 
                                <th class="text-center">Name</th> 
                                <th class="text-center">Score</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
						       
                        <tbody>
                    <?php $c=1; ?>
					 
					 <?php foreach($type as $row): ?>
					   <form action="data/criteria_model.php?q=updatecriteriascore&studentid=<?php echo $row['id']; ?>&classid=<?php echo $classid; ?>&criteriaid=<?php echo $criteria_id ;?>&criterianame=<?php echo $criteria_name ;?>&criteria=<?php echo $criteria; ?>&maxscore=<?php echo $_GET['maxscore']; ?>&term=<?php echo $_GET['term']; ?>" method="post">
                        <tr>
                            <td><?php echo $c; ?></td>    
                          <td class="text-center"><?php echo $row['studid']; ?></td>    
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname']; ?></td>  
                            <td class="text-center" width="1px">
							 <input type="number" name="score" placeholder="Score" min=0 max=<?php echo $_GET['maxscore']; ?> value="<?php echo $row['score']; ?>">
							</td>  
							  <td class="text-center"> 
							   <button type="submit" class="btn btn-primary"><i class=""></i> Update</button>
							  </td>
                          
                               
                        </tr>
						  </form>
                    <?php $c++; ?>
                    <?php endforeach; ?>
					
                    <?php if(!$type): ?>
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