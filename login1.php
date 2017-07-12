<!DOCTYPE html>
<html lang="en">
<?php
	if(isset($_POST['uname'])){
		echo "<script>console.log('".$_POST['uname']."')</script>";
	}
	else{
		echo "<script>console.log('not set')</script>";
	}
	$username= $_POST['uname'];
	$password= $_POST['password'];
	echo "<script>console.log('"+$_POST['uname']+"')</script>";
	$con = mysqli_connect('localhost','root','root','stock_market');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT i.investor_id, email_id, first_name, last_name, password FROM investor i, investor_logon il where i.investor_id = il.investor_id and email_id='".$username."' and password=password('".$password."')");
	
	echo "<script>console.log('before querying')</script>";
	if($result->num_rows!=0){
		$rows = mysqli_fetch_array($result);
		session_start();
		echo "<script>console.log('found')</script>";
		$_SESSION['fname']=$rows['first_name'];
		$_SESSION['investor_id']=$rows['investor_id'];
		
		echo "<script>console.log('". $_SESSION['fname']."')</script>";
		mysqli_close($con);
		header('Location: ./home.php');
	}else{
		echo "<script>console.log('didnt find rows')</script>";
		mysqli_close($con);
		#session_start();
		#$_SESSION["status"] = "login failed";		
		header('Location: ./login.php?vals=login failed');
	}
?>