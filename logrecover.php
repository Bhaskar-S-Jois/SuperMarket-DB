<?php
$user = $_POST['user'];
$_SESSION['user'] = $user;
$pass = $_POST['pass'];
$time = $_POST['time'];
$j=1;
if(!($con = mysqli_connect('localhost','root','','smdb')))
	echo "database connect error";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recover</title>
	<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
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
	<?php
		if(!($b = mysqli_connect('localhost','root','')))
			echo "Connection error";
		if(!($dq = mysqli_query($b,"create database if not exists BackupDB")))
			echo "Database creation error";
		else
		{
			if(!($bcon = mysqli_connect('localhost','root','','BackupDB')))
				echo "backup database connect error";
			$i = 0;
			$fdItm = fopen("logItems.log","w");
			$fdrItm= fopen("logItems.log", "r");
			$fdRItm = fopen("logRItems.log","w");
			$fdrRItm= fopen("logRItems.log", "r");
			$fdEmp = fopen("logEmp.log" , "w");
			$fdrEmp = fopen("logEmp.log" , "r");
			$fdHan = fopen("logHan.log" , "w");
			$fdrHan = fopen("logHan.log" , "r");
			$fdCus = fopen("logCus.log", "w");
			$fdrCus = fopen("logCus.log", "r");
			//transaction table
			if(!($sq=mysqli_query($con , "show tables")))
				echo "Table query error";
			echo "<b>transactions backed-up:</b> <br>";
			while($row=mysqli_fetch_array($sq))
			{
				if(strstr($row['Tables_in_smdb'], "tra"))
				{
					$table = $row['Tables_in_smdb'];

					echo "<br><b>". $j .".". $table . "</b><br>";
					$j++;
					if(!($cq = mysqli_query($bcon , "create table if not exists " .$table . "(ID int(5) primary key , Name varchar(50) , Price real , Quantity int ,Total_Price real)")))
						echo "create table error";
					$fdtra = fopen("log$table.log", "w");
					$fdrtra = fopen("log$table.log", "r");
					if(!($q=mysqli_query($con , "select * from " . $table)))
						echo "query error";
					while($row = mysqli_fetch_array($q))
					{
							fwrite($fdtra, $row['ID']);
							fwrite($fdtra, " ");
							fwrite($fdtra, $row['Name']);
							fwrite($fdtra, " ");
							fwrite($fdtra, $row['Price']);
							fwrite($fdtra, " ");
							fwrite($fdtra, $row['Quantity']);
							fwrite($fdtra, " ");
							fwrite($fdtra, $row['Total_Price']);
							fwrite($fdtra, "\n");
					}
					if(!($q = mysqli_query($bcon , "delete from ".$table." where 1")))
						echo "Previous backup cleanup error";
					while ($s = fscanf($fdrtra, "%s %s %s %s %s\n")) 
					{
		    			list ($ID,$Name,$Price,$Quantity,$Total_Price) = $s;
								echo $ID . " " . $Name . " " . $Price . " " . $Quantity . " ". $Total_Price . " <br> ";
								if(!($q = mysqli_query($bcon , "insert into " . $table ." values('$ID','$Name','$Price','$Quantity','$Total_Price')")))
									echo "backup error";
					}
				}
			}
			

			echo "<br>";
			//Items
			if(!($q=mysqli_query($con , "select * from Items")))
				echo "query error";
			while($row = mysqli_fetch_array($q))
			{
				fwrite($fdItm, $row['IID']);
				fwrite($fdItm, " ");
				fwrite($fdItm, $row['Iname']);
				fwrite($fdItm, " ");
				fwrite($fdItm, $row['Category']);
				fwrite($fdItm, " ");
				fwrite($fdItm, $row['Price']);
				fwrite($fdItm, " ");
				fwrite($fdItm, $row['Discountpercentage']);
				fwrite($fdItm, " ");
				fwrite($fdItm, $row['Quantity']);
				fwrite($fdItm, "\n");
			}
			if(!($cq = mysqli_query($bcon , "create  table if not exists Items (IID int(6) primary key , Iname varchar(50) not null , Category varchar(50) , Price real , Discountpercentage real , Quantity int)")))
				echo "Create table Items error";
			if(!($q = mysqli_query($bcon , "delete from Items where 1")))
				echo "Previous backup cleanup error";
			echo "<b>Items backed-up:</b> <br>";
			while ($s = fscanf($fdrItm, "%s %s %s %s %s %s\n")) 
			{
	    		list ($IID, $Iname, $Category,$Price,$Dis,$Quantity) = $s;
						echo $IID . " " . $Iname . " " . $Category . " " . $Price . " " . $Dis . " ". $Quantity . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Items values ('$IID','$Iname','$Category','$Price','$Dis','$Quantity')")))
							echo "backup error";
			}

			//Items end
			//Employee 
			if(!($q=mysqli_query($con , "select * from Employee")))
				echo "query error";
			while($row = mysqli_fetch_array($q))
			{
				fwrite($fdEmp, $row['ID']);
				fwrite($fdEmp, " ");
				fwrite($fdEmp, $row['Name']);
				fwrite($fdEmp, " ");
				fwrite($fdEmp, $row['Password']);
				fwrite($fdEmp, "\n");
			}
			if(!($cq = mysqli_query($bcon , "create  table if not exists Employee (ID int(5) primary key , Name varchar(50) not null , Password varchar(50))")))
				echo "Create table Employee error";
			if(!($q = mysqli_query($bcon , "delete from Employee where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <br><b>Employee details backed-up:</b> <br>";
			while ($s = fscanf($fdrEmp, "%s %s %s\n")) 
			{
	    		list ($ID, $Name, $Password) = $s;
						echo $ID . " " . $Name . " " . "*****" . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Employee values ('$ID','$Name','$Password')")))
							echo "backup error";
			}
			//Employee end
			//Handle
			if(!($q=mysqli_query($con , "select * from Handle")))
				echo "query error";
			while($row = mysqli_fetch_array($q))
			{
				fwrite($fdHan, $row['TID']);
				fwrite($fdHan, " ");
				fwrite($fdHan, $row['Employee']);
				fwrite($fdHan, " ");
				fwrite($fdHan, $row['Total_Price']);
				fwrite($fdHan, "\n");
			}
			if(!($cq = mysqli_query($bcon , "create  table if not exists Handle (TID varchar(50) primary key , Employee varchar(50) ,Total_Price real)")))
				echo "Create table Handle error";
			if(!($q = mysqli_query($bcon , "delete from Handle where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <b>Handling Employee details backed-up:</b> <br>";
			while ($s = fscanf($fdrHan, "%s %s %s\n")) 
			{
	    		list ($TID, $Employee, $Total_Price) = $s;
						echo $TID . " " . $Employee . " " . $Total_Price . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Handle values ('$TID','$Employee','$Total_Price')")))
							echo "backup error";
			}
			//handle end
			//Customer
			if(!($q=mysqli_query($con , "select * from Customer")))
				echo "query error";
			while($row = mysqli_fetch_array($q))
			{
				fwrite($fdCus, $row['Customer']);
				fwrite($fdCus, " ");
				fwrite($fdCus, $row['Mobile']);
				fwrite($fdCus, " ");
				fwrite($fdCus, $row['TID']);
				fwrite($fdCus, "\n");
			}
			if(!($cq = mysqli_query($bcon , "create  table if not exists Customer (Customer varchar(50)  , Mobile bigint(50) ,TID varchar(50) primary key)")))
				echo "Create table Customer error";
			if(!($q = mysqli_query($bcon , "delete from Customer where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <b>Customer details backed-up:</b> <br>";
			while ($s = fscanf($fdrCus, "%s %s %s\n")) 
			{
	    		list ($Customer, $Mobile, $TID) = $s;
						echo $Customer . " " . $Mobile . " " . $TID . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Customer values ('$Customer','$Mobile','$TID')")))
							echo "backup error";
			}
			//Customer end
			//Recycle 
			echo "<br>";
			if(!($q=mysqli_query($con , "select * from RecycleBin")))
				echo "query error";
			while($row = mysqli_fetch_array($q))
			{
				fwrite($fdRItm, $row['IID']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['Iname']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['Category']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['Price']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['Discountpercentage']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['Quantity']);
				fwrite($fdRItm, " ");
				fwrite($fdRItm, $row['DeletedBy']);
				fwrite($fdRItm, "\n");
			}
			if(!($cq = mysqli_query($bcon , "create  table if not exists RecycleBin (IID int(6) primary key , Iname varchar(50) not null , Category varchar(50) , Price real , Discountpercentage real , Quantity int , DeletedBy varchar(50))")))
				echo "Create table RecycleBin error";
			if(!($q = mysqli_query($bcon , "delete from RecycleBin where 1")))
				echo "Previous backup cleanup error";
			echo "<b>Recycle Items backed-up:</b> <br>";
			while ($s = fscanf($fdrRItm, "%s %s %s %s %s %s %s\n")) 
			{
	    		list ($IID, $Iname, $Category,$Price,$Discountpercentage,$Quantity,$DeletedBy) = $s;
						echo $IID . " " . $Iname . " " . $Category . " " . $Price . " " . $Quantity . " " . $DeletedBy . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into RecycleBin values ('$IID','$Iname','$Category','$Price','$Discountpercentage','$Quantity','$DeletedBy')")))
							echo "backup error";
			}
			//Recycle end
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