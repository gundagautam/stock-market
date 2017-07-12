<?php
	session_start();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/search.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<script src="https://www.amcharts.com/lib/3/amcharts.js?ver=20170308-01"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/home.css">
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

	<title>Stock Market</title>
</head>
<body>
<p class="topnav w3-ul">
<a class="active" href="home.php"><i class="material-icons">home</i>Market Watch</a>
  <a href="orders.php">Order book</a>
  <input type="text" id="search" name="search" placeholder="Search.."> </input>
  <a href="adminPage.php">Customer Orders</a>
  
  
  <span id = "user" class="dropdown">
	<a onclick="myFunction();" class="dropbtn"> <i class="material-icons">person</i>Admin</a><span id="myDropdown" class="dropdown-content"><a href="#" onclick="destroyVar();" id="logout">Log Out</a></span>
	
   </span>
</p>
<?php 
	
	//echo "<script>console.log('session started '+'".$_SESSION['fname']."');</script>";
	if(isset($_SESSION['investor_id'])){
		
	}else{
		echo "<script>console.log('session not set');</script>";
		header('Location: ./login.php');
	}
	
?>

<h4>Pending History of Customers</h4>
<form  action="./adminPage.php" method="post" id="change" >
<table id="historyTable">
	<tr>
		<th>Investor</th>
		<th>Company</th>
		<th>Date</th>
		<th>Type</th>
		<th>Quantity</th>
		<th>Ordered Price</th>
		<th>Status</th>
		<th>
            <input type="checkbox" id="selectAll" />
        </th>
	<tr>
</table>
<br />
<input type="submit" class="loginbtn" value = "Process Orders" />
</form>
<?php
		$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$sql = "select * from orders o, investor i where order_status='PENDING' and o.investor_id=i.investor_id";
		$query = mysqli_query($con,$sql);
		$str="";
		
		while($rows = mysqli_fetch_array($query)){
				date_default_timezone_set('UTC');
				$the_date = strtotime($rows['date_placed']);
				date_default_timezone_set('America/Chicago');
				$str=$str."<tr >";
				$str = $str."<td>".$rows['first_name']."</td>";
				$str = $str."<td>".$rows['dataset_code']."</td>";
				$str = $str."<td>".date("Y-d-m G:i:s", $the_date)."</td>";
				$str = $str."<td>".$rows['type']."</td>";
				$str = $str."<td>".$rows['quantity']."</td>";
				$str = $str."<td>".$rows['order_price']."</td>";
				$str = $str."<td>".$rows['order_status']."</td>";
				$str = $str."<td><input type='checkbox' name='checkbox' value='".$rows['order_id']."' id='checkbox'></td>";
				$str=$str."</tr>";
		}
		echo "<script>$('#historyTable').append(\"".$str."\");</script>";
	?>	

	<script>
	$(document).ready(function(){
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).attr('checked',e.target.checked);
		});
		
		$('#change').submit(function(event){
			event.preventDefault();
			var searchIDs = $("#change input:checkbox:checked").map(function(){
				return parseInt($(this).val());
			}).get(); // <----
			console.log(searchIDs);
			$.ajax({
			type: 'post',
            url:"./changeOrders.php", 
            data: {
				order_ids: searchIDs
				},
            async: false,
			success: function(data) {
				console.log(data);
				location.reload();
			}
			});
		});
		
	});
	
	</script>

</body>
</html>