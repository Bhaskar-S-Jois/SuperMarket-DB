<?php
$user = $_POST['user'];
$actualuser = $_POST['actualuser'];
$actualpass = $_POST['actualpass'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$ID = $_POST['delete'];
$f=0;
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
if(!($q = mysqli_query($con , 'select * from Items')))
	echo "query error";
if($user == $actualuser && $pass == $actualpass)
{
	while ($row = mysqli_fetch_array($q) )
	{
		if($row['IID'] == $ID)
		{
			$Iname=$row['Iname'];
			$Category=$row['Category'];
			$Price=$row['Price'];
			$Quantity=$row['Quantity'];
			$dis=$row['Discountpercentage'];
			if(!($q = mysqli_query($con , "insert into RecycleBin(IID , Iname , Category , Price , Discountpercentage , Quantity , DeletedBy) values ('$ID','$Iname','$Category','$Price','$dis','$Quantity','$user')")))
				echo "insert query error";
			if(!($q = mysqli_query($con , "delete from Items where IID = '$ID'")))
				echo "Error in deleting.Please make sure the ID exist";
			else
			{	
				$f=1;
				echo "Deleted succesfully";
			}
			break;
		}	
	
	}
	if($f==0)
			echo "Error in deleting.Please make sure the ID exist";
}
else
{
	echo "Invalid password for the user";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
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



	<form action="display.php" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>