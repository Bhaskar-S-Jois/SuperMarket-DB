<?php
$admin = $_POST['admin'];
$_SESSION['admin'] = $admin;
$pass = $_POST['password'];
$j=1;
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
			echo "Signed in : ". $admin;
			echo "<br>";
		?>
		<br>
		<input type="submit" value="Logout"></input>
	</div>
	</form>
	<?php
		
		if(!($b = mysqli_connect('localhost','root','')))
			echo "Connection error";
		if(!($dq = mysqli_query($b,"create database if not exists smdb")))
			echo "Database creation error";
		else if($admin == "admin" && $pass == "speedbird")
		{
			if(!($bcon = mysqli_connect('localhost','root','','smdb')))
				echo "database connect error";
			$i = 0;
			
			$fdrItm= fopen("logItems.log", "r");
			$fdrRItm= fopen("logRItems.log", "r");
			$fdrEmp = fopen("logEmp.log" , "r");
			$fdrHan = fopen("logHan.log" , "r");
			$fdrCus = fopen("logCus.log", "r");
			//Transaction table
			$dir    = '.';
			$files1 = scandir($dir);
			$fdScan = fopen("logScan.log","w");
			$fdrScan = fopen("logScan.log","r");
			file_put_contents("logScan.log", print_r($files1,true));
			echo "<b>Transactions recovered:</b> <br>";
			while($li = fscanf($fdrScan,"%s %s %s"))
			{
				list($s1,$s2,$s) = $li;
				if(strstr($s,".log"))
					if(strstr($s,"Tra"))
					{
						$st = trim($s , ".log");
						echo "<br><b>". $j .".". $st . "</b><br>";
						$j++;
						if(!($cq = mysqli_query($bcon , "create table if not exists " .$st . "(ID int(5) primary key , Name varchar(50) , Price real , Quantity int ,Total_Price real)")))
								echo "create table error";
						$fdrTra = fopen($s,"r");
						if(!($q = mysqli_query($bcon , "delete from ".$st." where 1")))
							echo "Previous backup cleanup error";
						while ($s = fscanf($fdrTra, "%s %s %s %s %s\n")) 
						{
	    					list ($ID,$Name,$Price,$Quantity,$Total_Price) = $s;
								echo $ID . " " . $Name . " " . $Price . " " . $Quantity . " ". $Total_Price . " <br> ";
								if(!($q = mysqli_query($bcon , "insert into " . $st ." values('$ID','$Name','$Price','$Quantity','$Total_Price')")))
									echo "backup error";
						}
					}
			}



						
					
			

			echo "<br>";
			//Items
			if(!($cq = mysqli_query($bcon , "create  table if not exists Items (IID int(6) primary key , Iname varchar(50) not null , Category varchar(50) , Price real , Discountpercentage real , Quantity int)")))
				echo "Create table Items error";
			if(!($q = mysqli_query($bcon , "delete from Items where 1")))
				echo "Previous backup cleanup error";
			echo "<b>Items recovered:</b> <br>";
			while ($s = fscanf($fdrItm, "%s %s %s %s %s %s\n")) 
			{
	    		list ($IID, $Iname, $Category,$Price,$Dis,$Quantity) = $s;
						echo $IID . " " . $Iname . " " . $Category . " " . $Price . " " . $Dis . " ". $Quantity . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Items values ('$IID','$Iname','$Category','$Price','$Dis','$Quantity')")))
							echo "backup error";
			}

			//Items end
			//Employee 
			if(!($cq = mysqli_query($bcon , "create  table if not exists Employee (ID int(5) primary key , Name varchar(50) not null , Password varchar(50))")))
				echo "Create table Employee error";
			if(!($q = mysqli_query($bcon , "delete from Employee where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <br><b>Employee details recovered:</b> <br>";
			while ($s = fscanf($fdrEmp, "%s %s %s\n")) 
			{
	    		list ($ID, $Name, $Password) = $s;
						echo $ID . " " . $Name . " " . "*****" . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Employee values ('$ID','$Name','$Password')")))
							echo "backup error";
			}
			//Employee end
			//Handle
			if(!($cq = mysqli_query($bcon , "create  table if not exists Handle (TID varchar(50) primary key , Employee varchar(50) ,Total_Price real)")))
				echo "Create table Handle error";
			if(!($q = mysqli_query($bcon , "delete from Handle where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <b>Handling Employee details recovered:</b> <br>";
			while ($s = fscanf($fdrHan, "%s %s %s\n")) 
			{
	    		list ($TID, $Employee, $Total_Price) = $s;
						echo $TID . " " . $Employee . " " . $Total_Price . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into Handle values ('$TID','$Employee','$Total_Price')")))
							echo "backup error";
			}
			//handle end
			//Customer
			if(!($cq = mysqli_query($bcon , "create  table if not exists Customer (Customer varchar(50)  , Mobile bigint(50) ,TID varchar(50) primary key)")))
				echo "Create table Customer error";
			if(!($q = mysqli_query($bcon , "delete from Customer where 1")))
				echo "Previous backup cleanup error";
			echo "<br> <b>Customer details recovered:</b> <br>";
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
			if(!($cq = mysqli_query($bcon , "create  table if not exists RecycleBin (IID int(6) primary key , Iname varchar(50) not null , Category varchar(50) , Price real , Discountpercentage real , Quantity int , DeletedBy varchar(50))")))
				echo "Create table RecycleBin error";
			if(!($q = mysqli_query($bcon , "delete from RecycleBin where 1")))
				echo "Previous backup cleanup error";
			echo "<b>Recycle Items recovered:</b> <br>";
			while ($s = fscanf($fdrRItm, "%s %s %s %s %s %s %s\n")) 
			{
	    		list ($IID, $Iname, $Category,$Price,$Discountpercentage,$Quantity,$DeletedBy) = $s;
						echo $IID . " " . $Iname . " " . $Category . " " . $Price . " " . $Quantity . " " . $DeletedBy . " <br> ";
						if(!($q = mysqli_query($bcon , "insert into RecycleBin values ('$IID','$Iname','$Category','$Price','$Discountpercentage','$Quantity','$DeletedBy')")))
							echo "backup error";
			}
			//Recycle end
		}
		else
			echo "incorrect master password";

	?>
	<form action="dbhome.html" method="POST">
		<input type='hidden' name='user' value='<?php echo "$user";?>'/> 
		<input type='hidden' name='pass' value='<?php echo "$pass";?>'/> 
		<input type='hidden' name='time' value='<?php echo "$time";?>'/> 
		<input type="submit" value="Back">
	</form>
</body>
</html>