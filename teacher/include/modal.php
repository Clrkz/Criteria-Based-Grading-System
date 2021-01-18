 <?php
 $classid = isset($_GET['classid']) ? $_GET['classid'] : null;   
 $term = isset($_GET['term']) ? $_GET['term'] : null;    
 $criteria = isset($_GET['term']) ? $_GET['criteria'] : null;    
 ?>
<!-- add modal for student -->
<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add Student to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/student_model.php?q=addstudent&classid=<?php echo $classid?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="studid" placeholder="student ID" required />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" required />
                </div>
				<div class="form-group">
                    <input type="text" class="form-control" name="mname" placeholder="middlename" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" required />
                </div>
				<div class="form-group">
                    <input type="text" class="form-control" name="xname" placeholder="extension name" />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>



<!-- add modal for subject -->
<div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Subject</h3>
        </div>
        <div class="modal-body">
            <form action="data/data_model.php?q=addsubject&teacherid=<?php echo $id; ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="code" placeholder="Subject Code"  required/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Subject Title" required/>
                </div>
                <div class="form-group">
                    <input type="number" min="1" max="5" class="form-control" name="unit" placeholder='No. of units' required />
                </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- add modal for class info -->
<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Class Info</h3>
        </div>
        <div class="modal-body">
            <form action="data/class_model.php?q=addclass&teacherid=<?php echo $id; ?>" method="post">
                <div class="form-group">  
                    <select name="subject" class="form-control" required>
                        <option value="">Select Subject...</option>
                    <?php 
                        $r = mysql_query("select * from subject where teacherid = $id and status=1");
                        while($row = mysql_fetch_array($r)):
                    ?>
                        <option value="<?php echo $row['code']; ?>"><?php echo $row['code']; ?> - (<?php echo $row['title']; ?>)</option>
                    <?php endwhile; ?>
                    </select>
                </div>
				 <div class="form-group">  
                    <select name="course" class="form-control" required>
                        <option value="">Select Course...</option>
                    <?php 
                        $r = mysql_query("select * from course where status = 1");
                        while($row = mysql_fetch_array($r)):
                    ?>
                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
			 
                <div class="form-group">
                    <select name="year" class="form-control" required>
                        <option value="">Select Year...</option>
                        <option>I</option>
                        <option>II</option>
                        <option>III</option>
                        <option>IV</option>
                        <option>V</option>
                    </select>
                </div>
					 <div class="form-group">  
                    <select name="section" class="form-control" required>
                        <option value="">Select Section...</option>
                    <?php 
                        $r = mysql_query("select * from section where status = 1 ");
                        while($row = mysql_fetch_array($r)):
                    ?>
                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
				 
                <div class="form-group">
                    <select name="sem" class="form-control" required>
                        <option value="">Select Semester...</option>
                        <option>1st</option>
                        <option>2nd</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <select name="sy" class="form-control" required>
                        <option value="">Select S.Y.</option>
                        <?php $year = date('Y'); ?>
                        <?php for($c=10; $c > 0; $c--): ?>
                        <option><?php echo $year; ?>-<?php echo $year+1?></option>
                        <?php $year--; ?>
                        <?php endfor; ?>
                    </select>
                </div>
				
                <div class="form-group">
                    <input type="text" class="form-control" name="room" placeholder="Room" required/>
                </div>
				
                <div class="form-group">
                    <input type="text" class="form-control" name="day" placeholder="Day" required/>
                </div>
				
                <div class="form-group">
                    <input type="text" class="form-control" name="time" placeholder="Time" required/>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>




<!-- add modal for quiz -->
<div class="modal fade" id="addquiz" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add quiz to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=quiz&term=<?php echo $term; ?>" method="post">
			 <div class="form-group">
                   
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for attendance -->
<div class="modal fade" id="addattendance" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add attendance to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=attendance&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Date" value="<?php echo date("m/d/Y");?>" required />
                </div>
                <div class="form-group" hidden>
                    <input type="number" class="form-control" max=1 name="total" placeholder="Total" value="1"  required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- add modal for assignment -->
<div class="modal fade" id="addassignment" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add assignment to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=assignment&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>



<!-- add modal for handsonexam -->
<div class="modal fade" id="addhandsonexam" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add handsonexam to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=handsonexam&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>



<!-- add modal for activity -->
<div class="modal fade" id="addactivity" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add activity to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=activity&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- add modal for project -->
<div class="modal fade" id="addproject" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add project to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=project&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>



<!-- add modal for exam -->
<div class="modal fade" id="addexam" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add exam to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=exam&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- add modal for exam -->
<div class="modal fade" id="addrecord" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa fa-user"></i> Add <?php echo  $criteria; ?> to this class</h4>
        </div>
        <div class="modal-body">
            <form action="data/criteria_model.php?q=addcriteria&classid=<?php echo $classid; ?>&criteria=<?php echo  $criteria; ?>&term=<?php echo $term; ?>" method="post">
			 
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required />
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="total" placeholder="Total" required />
                </div>
				 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

