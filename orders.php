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

	<title>Stock Market Login Page</title>
</head>
<body>
<p class="topnav w3-ul">
  <a class="active" href="home.php"><i class="material-icons">home</i>Market Watch</a>
  <a href="orders.php">Order book</a>
  <span id="admin"></span>
  <?php
	if($_SESSION['investor_id']==3){
		echo "<script>console.log(\"admin logged in\");</script>";
		echo "<script>$(\"#admin\").append('<a href=\"adminPage.php\">Customer Orders</a>');</script>";
	}
  ?>
 <input type="text" id="search" name="search" placeholder="Search.."> </input>
  <span id = "user" class="dropdown">
	<a href="./login.php"  class="dropbtn"><i class="material-icons">person</i>Log In</a>
   </span>
  
</p>

<?php 
	
	//echo "<script>console.log('session started '+'".$_SESSION['fname']."');</script>";
	if(isset($_SESSION['fname'])){
		$str="<a onclick=\"myFunction();\" class=\"dropbtn\"> <i class=\"material-icons\">person</i>".$_SESSION['fname']."</a><div id=\"myDropdown\" class=\"dropdown-content\"><a href=\"#\" onclick=\"destroyVar();\" id=\"logout\">Log Out</a></div>";
		echo "<script> $('#user').html('".$str."');</script>";
	}else{
		echo "<script>console.log('session not set');</script>";
		header('Location: ./login.php');
	}
	
?>
<div id="mainContainer">
<nav id="leftDiv">
	<input type="text"  id="leftSearch" placeholder="Search.."> </input>
	<table id="fillTable">
		
	</table>
</nav>
<?php

	
	
			$str="";
			$count=1;
			echo "<script>console.log(\"before\");</script>";
			if(isset($_SESSION["dataset_name".$count])){
			while(isset($_SESSION["dataset_name".$count])){
				$str=$str."<tr >";
				$str = $str."<td id='com".$_SESSION["dataset_name".$count]."' onclick='company(this.id);'><a href=''>".$_SESSION["dataset_name".$count]."</a></td>";
				$str = $str."<td><a href='' id='buy".$_SESSION["dataset_name".$count]."' onclick='buy(this.id);' >BUY</a></td>";
				$str = $str."<td><a href='' id='sell".$_SESSION["dataset_name".$count]."' onclick='sell(this.id);' >SELL</a></td>";
				$count=$count+1;
				$str=$str."</tr>";
			}
			echo "<script>$('#fillTable').append(\"".$str."\");</script>";
			}
		?>
<div id="rightDiv">
	<div id="rightDivComp">
	</div>
	<div>
		<h4>Order History</h4>
		<table id="historyTable">
		<tr>
			<th>Company</th>
			<th>Date</th>
			<th>Type</th>
			<th>Quantity</th>
			<th>Ordered Price</th>
			<th>Status</th>
		<tr>
	</table>
	
	<?php
		$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	
	
		$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$sql = "select * from orders where investor_id='".$_SESSION['investor_id']."'";
		$query = mysqli_query($con,$sql);
		$str="";
		
		
		while($rows = mysqli_fetch_array($query)){
			date_default_timezone_set('UTC');
				$the_date = strtotime($rows['date_placed']);
				date_default_timezone_set('America/Chicago');
			$str=$str."<tr >";
				$str = $str."<td>".$rows['dataset_code']."</td>";
				$str = $str."<td>".date("Y-d-m G:i:s", $the_date)."</td>";
				$str = $str."<td>".$rows['type']."</td>";
				$str = $str."<td>".$rows['quantity']."</td>";
				$str = $str."<td>".$rows['order_price']."</td>";
				$str = $str."<td>".$rows['order_status']."</td>";
				$str=$str."</tr>";
		}
		echo "<script>$('#historyTable').append(\"".$str."\");</script>";
	?>
	
	</div>
	
</div>



</div>

<?php
	$count=1;
	//echo "<script>renderOrderSearch('".$_SESSION["dataset_name".$count]."');</script>";
?>

</body>
</head>
