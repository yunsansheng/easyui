<?php
	
	require '../../config.php';
	
	// $page = $_POST['page'];
	// $pageSize = $_POST['rows'];
	// $first = $pageSize * ($page - 1);

	// $order=$_POST['order'];
	// $sort=$_POST['sort'];


	// $year =$_POST['year'];
	// $month =$_POST['month'];
	$username =$_POST['username'];
	// $status =$_POST['status'];




 // WHERE year='$year' and month='$month' and username= '$username' and status ='$status'
	$query = mysql_query("SELECT * FROM easyui_habitlist where username='$username'  ") or die('SQL 错误！');

	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}
	
	// $total = mysql_num_rows(mysql_query("SELECT *  FROM habitdetail"));

	$json = substr($json, 0, -1);
	echo '['.$json.']';
	 // echo '{"total" : '.$total.', "rows" : ['.$json.']}';
	
	mysql_close();

	
?>