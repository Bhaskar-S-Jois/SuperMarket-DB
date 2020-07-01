<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$date = $_POST['date'];
$sum = $_POST['sum'];
$Dprice = $_POST['Dprice'];
$Customer=$_POST['Customer'];
$Mobile=$_POST['Mobile'];
$i=1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>success</title>
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
			echo "<br>";
			echo "Customer Name : " . $Customer;
		?>
		<br>
		<input type="submit" value="Logout"></input>
	</div>
	</form>
	<p>SUPER MARKET</p>
	<p> #123 , abc street , xyz block , Mysore - 5700xx </p>	
	<table>
	<tr>
		<th>Number</th>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total Price</th>
	</tr>
	<?php
	if(!($con = mysqli_connect('localhost','root','','smdb')))
		echo "database error";
	if(!($q = mysqli_query($con , "select * from Tra" . $date)))
		echo "query error";
	echo "Transaction ID : Tra" . $date . ".<br>";
	echo "Transaction handled by " . $user . "<br>";
	echo "Item list : <br>";
	while($row = mysqli_fetch_array($q))
	{
		?>
		<tr>
			<td>
				<?php echo $i ;?>
			</td>
			<td>
				<?php echo $row['ID'] ;?>
			</td>
			<td>
				<?php echo $row['Name'] ;?>
			</td>
			<td>
				<?php echo $row['Price'] ;?>
			</td>
			<td>
				<?php echo $row['Quantity'] ;?>
			</td>
			<td>
				<?php echo $row['Total_Price'] ;?>
			</td>

		</tr>
		<?php
		$i++;
	}


	?>
	
	</table>
	<p>_________________________________________________________________________</p>
	<?php
		echo "<br>";
		echo "Total amount : Rs." . $sum; 
		echo "<br> You saved : Rs." . $Dprice;
		if(!($iq = mysqli_query($con , "insert into Handle (TID,Employee,Total_Price) values('$date','$user','$sum')")))
			echo "query error<br>";
		if(!($iq = mysqli_query($con , "insert into Customer (Customer,Mobile,TID) values('$Customer','$Mobile','$date')")))
			echo "query error";
	?>
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