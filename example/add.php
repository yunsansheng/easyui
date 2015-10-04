<?php 

	//sleep(1);
	require 'config.php';
	
	$row=$_POST['row'][0];
	$username=$row['username'];
	$password=$row['password'];
	$date=$row['date'];


	mysql_query("INSERT INTO userinfo (username,password,date) VALUES ('$username','$password','$date')")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>