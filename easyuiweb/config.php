<?php
	header('Content-Type:text/html; charset=utf-8');
	
	// define('DB_HOST', 'qdm17544119.my3w.com');
	// define('DB_USER', 'qdm17544119');
	// define('DB_PWD', 'yunfei1314');
	// define('DB_NAME', 'qdm17544119_db');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PWD', '');
	define('DB_NAME', 'qsones');
	$conn = @mysql_connect(DB_HOST, DB_USER, DB_PWD) or die('数据库链接失败：'.mysql_error());
	
	@mysql_select_db(DB_NAME) or die('数据库错误：'.mysql_error());
	
	@mysql_query('SET NAMES UTF8') or die('字符集错误：'.mysql_error());
?>