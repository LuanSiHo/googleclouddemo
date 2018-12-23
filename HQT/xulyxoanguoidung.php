<?php
	include_once 'db_connect.php';
	$get = $_GET;
	$del = db_query_execute("delete from taikhoan where id_taikhoan=" . $get['id'] . ";");
	unset($del);
	unset($get);
	header('Location: ' . base_path('taouser.php'));
?>