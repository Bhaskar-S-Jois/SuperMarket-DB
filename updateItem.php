<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$Quantity = $_POST['Quantity'];
$IID = $_POST['IID'];
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
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
	<?php
		if(!($q = mysqli_query($con , 'select * from Items')))
			echo "Query error";
		while($row = mysqli_fetch_array($q))
		{
			if($row['IID']==$IID)
			{
				$Quantity=$Quantity+$row['Quantity'];
				if(!($qu = mysqli_query($con , "update Items set Quantity = '$Quantity' where IID = '$IID'")))
					echo "Query error";
				else
					echo "Value updated successfully";
			}
		}

	?>
	<form action="updateQ.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>

</body>
</html>