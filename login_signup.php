<html>
<head>
	<title>Sign up</title>
		<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
	
	<?php
		$f=0;
		if(!($con = mysqli_connect("localhost","root","")))
			echo "error in connection";
		// else if(!($con = mysqli_connect("localhost","root","","smdb")))
		// 	echo "error in connection";
		if(!($q = mysqli_query($con , "show databases")))
			echo "Database query error";
		while($row = mysqli_fetch_array($q))
		{
			if($row['Database']=="smdb")
				$f=1;
		}
		if($f==1)
		{
			if(!($con = mysqli_connect('localhost','root','','smdb')))
				echo "Database connection refused";
			echo "Employee list :<br>";
			$q = mysqli_query($con , "select * from Employee");
			while($row = mysqli_fetch_array($q))
			{
				echo "ID : " . $row['ID'];
				echo " Name : " .$row['Name'];	
				echo "<br>";	
			}
			?>
			<form action="login_create.php" method="POST">
			<div align="left">
			<p>Sign in</p>
			<input type="number" name="ID" placeholder="user ID"></input><br>
			<input type="text" name="user" placeholder="user"></input><br>
			<input type="password" name="pass" placeholder="password"></input><br>
			<input type="password" name="pass1" placeholder="confirm password"></input><br>
			<input id="submit" name="submit" type="submit" value="Submit">
			</div>
			</form>
			<?php
		}
		else
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

	?> 
</body>
</html>