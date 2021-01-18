<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/subject_model.php');
 include('include/modal.php'); 
    $firstsem = $subject->getsubject('1st',$id);    
    $secondsem = $subject->getsubject('2nd',$id);    
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>MY CLASSES</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        My Class
                    </li>
                </ol>
            </div>
        </div>
		       <!-- /.row -->
			   <!--
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="class.php" method="post">                              
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addclass">Add Class</button>
                    </form>
                </div>
            </div>
        </div>
		<br>
		-->
        <!--/.row -->
		  <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='added'){
                            $classs='success';   
                        }else if($r=='updated'){
                            $classs='info';   
                        }else if($r=='deleted'){
                            $classs='danger';   
                        }else{
                            $classs='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                        <strong>Class info successfully <?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#data1" role="tab" data-toggle="tab">First Sem</a></li>
                    <li><a href="#data2" role="tab" data-toggle="tab">Second Sem</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="data1">
                        <br />
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Section</th>
                                        <th class="text-center">Room</th>
                                        <th class="text-center">Day</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Students</th> 
										<!--
                                <th class="text-center">Action</th
								-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1; ?>
                                    <?php while($row = mysql_fetch_array($firstsem)): ?>
                                        <tr>
                                            <td><?php echo $c; ?></td>
                                            <td class="text-center"><?php echo $row['subject']; ?></td>
                                            <td class="text-center"><?php echo $row['course']; ?></td>
                                            <td class="text-center"><?php echo $row['year']; ?></td>
                                            <td class="text-center"><?php echo $row['section']; ?></td>
                                            <td class="text-center"><?php echo $row['room']; ?></td>
                                            <td class="text-center"><?php echo $row['day']; ?></td>
                                            <td class="text-center"><?php echo $row['time']; ?></td>
                                            <td class="text-center"><a href="student.php?classid=<?php echo $row['id'];?>">Master List</a></td> 
											<!--<td class="text-center">                                                                               
                                       <a href="edit.php?type=class&id=<?php echo $row['id']?>&teacherid=<?php echo $id;?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/data_model.php?q=deleteGlobal&table=class&id=<?php echo $row['id']?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                               -->
                                        </tr>
                                    <?php $c++; ?>
                                    <?php endwhile; ?>
                                    <?php if(mysql_num_rows($firstsem) < 1): ?>
                                        <tr><td colspan="9" class="text-center text-danger"><strong>*** EMPTY ***</strong></td></tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="data2">
                        <br />
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Section</th>
                                        <th class="text-center">Room</th>
                                        <th class="text-center">Day</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Students</th> 
										<!--
                                <th class="text-center">Action</th>
								
								-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1; ?>
                                    <?php while($row = mysql_fetch_array($secondsem)): ?>
                                        <tr>
                                            <td><?php echo $c; ?></td>
                                            <td class="text-center"><?php echo $row['subject']; ?></td>
                                            <td class="text-center"><?php echo $row['course']; ?></td>
                                            <td class="text-center"><?php echo $row['year']; ?></td>
                                            <td class="text-center"><?php echo $row['section']; ?></td>
                                            <td class="text-center"><?php echo $row['room']; ?></td>
                                            <td class="text-center"><?php echo $row['day']; ?></td>
                                            <td class="text-center"><?php echo $row['time']; ?></td>
                                            <td class="text-center"><a href="student.php?classid=<?php echo $row['id'];?>">Master List</a></td> 
                                     <!-- <td class="text-center">                                                                               
                                        <a href="edit.php?type=class&id=<?php echo $row['id']?>&teacherid=<?php echo $id;?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/data_model.php?q=deleteGlobal&table=class&id=<?php echo $row['id']?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                               -->
									  </tr>
                                    <?php $c++; ?>
                                    <?php endwhile; ?>
                                    <?php if(mysql_num_rows($secondsem) < 1): ?>
                                        <tr><td colspan="9" class="text-center text-danger"><strong>*** EMPTY ***</strong></td></tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
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