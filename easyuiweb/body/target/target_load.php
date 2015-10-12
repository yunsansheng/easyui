<?php 
	session_start();	

	require '../../config.php';
	

	$username=$_SESSION['admin'];

	$query = mysql_query("SELECT id,start_year,end_year,target_life,target_work,target_live,target_note,username FROM target_long  WHERE username='$username'ORDER BY  start_year,end_year ASC ") or die('SQL 错误！');

	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}
	

	$json = substr($json, 0, -1);
	echo '['.$json.']';

	
	mysql_close();


?>


