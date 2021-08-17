<?php
include 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];
   $sql="Select * from user where email='$username'";
   $result=mysqli_query($conn,$sql);
   $login=true;
   if(mysqli_num_rows($result)==1){

    while($row=mysqli_fetch_assoc($result)){

      if(password_verify($password,$row['password'])){
        $login=false;
      }
    }
  }
    if(!$login){
    session_start();
    $_SESSION['username']=$username;
    $_SESSION['loggedin']=true;

    header("location:welcome.php");
    }
   
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" media="screen and (max-width:690px)" href="phone.css">
    <title>Hello, world!</title>
  </head>
  <body>

<?php  include 'header.php'?>
<div class="container1">
  <h2 class="h2">Please login here</h2>
<form action="" method="post">
  <div class="mb-3">
    <label for="Username" class="form-label">Username</label>
    <input type="email" class="form-control" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <button type="submit" class=" btn-primary">Submit</button>
</form>
</div>
</body>
</html>