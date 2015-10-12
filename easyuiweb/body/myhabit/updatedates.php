
<?php 

session_start();
 ?>


<?php 

	//sleep(1);
	require '../../config.php';


	$habitid = $_POST['id'];


	$username = $_SESSION['admin'];

	// $year = mysql_query("select year from select_time WHERE username= '$username'  ");
	// $month = mysql_query("select month from select_time WHERE username= '$username'  ");

	$query1 = mysql_query("select year from select_time WHERE username= '$username' ");
	$year = mysql_result($query1,0);

	$query2 = mysql_query("select month from select_time WHERE username= '$username' ");
	$month = mysql_result($query2,0);

	// echo $year.$month;
	// mysql_num_rows

	$query3= mysql_query("select count(*) from habitdetail where habitid='$habitid' and year='$year' and month='$month' ");
	$num = mysql_result($query3,0);
	echo $num;


	
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


		// mysql_query("INSERT INTO easyui_advice (username,password,date) VALUES ('$username','$password','$date')")or die('SQL 错误！');

	// 如果id存在update 如果不存在 inserte
	if($num==0){
		echo '执行insert' ;
		//mysql_query(" INSERT INTO habitdetail (id,date1,date2) VALUES ('$id','$date1','$date2') ")or die('SQL 新增错误！');
		mysql_query(" INSERT INTO habitdetail (habitid,year,month,date1,date2,date3,date4,date5,date6,date7,date8,date9,date10,date11,date12,date13,date14,date15,date16,date17,date18,date19,date20,date21,date22,date23,date24,date25,date26,date27,date28,date29,date30,date31) VALUES('$habitid','$year','$month','$date1','$date2','$date3','$date4','$date5','$date6','$date7','$date8','$date9','$date10', '$date11','$date12','$date13','$date14','$date15','$date16','$date17','$date18','$date19','$date20','$date21','$date22','$date23','$date24','$date25','$date26','$date27','$date28','$date29','$date30','$date31' )  ")or die('SQL 新增错误！');
	}else{
		echo '执行update';
		mysql_query("UPDATE habitdetail set date1='$date1',date2='$date2',date2='$date2',date3='$date3',date4='$date4',date5='$date5',date6='$date6',date7='$date7',date8='$date8',date9='$date9',date10='$date10',date11='$date11',date12='$date12',date13='$date13',date14='$date14',date15='$date15',date16='$date16',date17='$date17',date18='$date18',date19='$date19',date20='$date20',date21='$date21',date22='$date22',date23='$date23',date24='$date24',date25='$date25',date26='$date26',date27='$date27',date28='$date28',date29='$date29',date30='$date30',date31='$date31' WHERE habitid='$habitid' and month='$month' and year='$year' ")or die('SQL 错误！');
	}






	// mysql_query("UPDATE habitdetail set date1='$date1',date2='$date2',date2='$date2',date3='$date3',date4='$date4',date5='$date5',date6='$date6',date7='$date7',date8='$date8',date9='$date9',date10='$date10',date11='$date11',date12='$date12',date13='$date13',date14='$date14',date15='$date15',date16='$date16',date17='$date17',date18='$date18',date19='$date19',date20='$date20',date21='$date21',date22='$date22',date23='$date23',date24='$date24',date25='$date25',date26='$date26',date27='$date27',date28='$date28',date29='$date29',date30='$date30',date31='$date31' WHERE ID='$id' ")or die('SQL 错误！');

	// echo mysql_affected_rows();

	mysql_close();

 ?>