<?php
	$user = $_POST['user'];
	$time = $_POST['time'];	
	$_SESSION['user'] = $user;
	$pass = $_POST['pass'];
	$IID = $_POST['IID'];
	$category = $_POST['category'];
	$Iname = $_POST['Iname'];
	$Price = $_POST['Price'];
	$Quantity = $_POST['Quantity'];
	$dis = $_POST['Dis'];
	$con = mysqli_connect("localhost","root","","smdb");
	if(mysqli_query($con,"insert into Items (IID,Iname,Category,Price,Discountpercentage,Quantity) values ('$IID','$Iname','$category','$Price','$dis','$Quantity')"))
		echo "Item added";
	else
		echo "Item cannot be added/already exist";	


?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert</title>
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
<form action="login.php" method="POST">
	<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
	<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
	<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
	<input type="submit" value="Home"></input>
</form>
<br>
<form action="insert_data.php" method="POST">
	<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
	<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
	<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
	<input type="submit" value="Insert another Item"></input>
</form>
<br>
</body>
</html>
