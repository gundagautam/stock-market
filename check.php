<?php
	session_start();
	$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$sql = mysqli_query($con,"SELECT email FROM investor where email='".$_POST['value']."'");
		
	if($sql->num_rows!=0){
		echo "User Already exists";
	}
	mysqli_close($con);
?>
