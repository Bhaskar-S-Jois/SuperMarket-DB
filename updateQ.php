<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
	<form action="dbhome.html" method="POST">
	<div class="log" align="right">
		<?php
			echo "Signed in : ". $user;
			echo "<br>";
			date_default_timezone_set('Asia/Kolkata');
			$time = date('h:i:s a',time());
			echo "Logged in at : " . $time;
			echo "<br>";
			

		?>
		<br>
		<input type="submit" value="Logout"></input>
	</div>
	</form>

	<form action="updateItem.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="text" name="IID" placeholder="Barcode"><br>
		<input type="number" name="Quantity" placeholder="New arrivals Quantity">
		<input type="submit" value="Update">
	</form>


	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>