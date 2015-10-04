<?php 

	//sleep(1);
	require '../../config.php';
	
	$row=$_POST['row'][0];
	$id=$row['id'];
	$advicestatu=$row['advicestatu'];
	$advicebb=$row['advicebb'];


	mysql_query("UPDATE easyui_advice set advicestatu='$advicestatu',advicebb='$advicebb' WHERE ID='$id' ")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>