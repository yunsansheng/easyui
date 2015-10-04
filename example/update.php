<?php 

	//sleep(1);
	require 'config.php';
	
	$row=$_POST['row'][0];
	$id=$row['id'];
	$username=$row['username'];
	$password=$row['password'];
	$date=$row['date'];


	mysql_query("UPDATE userinfo set username='$username',password='$password',date='$date' WHERE ID='$id' ")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>