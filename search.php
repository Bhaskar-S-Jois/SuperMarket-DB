<?php
		$user = $_POST['user'];
		$_SESSION['user'] = $user;
		$pass = $_POST['pass'];
		$time = $_POST['time'];
		$str = $_POST['search'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Result</title>
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
		if(!($con = mysqli_connect('localhost','root','','smdb')))
			echo "database connection refused";
		if(!($q = mysqli_query($con , 'select * from Items')))
			echo "query error";
		echo "Search Results : <br>";
		$i = 1;
		while($row = mysqli_fetch_array($q))
		{
			$name = strtolower($row['Iname']);
			$str = strtolower($str);
			if ( strstr( $name, $str ) )
			{
				
				echo $i . "." . $row['Iname']; 
  				echo "<br>";
  				$i++;
  			}
		}
		?>
	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>