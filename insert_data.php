<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Data</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
	<form action="dbhome.html" method="POST">
	<div class="log" align="right">
		<?php
			echo "Signed in : " . $user;
			echo "<br>";
			echo "Logged in at : " . $time;
		?>
		<br>
		<input type="submit" value="Logout"></input>
	</div>
	</form>
	
	<form action="insert.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type="text" name="IID" placeholder="Item ID"></input><br>
		<input type="text" name="Iname" placeholder="Item Name"></input><br>
    	<select name="category"><br>
       		<option value="misc">Misc</option>
			<option value="grocery">*Grocery</option>
			<option value="toiletiers">*Toiletiers</option>
			<option value="cleaner">*Cleaning supplies</option>
			<option value="vegetables">Vegetables</option>
			<option value="fruits">Fruits</option>
			<option value="dairy">*Dairy Items</option>
			<option value="bakery">Bakery</option>
			<option value="baby">Baby items</option>
			<option value="cosmatics">Cosmatics</option>
			<option value="cooldrinks">Cool drinks</option>
			<option value="eatables">Eatables</option>
			<option value="electricals">Electricals</option>
			<option value="electronics">Electronics</option>
			<option value="furniture">Furnitures</option>
			<option value="garments">Garments</option>
			<option value="gift">Gift</option>
			<option value="meat">Meat/Seafood</option>
			<option value="pharmacy">Pharmacy</option>
			<option value="snacks">Snacks</option>
			<option value="stationery">Stationery</option>
			<option value="toys">Toys</option>
			<option value="utensils">Utensils</option>
		</select><br>
		<input type="number" name="Price" step="0.01" placeholder="Price per Item"></input><br>
		<input type="number" name="Dis" step="0.01" placeholder="Discount" value="0"></input><br>
		<input type="number" name="Quantity" step="1" placeholder="Quantity"></input><br>
		<input type="submit" value="submit">
	</form>
	<br>
	<form action="login.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>