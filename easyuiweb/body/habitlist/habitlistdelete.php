<?php 

	//sleep(1);
	require '../../config.php';
	
	$ids=$_POST['id'];


	mysql_query("DELETE FROM easyui_habitlist  WHERE id in ($ids) ")or die('SQL 错误！'.mysql_error());

	echo mysql_affected_rows();

	mysql_close();

 ?>