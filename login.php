<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/search.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/validate.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<title>Stock Market Login Page</title>
</head>
<body>
<p class="topnav w3-ul">
  <a class="active" href="home.php"><i class="material-icons">home</i>Market Watch</a>
  <a href="orders.php">Order book</a>
  <input type="text" id="search" name="search" placeholder="Search.."> </input>
  
  <a href="./login.php" id = "user"><i class="material-icons">person</i> Log In</a>
</p>
	<form  action="./login1.php" method="post" id="login">
	 <table>
	  <tr>
		<td><b>Email:</b></td>
		<td><input type="text" id = "emailID" name="uname" /></td>
	  </tr>
	  <tr>
		<td><b>Password:</b></td>
		<td><input type="password" name="password" id="pwd"/></td>
	  </tr>
	  <tr>
		<td></td>
		<?php
		if(isset($_GET['vals']))
		 echo "<script> alert('".$_GET['vals']."');</script>";
		?>
		<td><input type="submit" class="loginbtn" value = "Login" /></td>
	  </tr>
	  <tr>
	  <td></td>
		<td><a href="signup.php" ><input type="button" class="signupbtn" value = "Sign Up" /></a></td>
	  </tr>
	 </table> 
	</form>
	<script>
		$(document).ready(function(){
			$("#login").submit(function(){
				if($("#emailID").val().length==0 || $("#pwd").val().length==0){
					alert("Fields should not be empty");
					return false;
				}
				
			});
		}); 
	</script>
</body>
</html>
