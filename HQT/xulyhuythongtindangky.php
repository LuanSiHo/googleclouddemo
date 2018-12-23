<?php
	include_once 'db_connect.php';
	$get = $_GET;
	$del = db_query_execute("delete from dangky_tns where id_dk=" . $get['id'] . ";");
	unset($del);
	unset($get);
	header('Location: ' . base_path('list.php'));
?>