<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
}
$teamid=$_GET['team_id'];
if($_SERVER['REQUEST_METHOD']=='POST'){ 
  $username=$_SESSION['username'];
  $pollNos=$_POST['pollNo'];
  $polltitle=$_POST['poll_title'];
 $sql="INSERT INTO `poll` ( `admin_username`, `currenttime`, `poll_nos`, `poll_title`,`poll_check`,`team_id`) VALUES ('$username', current_timestamp(), '$pollNos', '$polltitle','0',$teamid)";
  $result=mysqli_query($conn,$sql);
  $sql1="Select * from poll where poll_title='$polltitle'";
  $result1=mysqli_query($conn,$sql1);
  $row=mysqli_fetch_assoc($result1);
  $id=$row['id'];
  $sql2="Select * from `team members` where team_id='$teamid'";
  $result2=mysqli_query($conn,$sql2);
  while($rows=mysqli_fetch_assoc($result2)){
    $username1=$rows['team_member_id'];
  $sql3="INSERT INTO `poll check` (`poll_id`, `username`, `poll_bool`) VALUES ( '$id', '$username1', '0')";
  $result3=mysqli_query($conn,$sql3);
  }
  header("location:poll.php?team_id=".$teamid."&poll_id=".$id);
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
  <div class="mb-3">
    <label for="PollNo" class="form-label">Enter no of options</label>
    <input type="text" class="form-control" name="pollNo">
  </div>

  <div class="mb-3">
    <label for="PollNo" class="form-label">Enter query of poll</label>
    <input type="text" class="form-control" name="poll_title">
  </div>
  <button type="submit" class="btn-primary">Submit</button>
</form>




