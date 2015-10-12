<?php 
	session_start();	
	//sleep(1);
	require '../../config.php';
	


	 // $advicecontent=$_POST['inputadvice'];
	 // $adviceman=$_POST['adviceman'];
	 // $advicedate=$_POST['advicedate'];

	$row=$_POST['row'][0];
	$username=$_SESSION['admin'];
	$start_year	=$row['start_year'];
	$end_year	=$row['end_year'];
	$target_life	=$row['target_life'];
	$target_work	=$row['target_work'];
	$target_live	=$row['target_live'];
	$target_note	=$row['target_note'];



	mysql_query("INSERT INTO target_long (username,start_year,end_year,target_life,target_work,target_live,target_note) VALUES ('$username','$start_year','$end_year','$target_life','$target_work','$target_live','$target_note')")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>