<?php
	session_start();
	require '../../config.php';
	
	// $page = $_POST['page'];
	// $pageSize = $_POST['rows'];
	// $first = $pageSize * ($page - 1);

	// $order=$_POST['order'];
	// $sort=$_POST['sort'];


	$year =$_POST['year'];
	$month =$_POST['month'];
	$username =$_SESSION['admin'];
	// $status =$_POST['status'];




 // WHERE year='$year' and month='$month' and username= '$username' and status ='$status'
    if ($username=='one'){
	$query = mysql_query("select a.id,a.status,a.habitcontent,a.start_time,a.username,b.date1,b.date2,b.date3,b.date4,b.date5,b.date6,b.date7,b.date8,b.date9,b.date10,b.date11,b.date12,b.date13,b.date14,b.date15,b.date16,b.date17,b.date18,b.date19,b.date20,b.date21,b.date22,b.date23,b.date24,b.date25,b.date26,b.date27,b.date28,b.date29,b.date30,b.date31 
	from easyui_habitlist as a left join (select * from habitdetail where habitdetail.year='$year' and habitdetail.month='$month'  ) as b  on a.id=b.habitid where a.username in ('one','sandy')   ") or die('SQL22 错误！');
    }else{
	$query = mysql_query("select a.id,a.status,a.habitcontent,a.start_time,a.username,b.date1,b.date2,b.date3,b.date4,b.date5,b.date6,b.date7,b.date8,b.date9,b.date10,b.date11,b.date12,b.date13,b.date14,b.date15,b.date16,b.date17,b.date18,b.date19,b.date20,b.date21,b.date22,b.date23,b.date24,b.date25,b.date26,b.date27,b.date28,b.date29,b.date30,b.date31 
	from easyui_habitlist as a left join (select * from habitdetail where habitdetail.year='$year' and habitdetail.month='$month'  ) as b  on a.id=b.habitid  where a.username='$username' ") or die('SQL22 错误！');
	}
	

	// select * from a1 a left join (select * from a2 where a2.cc='3') b on a.aa=b.cc;

	$json = '';
	
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		$json .= json_encode($row).',';
	}
	
	// $total = mysql_num_rows(mysql_query("SELECT *  FROM habitdetail"));

	$json = substr($json, 0, -1);
	echo '['.$json.']';
	 // echo '{"total" : '.$total.', "rows" : ['.$json.']}';
	


	 mysql_query("UPDATE select_time set year='$year',month='$month' WHERE username='$username'  ") or die('SQL1 错误！');
	
	mysql_close();

	
?>