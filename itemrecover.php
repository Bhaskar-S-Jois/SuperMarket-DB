<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$ID = $_POST['search'];
$actualuser = $_POST['actualuser'];
$actualpass = $_POST['actualpass'];
$i=1;
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
?>
<!DOCTYPE html>
<html>
<head>
	<title>loop</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
	<script type="text/javascript">
		window.onload = function()
		{
  			document.forms['formname'].submit();
		}
	</script>
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
	if(!($actualpass == $pass && $actualuser == $user))
		echo "Incorrect password";
	else
	{
		if(!($q=mysqli_query($con , "select * from RecycleBin")))
		{
			echo "Query error.Item doesnt exist";
		}
		while($row = mysqli_fetch_array($q))
		{
			if($row['IID'] == $ID)
			{
				$ID=$row['IID'];
				$Iname=$row['Iname'];
				$Category=$row['Category'];
				$Price=$row['Price'];
				$Quantity=$row['Quantity'];
				$dis=$row['Discountpercentage'];
				if(!($qi=mysqli_query($con , "insert into Items values ('$ID','$Iname','$Category','$Price','$dis','$Quantity')")))
					echo "Insert error";
				else
				{
					if(!($q=mysqli_query($con , "delete from RecycleBin where IID='$ID'")))
					{
						echo "Delete error.";
					}
				}
			}
		}
	}
	?>
	<form action="recover.php" method="POST" name="formname">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="OK" >
	</form>


	?>
</body>
</html>