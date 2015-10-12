
	<?php 
		session_start();
	 ?>


<?php
	
	require '../../config.php';
	
	// $page = $_POST['page'];
	// $pageSize = $_POST['rows'];
	// $first = $pageSize * ($page - 1);

	// $order=$_POST['order'];
	// $sort=$_POST['sort'];

	$status=$_POST['status'];
	$habitcontent=$_POST['habitcontent'];
	$start_time=$_POST['start_time'];
	$username =$_SESSION['admin'];





 // WHERE year='$year' and month='$month' and username= '$username' and status ='$status'
	$query = mysql_query("INSERT INTO easyui_habitlist (status,habitcontent,start_time,username) VALUES ('$status','$habitcontent','$start_time','$username')") or die('SQL 错误！');

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