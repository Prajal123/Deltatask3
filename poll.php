<?php

include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
}
$teamid=$_GET['team_id'];
$username=$_SESSION['username'];
$pollid=$_GET['poll_id'];
$sql="Select * from poll where id='$pollid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$pollNo=$row['poll_nos'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    for($i=1;$i<=$pollNo;$i++){
        $n=$_POST[$i.'option'];
   $sql="INSERT INTO `poll options` (`poll_id`, `option`, `currentTime`) VALUES ('$pollid', '$n', current_timestamp())";
   $result=mysqli_query($conn,$sql);
    }

    header('location:teamdashboard.php?team_id='.$teamid);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" media="screen and (max-width:690px)" href="phone.css">

    <link rel="stylesheet" href="styles.css">
    <title>Hello, world!</title>
  </head>
  <body> 
<?php  include 'header.php'?>


<form action="" method="post">

   <?php
     for($i=1;$i<=$pollNo;$i++){
         echo '<label for="options" class="form-label">Option'.$i.'<br></label>
         <input type="text" class="form-control" name="'.$i.'option" ><br>';  
     }
    echo '<button class="btn-primary mt-4">Submit</button>';
   ?>
</form>


