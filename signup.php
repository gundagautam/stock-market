<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/validate.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<title>Stock Market Login Page</title>
</head>
<body>
<p class="topnav w3-ul">
  <a class="active" href="#home"><i class="material-icons">home</i>Market Watch</a>
  <a href="#orders">Order book</a>
  <input type="text" id="search" name="search" placeholder="Search.."> </input>
  
  <a href="./login.php" id = "user"><i class="material-icons">person</i> Log In</a>
</p>
	<form  action="./signup1.php" method="post" id="signup">
	 <table>
	  <tr>
		<td><b>*Email ID:</b></td>
		<td><input type="text" id="email" name="email" /></td>
	  </tr>
	  <tr>
		<td><b>*Password:</b></td>
		<td><input type="password" id="password" name="password" /></td>
	  </tr>
	  <tr>
		<td><b>*Confirm Password:</b></td>
		<td><input type="password" id="confirmPass" name="confirmPass" /></td>
	  </tr>
	  </table>
	  <table id = "second">
	  <tr>
		<td><b>*First Name:</b></td>
		<td><input type="text" id="fname" name="fname" /></td>
	  </tr>
	  <tr>
		<td><b>*Last Name:</b></td>
		<td><input type="text" id="lname" name="lname" /></td>
	  </tr>
	  <tr>
		<td><b>*Address:</b></td>
		<td><input type="text" id="add" name="add" /></td>
	  </tr>
	  <tr>
		<td><b>City:</b></td>
		<td><input type="text" id="city" name="city" /></td>
	  </tr>
	  <tr>
		<td><b>County:</b></td>
		<td><input type="text" id="county" name="county" /></td>
	  </tr>
	  <tr>
		<td><b>State:</b></td>
		<td><input type="text" id="state" name="state" /></td>
	  </tr>
	  <tr>
		<td><b>Country:</b></td>
		<td><input type="text" id="country" name="country" /></td>
	  </tr>
	  <tr>
		<td><b>Postal:</b></td>
		<td><input type="text" id="postal" name="postal" /></td>
	  </tr>
	  <tr>
		<td><b>*Phone Number:</b></td>
		<td><input type="text" id="phone" name="phone" /></td>
	  </tr>
	  <tr>
		<td></td>
		<td><input type="submit" id="signupbtn" class="signupbtn" value = "Sign Up" /></td>
	  </tr>
	</table> 
	</form>
	<script>
		$(document).ready(function(){
			$("#signup").submit(function(){
				if($("#add").val().length==0 || $("#email").val().length==0 || $("#password").val().length==0 ||$("#confirmPass").val().length==0||$("#fname").val().length==0 || $("#lname").val().length==0 ||$("#phone").val().length==0){
					alert("Mandatory fields should not be empty. Please check again.");
					return false;
				}
				
			});
		}); 
	</script>
</body>
</html>
