<?php
	session_start();
	require 'config.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = mysql_query("SELECT id FROM userinfo WHERE username='$username' AND password='$password' LIMIT 1") or die('SQL 错误！');
	
	if (!!mysql_fetch_array($query, MYSQL_ASSOC)) {
		$_SESSION['admin'] = $username;
		echo 1;
	} else {
		echo 0;
	}
	
?>