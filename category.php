<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<?php
session_start();
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$category = $_POST['category'];
$time=$_POST['time'];
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


<?php
if(!($con = mysqli_connect("localhost","root","","smdb")))
		echo "error in connection";
$q = mysqli_query($con , "select * from Items");
$i = 1;
echo "Items : <br>";
while($row = mysqli_fetch_array($q))
{
	if($row['Category'] == $category)
	{
		echo $i . ":" . $row['Iname'];
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
<?php



?>