<?php
		$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "update orders set order_status='EXECUTED', date_placed='".date('Y-m-d H:i:s')."' where order_id in (";
		$len=0;
		
		while($len<(count($_POST['order_ids'])-1)){
			$sql=$sql.$_POST['order_ids'][$len].",";
			$len=$len+1;
		}
		$sql=$sql.$_POST['order_ids'][$len].")";
		echo $sql;
		if (mysqli_query($con, $sql)) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($con);
		}
		
?>