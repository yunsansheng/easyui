


<?php
	
	require '../../config.php';
	
	// $page = $_POST['page'];
	// $pageSize = $_POST['rows'];
	// $first = $pageSize * ($page - 1);

	// $order=$_POST['order'];
	// $sort=$_POST['sort'];

	$id = $_POST['id'];
	$year = $_POST['year'];
	$month = $_POST['month'];

	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$date3=$_POST['date3'];
	$date4=$_POST['date4'];
	$date5=$_POST['date5'];
	$date6=$_POST['date6'];
	$date7=$_POST['date7'];
	$date8=$_POST['date8'];
	$date9=$_POST['date9'];
	$date10=$_POST['date10'];
	$date11=$_POST['date11'];
	$date12=$_POST['date12'];
	$date13=$_POST['date13'];
	$date14=$_POST['date14'];
	$date15=$_POST['date15'];
	$date16=$_POST['date16'];
	$date17=$_POST['date17'];
	$date18=$_POST['date18'];
	$date19=$_POST['date19'];
	$date20=$_POST['date20'];
	$date21=$_POST['date21'];
	$date22=$_POST['date22'];
	$date23=$_POST['date23'];
	$date24=$_POST['date24'];
	$date25=$_POST['date25'];
	$date26=$_POST['date26'];
	$date27=$_POST['date27'];
	$date28=$_POST['date28'];
	$date29=$_POST['date29'];
	$date30=$_POST['date30'];
	$date31=$_POST['date31'];





 // WHERE year='$year' and month='$month' and username= '$username' and status ='$status'
	$query = mysql_query("INSERT INTO easyui_habitdetail (id,year,month,date1,date2,date3,date4,date5,date6,date7,date8,date9,date10,date11,date12,date13,date14,date15,date16,date17,date18,date19,date20,date21,date22,date23,date24,date25,date26,date27,date28,,date29,date30,date31) VALUES ('$id','$year','$month','$date1','$date2','$date3','$date4','$date5','$date6','$date7','$date8','$date9','$date10','$date11','$date12','$date13','$date14','$date15','$date16','$date17','$date18','$date19','$date20','$date21','$date22','$date23','$date24','$date25','$date26','$date27','$date28','$date29','$date30','$date31')") or die('SQL 错误！');

	// $json = '';
	
	// while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
	// 	$json .= json_encode($row).',';
	// }
	
	// // $total = mysql_num_rows(mysql_query("SELECT *  FROM habitdetail"));

	// $json = substr($json, 0, -1);
	// echo '['.$json.']';
	//  // echo '{"total" : '.$total.', "rows" : ['.$json.']}';
	
	// mysql_close();
	echo mysql_affected_rows();

	mysql_close();

	
?>