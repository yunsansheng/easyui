<?php
	//sleep(1);
	require 'config.php';
	
	$page = $_POST['page'];
	$pageSize = $_POST['rows'];
	$first = $pageSize * ($page - 1);

	$order=$_POST['order'];
	$sort=$_POST['sort'];

	$sql='';
	$username='';
	$date_from='';
	$date_to='';

	if(isset($_POST['username']) && !empty($_POST['username'])){
		$username="username LIKE '%{$_POST['username']}%' AND ";
		$sql .=$username;	
	}

	if (isset($_POST['date_from']) && !empty($_POST['date_from'])) {
		$date_from = "date>='{$_POST['date_from']}' AND ";
		$sql .= $date_from;
	}
	
	if (isset($_POST['date_to']) && !empty($_POST['date_to'])) {
		$date_to = "date<='{$_POST['date_to']}' AND ";
		$sql .= $date_to;
	}
	
	if (!empty($sql)) {
		$sql = 'WHERE '.substr($sql, 0, -4);
	}
	


	//$query = mysql_query("SELECT username,password,date FROM userinfo") or die('SQL 错误！');

	$query = mysql_query("SELECT id,username,password,date FROM userinfo $sql ORDER BY $sort $order LIMIT $first,$pageSize") or die('SQL 错误！');

	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}
	
	$total = mysql_num_rows(mysql_query("SELECT id,username,password,date FROM userinfo $sql"));

	$json = substr($json, 0, -1);
	//echo '['.$json.']';
	 echo '{"total" : '.$total.', "rows" : ['.$json.']}';
	
	mysql_close();

	
?>