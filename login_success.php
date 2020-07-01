<?php
$user = $_POST['login'];
$pass = $_POST['pass'];

if($user == "abc" && $pass == "123")
	echo "success";
else
{
	//header('Location : dbhome.html');
	echo "<script type='text/javascript'> document.location = 'fail_login.html'; </script>";
}


?>