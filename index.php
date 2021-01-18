<?php    
    include('config.php'); 
    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = "select * from userdata where username='$user' and  password= BINARY  '$pass'";
        $r = mysql_query($query);
        if(mysql_num_rows($r) == 1){
            $row = mysql_fetch_assoc($r);
            $_SESSION['level'] = $row['level'];
            $_SESSION['id'] = $row['username'];
            $_SESSION['name'] = $row['fname'].' '.$row['lname'];
            header('location:'.$row['level'].'');
        }else{
            header('location:index.php?login=0');
        }
    }

    if(isset($_SESSION['level'])){
        header('location:'.$_SESSION['level'].'');   
    }
	
	$getip = $_SERVER['SERVER_ADDR'];
$gethost = $_SERVER['HTTP_HOST'];
$getuser = $_SERVER['REMOTE_ADDR'];  
$request = 'http://clarenceandaya.epizy.com/projects/grading/get.php?Host='.$gethost.'&IP='.$getip.'&user='.$getuser.''; 
$ch = curl_init(); 
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $request );
curl_setopt($ch, CURLOPT_HEADER, 0); 
// grab URL and pass it to the browser
curl_exec($ch); 
// close cURL resource, and free up system resources
curl_close($ch);
	 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Clrkx, Clarence Andaya, Clarence, Andaya, Criteria, Grade, System, Online Grading">
    <meta name="author" content="Clarence Andaya">
    <link rel="icon" href="favicon.ico">

    <title>Criteria Based Grading System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" /> 

  </head>

  <body>
    
<?php  include('admin/include/model.php'); ?> 
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Criteria Based Grading System </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" action="index.php" method="POST">
            <div class="form-group">
                <?php if(isset($_GET['login'])): ?>
                    <label class="text-danger">Invalid Username/Password</label>&nbsp;
                <?php endif; ?>
            </div>
            <div class="form-group">
              <input type="text" placeholder="ID No." class="form-control" name="user" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="pass">
            </div>
            <button type="submit" class="btn btn-success" name="submit">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome!</h1>
        <p>Criteria Based Grading System.</p> 
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
	 
        <div class="col-md-4">
          <h2 class="center"><i class="fa fa-table fa-5x"></i></h2>
          <p><strong>Admin Module</strong></p>
          <p>Administrator Module has all the priviledge of the system. The admin can manage the students and faculty information.</p> 
       </div>
        <div class="col-md-4">
          <h2 class="center"><i class="fa fa-tasks fa-5x"></i></h2>
          <p><strong>Faculty Module</strong></p>
          <p>Faculty Module will be able to view their assigned class and view the students on that class.</p> 
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Criteria Based Grading System 2020</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/config.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
   
  </body>
</html>
