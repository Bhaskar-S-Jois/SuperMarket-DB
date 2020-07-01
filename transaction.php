<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$date = $_POST['date'];
$sum = $_POST['sum'];
$Dprice=$_POST['Dprice'];
$Mobile = $_POST['Mobile'];
$Customer = $_POST['Customer'];
$i=1;
$loop=0;
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
$q = mysqli_query($con , "create table if not exists Tra" . $date . " (ID int(5) primary key , Name varchar(50) , Price real , Quantity int ,Total_Price real)");


?>
<!DOCTYPE html>
<html>
<head>
	<title>Transaction</title>
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
	<?php
		echo "<br>";
		echo "Total amount : " . $sum;
		echo "<br>";
		echo "Name";
		while($loop<40)
		{
			echo "&nbsp;";
			$loop++;
		}
		
		echo " Quantity";
	?>

	<form action="iterate.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='date' value='<?php echo "$date";?>'/>
		<input type='hidden' name='sum' value='<?php echo "$sum";?>'/>  
		<input type='hidden' name='Dprice' value='<?php echo "$Dprice";?>'/> 
		<input type='hidden' name='Customer' value='<?php echo "$Customer";?>'/>
		<input type='hidden' name='Mobile' value='<?php echo "$Mobile";?>'/>    
		<input type="text" 	name="search" placeholder="Search">
		<input type="number" name="quantity" placeholder="Quantity" value="1">
		<input type="submit" value="Submit">
	</form>
	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
	<form action="successtrans.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='date' value='<?php echo "$date";?>'/>
		<input type='hidden' name='sum' value='<?php echo "$sum";?>'/>
		<input type='hidden' name='Dprice' value='<?php echo "$Dprice";?>'/> 
		<input type='hidden' name='Customer' value='<?php echo "$Customer";?>'/>
		<input type='hidden' name='Mobile' value='<?php echo "$Mobile";?>'/>    
		<input type="submit" value="Done">
	</form>
</body>
</html>