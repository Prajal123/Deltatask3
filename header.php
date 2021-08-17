<div class="container">
 <nav class="navbar">
   <ul>
    <?php 
    if(!$_SESSION['loggedin']){
    echo' <li><a class="home" href="#">Home</a></li>
    <li><a class="signup" href="signup.php">Signup</a></li>
     <li><a class="login" href="login.php">Login</a></li></ul>';
    }else{
    echo  '<li><a class="home" href="#">Home</a></li>
     <li><a class="username" href="welcome.php">'.$_SESSION['username'].'</a></li>
     <li><a class="logout" href="logout.php">Logout</a></li></ul>';
    }
   ?>
 </nav>

 <form action="">
   <input type="text" name="Search bar" class="text" placeholder="Search Bar">
   <button class="btn">Search</button>
 </form>
</div>