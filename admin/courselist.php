<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/course_model.php');
    
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $course = $course->getcourse($search);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>COURSE'S LIST</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Course's List
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="courselist.php" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search Course...">
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                          
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcourse"><i class="fa fa-user"></i> Add Course</button>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row -->
        <hr />   
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='added'){
                            $class='success';   
                        }else if($r=='updated'){
                            $class='info';   
                        }else if($r=='deleted'){
                            $class='danger';   
                        }else if($r=='added an account'){
                            $class='success';   
                        }else if($r=='has already an account'){
                            $class='info';   
                        }else{
                            $class='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $class?> <?php echo $classs; ?>">
                        <strong>Course successfully <?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>   
                                <th>Course</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysql_fetch_array($course)): ?>                            
                                <tr>
                                    <td><?php echo $c;?></td>
                                    <td><?php echo $row['name'];?></td> 
                                    <td class="text-center">
									 <a href="edit.php?type=course&id=<?php echo $row['id']?>" title="Update Course"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                 
                                       <a href="data/course_model.php?q=deletecourse&id=<?php echo $row['id']?>" title="Remove"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                </tr>
                            <?php $c++; ?>
                            <?php endwhile; ?>
                            <?php if(mysql_num_rows($course) < 1): ?>
                                <tr>
                                    <td colspan="5" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                </tr>
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