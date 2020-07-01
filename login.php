<?php
session_start();
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
if(!isset($user))
	echo "user error";
if(!isset($_SESSION['user']))
	echo "user session error";
if(!isset($pass))
	echo "pass error";
date_default_timezone_set('Asia/Kolkata');
$date = date('Ymdhisa', time());
$sum = 0.00;
$Dprice = 0.00;
?>
<!DOCTYPE html>
<html>
<head>
	<title>database</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
	<style>
	body  
	{
		background-image: url("/supermarket.jpg");
  		
  	}
	</style>
	<style type="text/css">
		.container
		{
			
			padding: 20px;
  			margin: 0;
  			position: absolute;
  			top: 50%;
  			left: 45%;
  			-ms-transform: translateY(-50%);
  			transform: translateY(-50%);
  			 opacity: 0.4;
  			transition: 0.5s;
         
		}
		.container:hover 
		{
			opacity: 1;
		}
		.center
		{
			background-color: #ffeeff;
			padding: 20px;
  			margin: 0;
  			position: absolute;
  			top: 50%;
  			left: 45%;
  			-ms-transform: translateY(-50%);
  			transform: translateY(-50%);		
  			opacity: 0.7;
  			transition: 0.5s;	
  		}
  		.center:hover 
  		{
  			opacity: 1;
  		}
	</style>


</head>
<?php
$flag=0;
$f=0;
if(!($con = mysqli_connect("localhost","root","")))
		echo "error in connection";
// else if(!($con = mysqli_connect("localhost","root","","smdb")))
// 		echo "error in connection";
if(!($q = mysqli_query($con , "show databases")))
	echo "Database query error";
while($row = mysqli_fetch_array($q))
{
	if($row['Database']=="smdb")
		$f=1;
}
if($f==0)
{
	?>
	<div class="center" align="center">
	<?php 
	echo "<b>Database not found.Please repair</b>";
	?>
	
	<form action="dbhome.html">
		<br>
		<input type="submit" value="Back">
	 </form>
	 </div>
	<?php
}
else
{	
	if(!($con = mysqli_connect("localhost","root","","smdb")))
		echo "error in connection";
	$login_q = mysqli_query($con , "select * from Employee");
	while($login_row = mysqli_fetch_array($login_q))
	{
		if($user == $login_row['Name'] && $pass == $login_row['Password'])
			$flag=1;
	} 
	if($flag == 1)
	{

		?>
		
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
	<div class="container">
	  <div class="d-flex flex-row bg-secondary">
	    <div class="col-sm-4">
	    	<p>
		<form action="insert_data.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type="submit" value="Insert Items">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="item_search.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type="submit" value="Item search">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="display.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type="submit" value="Items list">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="category.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<select name="category">
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
			</select>
			<input type="submit" value="Category search">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="updateQ.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type="submit" value="Update quantity of Items">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="customer.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
			<input type='hidden' name='sum' value='<?php echo "$sum";?>'/> 
			<input type='hidden' name='Dprice' value='<?php echo "$Dprice";?>'/> 
			<input type="submit" value="Transaction">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="recover.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
			<input type='hidden' name='sum' value='<?php echo "$sum";?>'/> 
			<input type="submit" value="Recover Items from Recycle Bin">
		</form>
			</p>
		</div>
		<div class="col-sm-4">
			<p>
		<form action="logrecover.php" method="POST">
			<div align="center">
			<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
			<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
			<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
			<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
			<input type='hidden' name='sum' value='<?php echo "$sum";?>'/> 
			<input type="submit" value="Backup Database">
		</form>
			</p>
		</div>
	  </div>
	</div>
		<br>
		<br> 
		<div align="center">
		<?php


	}
	else
	{
		?>
		<form action="dbhome.html" method="POST">
			<div class="center" align="center">
				<?php echo "<b>Incorrect Username/Password</b><br>"; ?>
			<input type="submit" value="Try again">
		</form>

		<?php
	}

}
?>
</div>

</body>
</html>