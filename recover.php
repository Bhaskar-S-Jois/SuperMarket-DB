<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$i=1;
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recover</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
	<style>
	table, th, td 
	{
  		border: 1px solid black;
	}
	</style>
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
	<table>
	<tr>
		<th>Number</th>
		<th>IID</th>
		<th>Iname</th>
		<th>Price</th>
		<th>Discount</th>
		<th>Quantity</th>
		<th>Deleted By</th>
	</tr>
	<?php
	if(!($q = mysqli_query($con , "select * from RecycleBin")))
		echo "Query error";

	echo "Item list : <br>";
	while($row = mysqli_fetch_array($q))
	{
		?>
		<tr>
			<td>
				<?php echo $i ;?>	
			</td>
			<td>
				<?php echo $row['IID'] ;?>
			</td>	
			<td>
				<?php echo $row['Iname'] ;?>
			</td>
			<td>
				<?php echo $row['Price'] ;?>
			</td>
			<td>
				<?php echo $row['Discountpercentage'] ;?>
			</td>
			<td>
				<?php echo $row['Quantity'] ;?>
			</td>
			<td>
				<?php echo $row['DeletedBy'] ;?>
			</td>
		</tr>
		<?php
		$i++;
	}
	?>
	</table>
	<form action="itemrecover.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/>   
		<input type="text" name="actualuser" placeholder="user" value="<?php echo "$user";?>">
		<input type="password" name="actualpass" placeholder="password">
		<input type="text" 	name="search" placeholder="Item ID to recover">
		<input type="submit" value="Submit">
	</form>
	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
		<input type='hidden' name='sum' value='<?php echo "$sum";?>'/>
		<input type="submit" value="Back">
	</form>
</body>
</html>