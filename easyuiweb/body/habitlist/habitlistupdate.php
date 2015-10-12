

	<?php 
		session_start();
	 ?>



<?php 

	//sleep(1);
	require '../../config.php';
	
	// $row=$_POST['row'][0];
	// $id=$row['id'];
	// $advicestatu=$row['advicestatu'];
	// $advicebb=$row['advicebb'];
	$id=$_POST['id'];
	$status=$_POST['status'];
	$habitcontent=$_POST['habitcontent'];
	$start_time=$_POST['start_time'];
	$username =$_SESSION['admin'];

	mysql_query("UPDATE easyui_habitlist set status='$status',habitcontent='$habitcontent',start_time='$start_time',username='$username' WHERE ID='$id' ")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>