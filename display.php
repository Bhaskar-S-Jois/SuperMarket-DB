<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
	<style>
	body  
	{
		background-image: url("super.jpg");
  		
  	}
	</style>
	<style>
	table, th, td 
	{
  		border: 1px solid black;
	}
	</style>
</head>
<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
if(!($q = mysqli_query($con , 'select * from Items')))
	echo "query error";

$i = 1;
?>
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
		<th>Category</th>
		<th>Price</th>
		<th>Discount</th>
		<th>Quantity</th>
	</tr>
<?php
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
			<?php echo $row['Category'];?>
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
	</tr>
	<?php
	$i++;
}


?>
	
</table>
	<br>
	<?php echo "Delete Item by barcode:<br>"; ?>	
	<form action="delete.php" method="POST">
		<input type="text" name="actualuser" value="<?php echo "$user";?>" placeholder="username">
		<input type="password" name="actualpass" placeholder="password">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="text" 	name="delete" placeholder="barcode">
		<div class="btn">
		<input type="submit" value="Delete">
		</div>
	</form>
	<?php echo "<br>Add/reset discount to item by barcode:<br>"; ?>	
	<form action="discount.php" method="POST">
		<input type="text" name="actualuser" value="<?php echo "$user";?>" placeholder="username">
		<input type="password" name="actualpass" placeholder="password">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="text" 	name="ID" placeholder="barcode">
		<input type="number" step="0.01" name="discount" value="0" placeholder="discount">
		<div class="btn">
		<input type="submit" value="Add discount">
		</div>
	</form>
	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<div class="btn">
		<input type="submit" value="Back">
		</div>
	</form>
</body>
</html>