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

	$sql_b = "select sum(quantity) from orders where investor_id='".$_SESSION['investor_id']."' and dataset_code='".$_POST['company_name']."' and type='BUY'";
	
	$sql_s = "select sum(quantity) from orders where investor_id='".$_SESSION['investor_id']."' and dataset_code='".$_POST['company_name']."' and type='SELL'";
	//echo $sql_b;
	//echo $sql_s;
	
	$status="";
	if(date('H')>13 && date('H')<20){
		$status='EXEUCTED';
		echo "<script>console.log('Executed ".date('H')."');</script>";
	}else{
		$status='PENDING';
		echo "<script>console.log('Pending ".date('H')."');</script>";
	}
	
	$sql = "INSERT INTO orders (investor_id,date_placed,type,order_status,dataset_code,quantity,order_price) VALUES ('".$_SESSION['investor_id']."','".date("Y-m-d H:i:s")."','SELL','".$status."','".$_POST['company_name']."','".$_POST['quantity']."','".$_POST['company_curr']."')";
	
	
	$query1 = mysqli_query($con,$sql_b);
	$query2 = mysqli_query($con,$sql_s);
	$rows1 = mysqli_fetch_array($query1);
	$rows2 = mysqli_fetch_array($query2);
	//echo "<script>console.log('".$rows1['sum(quantity)']." and ".$rows2['sum(quantity)']."');</script>";
	//echo "<br>".$sql."<br>";
	
	if($rows1['sum(quantity)']-$rows2['sum(quantity)']>=$_POST['quantity']){
		$query1 = mysqli_query($con,$sql);
		if($query1){
			mysqli_close($con);
			echo "<script>alert('Stocks sold');window.location.href='orders.php';</script>";
		} else {
			mysqli_close($con);
		echo "Error";
		}
	}else{
		//echo "<script>console.log('Error selling the stock as there are only ".number_format((float)($rows1['sum(quantity)']-$rows2['sum(quantity)']), 2, '.', '')." left to sell ');</script>";
		mysqli_close($con);
		echo "<script>alert('Error selling the stock as there are only ".number_format((float)($rows1['sum(quantity)']-$rows2['sum(quantity)']), 2, '.', '')." left to sell ');window.location.href='orders.php';</script>";
		
		//header('Location: ./orders.php');
	}

?>
