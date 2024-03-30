<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/stylee.css" />


</head>

</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
        and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
        <h1>Username/password is incorrect.<br>Click here to<br><a href='login.php'><h1 Style='color: white'> Login</h1></a></h1>
        </div>";
	}
    }else{
?>
<div class="container">
    <div class="form-container" id="login-form">
      <h1>Login</h1>
      <form action="" method="post" name="login">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <br>
      
<!-- <center>
      <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
  </div>
</div>
    </center> -->

<br><br>
      <input name="submit" type="submit" value="Login" />
      </form>
      <p>Don't have an account? <a href="registration.php" id="signup-link">Sign up</a></p>
    </div>
  </div>
<?php } ?>



</body>
</html>