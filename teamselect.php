<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedin'])){
 header('location:login.php');
 exit;
}

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['id'];
  $teamid=$_GET['team_id'];
  $sql="Select * from `team members` where team_member_id='$username' and team_id='$teamid'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0 ){
     $showerror="Username already added";
  }else{
  $sql="INSERT INTO `team members` (`team_id`, `team_member_id`) VALUES ('$teamid', '$username')";
  $result= mysqli_query($conn,$sql);
  echo '<script>alert("User added successfully")</script>';
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
echo '<h2 class="add">Add members from here</h2><div class="container4">';
$sql="Select * from user ";
$result=mysqli_query($conn,$sql);
$no=0;
echo'<table class="table">
<thead>
<tr style="font-size:25px">
  <th   style=" margin:0px 20px;padding:0px 150px;">S.no</th>
  <th scope="col" style=" margin:0px 20px;padding:0px 150px;">Users</th>
  <th scope="col" style=" margin:0px 20px;padding:0px 150px;">Actions</th>
</tr>
</thead>
<tbody>';
while($row=mysqli_fetch_assoc($result)){
    $no++;
    echo '
    <tr>
      <th scope="row"  style=" margin:0px 20px;padding:0px 150px;">'.$no.'</th>
      <td  style=" margin:0px 20px;padding:0px 150px;">'.$row['email'].'</td>
      <form action="" method="post">
      <td  style=" margin:0px 20px;padding:0px 150px;"><input type="hidden" name="id" value="' . $row['email'] . '"><input type="submit"  class="btn-primary" name="Add" value ="Add"></td>
    </form>
    </tr>'
    ;
}

echo '</tbody></table></div><h2><a class="back" href="welcome.php">Back</a></h2>';

?>

