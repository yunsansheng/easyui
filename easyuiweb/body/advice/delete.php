<?php 

	//sleep(1);
	require '../../config.php';
	
	$ids=$_POST['ids'];


	mysql_query("DELETE FROM easyui_advice WHERE id in ($ids)")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>