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
<!--<input type="button" value="Add frames" id="chartsButton"> -->

<div id="charts">
<h4>Nifty 50 Data</h4>
<iframe id="frames" frameborder="0" src="graph.php" height="500px" width="100%"></iframe>
</div>


<?php 
	
	//echo "<script>console.log('session started '+'".$_SESSION['fname']."');</script>";
	if(isset($_SESSION['fname'])){
		$str="<a onclick=\"myFunction();\" class=\"dropbtn\"> <i class=\"material-icons\">person</i>".$_SESSION['fname']."</a><span id=\"myDropdown\" class=\"dropdown-content\"><a href=\"#\" onclick=\"destroyVar();\" id=\"logout\">Log Out</a></span>";
		echo "<script> $('#user').html('".$str."');</script>";
	}else{
		echo "<script>console.log('session not set');</script>";
	}
	
	if(!isset($_SESSION['dataset_name'])){
		$con = mysqli_connect('localhost','root','root','stock_market');
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT dataset_name FROM market_watch where investor_id = '".$_SESSION['investor_id']."'");
		$count=1;
		if($result->num_rows!=0){
			while($row = mysqli_fetch_array($result)){
				echo "<script>console.log('found')</script>";
			
				$_SESSION["dataset_name".$count]=$row['dataset_name'];
				echo "<script>console.log('". $_SESSION["dataset_name".$count]."')</script>";
				$count=$count+1;
			}
			echo "<script>console.log('". $_SESSION['fname']."')</script>";
			mysqli_close($con);
			
		}else{
			echo "<script>console.log('didnt find rows')</script>";
			mysqli_close($con);
			
		}
	}
	$count=1;
	
	if(isset($_SESSION["dataset_name".$count])){
		while(isset($_SESSION["dataset_name".$count])){
			echo "<script>renderGraph('".$_SESSION["dataset_name".$count]."');</script>";
			$count=$count+1;
		}			
	}
?>
</body>
</html>

