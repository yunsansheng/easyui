<?php 

	//sleep(1);
	require '../../config.php';
	
	$row=$_POST['row'][0];
	$id=$row['id'];
	$advicestatu=$row['advicestatu'];
	$advicebb=$row['advicebb'];


	// mysql_query("INSERT INTO easyui_advice (username,password,date) VALUES ('$username','$password','$date')")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>