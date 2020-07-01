<html>
<head>
	<title>supermarket</title>
</head>
<body>
	<p>success</p>
	<form action="dbhome.html" method="POST">
	<div align="right">
		<?
			session_start();
			$user = $_GET['user'];
			echo $user;
		?>
		<input type="submit" value="Logout"></input>
	</div>
	</form>
</body>
</html>