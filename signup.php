<?php
 include 'config.php';
 if($_SERVER["REQUEST_METHOD"]=='POST'){
     $username=$_POST['username'];
     $password=$_POST['password'];
     $cpassword=$_POST['cpassword'];
     $sql="SELECT * FROM `user` WHERE email='$username'";
     $result=mysqli_query($conn,$sql);
     $num=mysqli_num_rows($result);
     if($num>0){
      $showerr="Username already exists" ;
     }else{
         if($cpassword==$password){
           $hash=password_hash($password,PASSWORD_DEFAULT);
           $sql1=" INSERT INTO `user` ( `email`, `password`, `time`) VALUES ( '$username', '$hash', current_timestamp()) ";
           $result1=mysqli_query($conn,$sql1);
           header('location:welcome.php');
         }else{
             $showtext="Password should match";
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
<div class="container1">
<h2 class="h2">Please Signup here</h2>

<form action="" method="post">
  <div class="mb-3">
    <label for="Username" class="form-label">Username</label>
    <input type="email" class="form-control" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" name="cpassword" class="form-control">
  </div>

  <button type="submit" class="btn-primary">Submit</button>
</form>
</div>
</body>
</html>