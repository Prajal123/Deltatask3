<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
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

 <a class="primary" href="teams.php" >Create team</a>
 

<?php

$username=$_SESSION['username'];
$sql= "Select * from `team members` where team_member_id='$username'";
$result=mysqli_query($conn,$sql);
echo ' <div class=container2>';
while($rows=mysqli_fetch_assoc($result)){
    $teamid=$rows['team_id'];
    $sql1= "Select * from teams where id='$teamid'";
    $result1=mysqli_query($conn,$sql1);
    $rows1=mysqli_fetch_assoc($result1);
  echo'
    <div class="container3">
    <h2 class="card-title">'.$rows1['team_name'].'</h2>
    <a href="teamdashboard.php?team_id='.$rows['team_id'].'"class="btn-primary ">Go to team</a>
  </div>
';
}
echo '</div>';

?>