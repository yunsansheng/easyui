<?php
require '../../config.php';
$id = intval($_REQUEST['id']);


$sql = "delete from songdetail where id=$id";
@mysql_query($sql);
echo json_encode(array('success'=>true));
?>