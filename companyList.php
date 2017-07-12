<?php
	session_start();
	if(!isset($_SESSION["investor_id"])){
		echo "Error getting user id";
		header('Location: ./login.php');
	}
	
	$company= $_POST['item'];
	$current_price= $_POST['current'];

	$con = mysqli_connect('localhost','root','root','stock_market');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql="SELECT quantity, order_status,type,order_price FROM orders where investor_id = '".$_SESSION['investor_id']."' and dataset_code='".$company."'";
	$result = mysqli_query($con,$sql);
	
	echo "<h4>".$company."</h4>";
	$total=0;
	$pending=0;
	$total_price=0;
	while($rows = mysqli_fetch_array($result)){
		if($rows['type']=='BUY'){
			$total=$total+$rows['quantity'];
			$total_price=$total_price+($rows['quantity']*$rows['order_price']);
		}
		else{
			$total=$total-$rows['quantity'];
			$total_price=$total_price-($rows['quantity']*$rows['order_price']);
		}
		
		if($rows['order_status']=='pending'){
			$pending=$pending+1;
		}
		
	}
	mysqli_close($con);
	echo "<table><tr>";
	echo "<th>Company Name</th>";
	echo "<th>Quantity</th>";
	echo "<th>Price Spent</th>";
	echo "<th>Current Value</th>";
	echo "<th>Profit/Loss</th>";
	echo "</tr><tr>";
	echo "<td>".$company."</td>";
	echo "<td>".$total."</td>";
	echo "<td>".$total_price."</td>";
	echo "<td>".($total*$current_price)."</td>";
	echo "<td>".number_format((float)(($total*$current_price)-$total_price), 2, '.', '')."</td>";
	echo '</tr></table>'
?>