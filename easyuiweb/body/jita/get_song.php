<?php
session_start();
$username=$_SESSION['admin'];
require '../../config.php';




$now= date('Y-m-d');
mysql_query("update songdetail set now='$now' ");
$rs = mysql_query("select * from songdetail WHERE username='$username' order by (case status when '进行中' then 1 when '计划中' then 2 when '已完成' then 3 when '待定中' then 4 else '' end) ");
$result = array();
while($row = mysql_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>