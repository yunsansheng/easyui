<?php
 session_start();
include_once("codebase/connector/scheduler_connector.php");
 
$res=mysql_connect("localhost","root","");
mysql_select_db("qsones");
 

mysql_query("set character set 'utf8'");//读库
mysql_query("set names 'utf8'");//写库 

$conn = new SchedulerConnector($res);
 if($_SESSION['admin']=='one'){
$conn->render_table("events","id","start_date,end_date,text");
}else if($_SESSION['admin']=='sandy'){
$conn->render_table("events_sandy","id","start_date,end_date,text");
}

?>