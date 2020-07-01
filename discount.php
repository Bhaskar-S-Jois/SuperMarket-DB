<?php
$user = $_POST['user'];
$actualuser = $_POST['actualuser'];
$actualpass = $_POST['actualpass'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$ID=$_POST['ID'];
$dis=$_POST['discount'];
$f=0;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Discount</title>
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
	<?php
	if($dis >100)
	{
		echo "Invalid discount amount!";
	}
	else
	{
		if(!($con = mysqli_connect('localhost','root','','smdb')))
			echo "database connect error";
		if(!($q=mysqli_query($con , "update Items set Discountpercentage = '$dis' where IID = '$ID'")))
			echo "query error";
		else if($dis != 0) 
			echo "Discount added";
		else
			echo "Discount Removed";
	}	
	?>
	<form action="display.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<div class="btn">
		<input type="submit" value="Ok">
		</div>
	</form>
</body>
</html>