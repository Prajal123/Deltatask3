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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="screen and (max-width:690px)" href="phone.css">
     <link rel="stylesheet" href="styles.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <?php  include 'header.php' ?>

<?php
$teamid=$_GET['team_id'];
$pollid=$_GET['poll_id'];
$sql="Select * from `poll options` where poll_id='$pollid'";
$result=mysqli_query($conn,$sql);
echo'<h2 class="add" style="margin:0px 100px">Results</h2><div class="container4"><table class="table">
<thead>
<tr style="font-size:25px">
  <th   style=" margin:0px 20px;padding:0px 150px;">S.no</th>
  <th scope="col" style=" margin:0px 20px;padding:0px 150px;">Users</th>
  <th scope="col" style=" margin:0px 20px;padding:0px 150px;">Actions</th>
</tr>
</thead>
<tbody>';
$no=0;
while($row=mysqli_fetch_assoc($result)){
    $no++;
    echo '
    <tr>
    <th scope="row"  style=" margin:18px 20px;padding:0px 150px;">'.$no.'</th>
    <td  style=" margin:0px 20px;padding:18px 150px;">'.$row['option'].'</td>
    <td  style=" margin:0px 20px;padding:18px 150px;">'.$row['Votes'].'</td>
    </tr>'
    ;
}

echo '</tbody></table></div><h2><a class="btn-primary mx-4" href="teamdashboard.php?team_id='.$teamid.'">Back</a></h2>';

?>
  
  </body>
</html>