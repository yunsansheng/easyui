<?php
	//sleep(1);
	require 'config.php';
	
	$id=0;

	if(isset($_POST['id'])){
		$id=$_POST['id'];
	}

	$query = mysql_query("SELECT id,text,state FROM easyui_nav WHERE nid='$id' ") or die('SQL 错误！');

	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}
	

	$json = substr($json, 0, -1);
	echo '['.$json.']';

	
	mysql_close();

	
?>