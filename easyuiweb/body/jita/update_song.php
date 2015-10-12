<?php

session_start();
require '../../config.php';
date_default_timezone_set('Asia/Shanghai');

$id = intval($_REQUEST['id']);
$status=$_REQUEST['status'];
$songname=$_REQUEST['songname'];
$type =$_REQUEST['type'];
$sortid =$_REQUEST['sortid'];


$input_time =$_REQUEST['input_time'];
$start_time =$_REQUEST['start_time'];

$now= date('Y-m-d');
$complete_time =$_REQUEST['complete_time'];
$review_time =$_REQUEST['review_time'];

$note =$_REQUEST['note'];
$username =$_SESSION['admin'];


$overday='';
if(!$complete_time){
		if(!$review_time){
			
		}else{
			$overday=(strtotime(date($now))-strtotime($review_time))/86400;
		}
}else{
	if(!$review_time){
			$overday=(strtotime(date($now))-strtotime($complete_time))/86400;
		}else{
			$overday=(strtotime(date($now))-strtotime($review_time))/86400;
		}
}



$sql = "update songdetail set status='$status',songname='$songname',type='$type',sortid='$sortid',input_time='$input_time',start_time='$start_time',complete_time='$complete_time',review_time='$review_time',note='$note',overday='$overday', now='$now'where id=$id";
@mysql_query($sql);
echo json_encode(array(
	'id' => $id,
	'status' => $status,
	'songname' => $songname,
	'type' => $type,
	'sortid' => $sortid,
	'input_time' => $input_time,
	'start_time' => $start_time,
	'complete_time' => $complete_time,
	'review_time' => $review_time,
	'overday' => $overday,
	'username' => $username,
	'note' => $note,
	'now' => $now
));
?>