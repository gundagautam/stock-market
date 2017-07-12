<?php
	session_start();
	$count=1;
	if(isset($_SESSION["dataset_name"+$count])){
		if($_SESSION["dataset_name"+$count]==$_POST['code']){
			unset($_SESSION["dataset_name"+$count]);
		}
	}
	
	$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$sql = "DELETE FROM market_watch where dataset_name like '%(".$_POST['code'].")'";

	if (mysqli_query($con, $sql)) {
		echo "Record deleted successfully";
	} else {
		echo "Error: " . $sql . " " . mysqli_error($con);
	}

	mysqli_close($con);
?>
