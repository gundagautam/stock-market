<!DOCTYPE html>
<html lang="en">
<?php
	if(isset($_POST['uname'])){
		echo "<script>console.log('".$_POST['uname']."')</script>";
	}
	else{
		echo "<script>console.log('not set')</script>";
	}
	$fname= $_POST['fname'];
	$lname= $_POST['lname'];
	$email= $_POST['email'];
	$password= $_POST['password'];
	$add= $_POST['add'];
	$city= $_POST['city'];
	$county= $_POST['county'];
	$state= $_POST['state'];
	$country= $_POST['country'];
	$postal= $_POST['postal'];
	$phone= $_POST['phone'];
	echo "<script>console.log('"+$_POST['uname']+"')</script>";
	$con = mysqli_connect('localhost','root','root','stock_market');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$sql = "INSERT INTO investor (first_name,last_name,address,city,county,state,country,postal,phone,email) VALUES ('".$fname."','".$lname."','".$add."','".$city."','".$county."','".$state."','".$country."',".$postal.",'".$phone."','".$email."')";
		
		$getID = "select investor_id from investor where email ='".$email."'";
		$query = mysqli_query($con,$getID);

		$row = mysqli_fetch_array($query);

		$id = $row['investor_id'];
		
		$sql2 = "INSERT INTO investor_logon VALUES ('".$id."','".$email."',password('".$password."'),'active',sysdate(),sysdate())";
		

	if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
		#echo "New records created successfully";
		header('Location: ./login.php?vals=User created ');
	} else {
		echo "Error: " . $sql . " " . mysqli_error($con);
	}

	mysqli_close($con);
?>