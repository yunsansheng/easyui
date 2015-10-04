<?php 

	//sleep(1);
	require '../../config.php';
	


	 $advicecontent=$_POST['inputadvice'];
	 $adviceman=$_POST['adviceman'];
	 $advicedate=$_POST['advicedate'];

	mysql_query("INSERT INTO easyui_advice (advicecontent,adviceman,advicedate) VALUES ('$advicecontent','$adviceman','$advicedate')")or die('SQL 错误！');

	echo mysql_affected_rows();

	mysql_close();

 ?>