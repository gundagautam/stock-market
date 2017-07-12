<?php
	session_start();
	$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$sql = "INSERT INTO market_watch VALUES (".$_SESSION['investor_id'].", '".$_POST['item']."')";

	if (mysqli_query($con, $sql)) {
		echo "New record created successfully";
		$count=1;
		while(isset($_SESSION["dataset_name".$count])){
				$count=$count+1;
		}
		$_SESSION["dataset_name".$count]=$_POST['item'];
	} else {
		echo "Error: " . $sql . " " . mysqli_error($con);
	}

	mysqli_close($con);
?>
