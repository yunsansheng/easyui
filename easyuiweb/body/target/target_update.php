<?php 

	//sleep(1);
	require '../../config.php';
	
	$row=$_POST['row'][0];
	$id=$row['id'];
	$start_year	=$row['start_year'];
	$end_year	=$row['end_year'];
	$target_life	=$row['target_life'];
	$target_work	=$row['target_work'];
	$target_live	=$row['target_live'];
	$target_note	=$row['target_note'];


	mysql_query("UPDATE target_long set start_year='$start_year',end_year='$end_year',target_life='$target_life',target_work='$target_work',target_live='$target_live',target_note='$target_note' WHERE ID='$id' ")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>