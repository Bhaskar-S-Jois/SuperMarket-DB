<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$date = $_POST['date'];
$search = $_POST['search'];
$Quantity = $_POST['quantity'];
$sum = $_POST['sum'];
$Dprice=$_POST['Dprice'];
$Mobile = $_POST['Mobile'];
$Customer = $_POST['Customer'];
$f=1;
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
	</form>
	<?php
	if(!($con = mysqli_connect('localhost','root','','smdb')))
		echo "database connect error";
	if(!($q = mysqli_query($con , "select * from Items")))
		echo "query error";
	while($row = mysqli_fetch_array($q))
	{
		if($search == $row['IID'])
		{
			$f=0;
			$Name = $row['Iname'];
			$Price = $row['Price'];
			$Dprice=$Dprice+(($row['Discountpercentage']*$Price*0.01))*$Quantity;
			$Price = $Price - ($row['Discountpercentage']*$Price*0.01);
			$Total_Price = $Price * $Quantity;
			
			if(($row['Quantity'] - $Quantity)<0)
			{
				echo "Extra Items are present in the supermarket or database is not in sync with the actual number of items in supermarket";
				break;
			}
			if(!($innerq = mysqli_query($con , "insert into Tra" . $date . " values ('$search' , '$Name' ,'$Price','$Quantity','$Total_Price' )")))
			{
				echo "Inner query error";
				break;
			}
			
			$new= $row['Quantity'] - $Quantity;


			if(!($update = mysqli_query($con , "update Items set Quantity = '$new' where IID = '$search'")))
			{
				echo "update error";
				break;
			}
			else
			{
				$sum=$sum + $Total_Price;
				echo "success <br>";
			}
		}
		
		
	}
	if($f==1)
		{

			echo "Item with barcode " . $search . " does not exist.Please recheck your entry <br>";
		}
	?>
	<form action="transaction.php" method="POST" name="formname">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type='hidden' name='date' value='<?php echo "$date";?>'/> 
		<input type='hidden' name='sum' value='<?php echo "$sum";?>'/>
		<input type='hidden' name='Dprice' value='<?php echo "$Dprice";?>'/>
		<input type='hidden' name='Customer' value='<?php echo "$Customer";?>'/>
		<input type='hidden' name='Mobile' value='<?php echo "$Mobile";?>'/>  
		<input type="submit" value="OK" >
	</form>

</body>
</html>