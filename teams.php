<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_SESSION['username'];
    $teamName=$_POST['teamname'];
    $sql="INSERT INTO `teams` (`admin_username`, `team_name`, `create_time`) VALUES ( '$username', '$teamName ', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    $sql1="Select * from teams where team_name='$teamName'";
    $result1=mysqli_query($conn,$sql1);
    $row=mysqli_fetch_assoc($result1);
   $teamid=$row['id'];
$sql2="INSERT INTO `team members` (`team_id`, `team_member_id`) VALUES ('$teamid', '$username')";
$result2=mysqli_query($conn,$sql2);
    header("location:teamselect.php?team_id=".$row['id']);
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" media="screen and (max-width:690px)" href="phone.css">
    
    <link rel="stylesheet" href="styles.css">
    <title>Hello, world!</title>
  </head>
  <body>
   

<?php  include 'header.php'?>

<form action="" method="post">
<div class="mb-3">
    <label for="Team Name" class="form-label">Enter Team Name</label>
    <input type="text" class="form-control" name="teamname">
  </div>

  <button type="submit" class="btn-primary">Submit</button>
 
</form>
