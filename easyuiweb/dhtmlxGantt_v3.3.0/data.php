<?php
 session_start();
 header("Content-Type: text/html;charset=utf-8"); 
include ('codebase/connector/gantt_connector.php');
 
$res=mysql_connect("localhost","root","");
mysql_select_db("qsones");

mysql_query("set character set 'utf8'");//读库
mysql_query("set names 'utf8'");//写库 
 
$gantt = new JSONGanttConnector($res);

if($_SESSION['admin']=='one'){

$gantt->render_links("gantt_links","id","source,target,type");
$gantt->render_table(
    "gantt_tasks",
    "id",
    "start_date,duration,text,progress,sortorder,parent"
);

}else if ($_SESSION['admin']=='sandy'){

$gantt->render_links("gantt_links_sandy","id","source,target,type");
$gantt->render_table(
    "gantt_tasks_sandy",
    "id",
    "start_date,duration,text,progress,sortorder,parent"
);


}


?>