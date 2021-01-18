<?php     
    include('config.php');
    $act = $_SESSION['id'].' logged out.';
    $date = date('m-d-Y h:i:s A');
    mysql_query("INSERT INTO log(date, activity) VALUES ('$date','$act')");
    session_destroy();
    header('location:index.php');
?>