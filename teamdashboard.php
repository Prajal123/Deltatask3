<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
}
$teamid=$_GET['team_id'];
$username=$_SESSION['username'];
if($_SERVER['REQUEST_METHOD']=='POST'){
  $sql5="Select * from poll where team_id='$teamid'";
  $result5=mysqli_query($conn,$sql5);
  while($rows=mysqli_fetch_assoc($result5)){
      $id= $rows['id'];
    if(isset($_POST[$id])){
      $polloption=$_POST['option'];
      $sql6="Select * from `poll options` where option='$polloption'";
      $result6=mysqli_query($conn,$sql6);
      $row=mysqli_fetch_assoc($result6);
      $vote=$row['Votes']+1;
      $id=$row['id'];
      $pollid=$row['poll_id'];
      $sql7="UPDATE `poll options` SET `Votes` = '$vote' WHERE `poll options`.`id` = $id";
      $result7=mysqli_query($conn,$sql7);
      $sql8="UPDATE `poll check` SET `poll_bool`='1' WHERE `poll check`.`poll_id`=$pollid AND `poll check`.`username`='$username'";
      $result8=mysqli_query($conn,$sql8);

    }else if(isset($_POST[$id.'op'])){
     $sql9=" UPDATE `poll` SET `poll_check` = '1' WHERE `poll`.`id` = $id";
     $result9=mysqli_query($conn,$sql9);
    }else if(isset($_POST[$id.'rs'])){
      echo $_POST[$id.'rs'];
      header("location:pollresult.php?poll_id=".$id."&team_id=".$teamid);
    }
  }
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


<?php
$sql= "Select * from teams where id='$teamid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($row['admin_username']==$username){
    echo '<a href="pollNo.php?team_id='.$teamid.'" class="poll">Create Poll</a>';
}
$sql1="Select * from `team members` where team_id='$teamid'";
$result1=mysqli_query($conn,$sql1);
$no=1;
echo '<h1 class="member">Team members</h1>';
while($row1=mysqli_fetch_assoc($result1)){
    echo '<h3 class="members">'.$no.'.'.$row1['team_member_id'].'</h3>';
    $no++;
}
?>
<?php
$sql2="Select * from poll where team_id='$teamid'";
$result2=mysqli_query($conn,$sql2);
while($rows=mysqli_fetch_assoc($result2)){
    $id=$rows['id'];
    $i=1;
    echo '<form action="" method="post">';
    $sql3="Select * from `poll options` where poll_id='$id'";

    $result3=mysqli_query($conn,$sql3);
    echo '<div class="container6"><h1 class="mt-4">'.$rows['poll_title'].'</h1>';
    while($rows1=mysqli_fetch_assoc($result3)){
       
     echo '<input type="radio" name="option" class="radio" value="'.$rows1['option'].'" />
     <label for="radio"class="radio" >'.$rows1['option'].'</label></br>';
    }
    $i++;
    if($rows['poll_check']==0){
      $sql4="Select * from `poll check` where poll_id='$id' and username='$username'";
      $result4=mysqli_query($conn,$sql4);
      $rows2=mysqli_fetch_assoc($result4);
      if($rows2['poll_bool']==0){
    echo '<button type="submit" class="btn-primary" name="' . $rows['id'] . '">Submit</button>';
      }else{
        echo '<h2>Thanks for your response. Results will be out soon</h2>';
      }
if($rows['admin_username']==$username){
  echo'<button type="submit" class="btn-primary mx-2" name="' . $rows['id'] . 'op">End Poll</button>';
}
    }else{
      echo '<button type="submit" class="btn-primary" name="' . $rows['id'] . 'rs">Results</button>';
    }
echo '</form></div>';
}
  

?>