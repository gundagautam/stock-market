<?php
session_start();
echo "<script>console.log('".$_POST['quantity']."')</script>";
echo "<script>console.log('".$_POST['company_curr']."')</script>";
echo "<script>console.log('".$_POST['company_name']."')</script>";

	$con = mysqli_connect('localhost','root','root','stock_market');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	$status="";
	if(date('H')>13 && date('H')<20){
		$status='EXEUCTED';
		echo "<script>console.log('Executed ".date('H')."');</script>";
	}else{
		$status='PENDING';
		echo "<script>console.log('Pending ".date('H')."');</script>";
	}
	
	$sql = "INSERT INTO orders (investor_id,date_placed,type,order_status,dataset_code,quantity,order_price) VALUES ('".$_SESSION['investor_id']."','".date("Y-m-d H:i:s e")."','BUY','".$status."','".$_POST['company_name']."','".$_POST['quantity']."','".$_POST['company_curr']."')";


	$query = mysqli_query($con,$sql);
	
	mysqli_close($con);
	if($query){
		echo "<script>alert('Purchased product');window.location.href='orders.php';</script>";
		
	} else {
		echo "Error: " . $sql . " " . mysqli_error($con);
	}
	

?>
