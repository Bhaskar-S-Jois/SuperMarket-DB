<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>

</body>
</html>
<?php
			$ID = $_POST['ID'];
			$login = $_POST['user'];
			$pass = $_POST['pass'];
			$pass1 = $_POST['pass1'];
			$con = mysqli_connect("localhost","root","","smdb");
			if($pass == $pass1)
			{
				if(mysqli_query($con,"insert into Employee values ('$ID','$login','$pass')"))
				echo "Login created successfully";
				else
				echo "User " . $login . " already exist or ID has been taken";
			}
			else
			{
				echo "Password mismatch";
				?>
				<br>
				<a href="login_signup.html">Try again</a>
				<?php

			}
?>
<br>
<a href="dbhome.html">Home</a>