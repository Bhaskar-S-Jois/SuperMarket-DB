<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$date = $_POST['date'];
$sum = $_POST['sum'];
$Dprice=$_POST['Dprice'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
	<form action="dbhome.html" method="POST">
	<div class="log" align="right">
		<?php
			echo "Signed in : ". $user;
			echo "<br>";
			echo "Logged in at : " . $time;


		?>
		<br>
		<input type="submit" value="Logout"></input>
	</div>
	</form>
	<form action="transaction.php" method="POST">
		<div align="center">
		<?php echo "Customer Name : "; ?>
		<input type="text" name="Customer" placeholder="Customer Name" value="Anonymous">
		<br>
		<?php echo "Mobile Number : "; ?>
		<input type="number" name="Mobile" placeholder="Mobile Number" value="9876543210">
		<br>
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
		<input type='hidden' name='sum' value='<?php echo "$sum";?>'/> 
		<input type='hidden' name='Dprice' value='<?php echo "$Dprice";?>'/> 
		<input type="submit" value="Go">
	</form>
	<br><br>

	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>