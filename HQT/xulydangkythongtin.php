<?php 
	include_once 'db_connect.php';

	$post = $_POST;
	$time = strtotime($post['ngaysinh']);
	$query = "insert into dangky_tns";
	$query .= "(dk_hoten, dk_gioitinh, dk_cmnd, dk_email, dk_sdt, dk_id_quocgia, dk_ngaysinh) ";
	$query .= "values('" . $post['hoten'] . "', " . $post['gioitinh'] . ", '" . $post['cmnd'] . "', '" . $post['email'] . "', '" . $post['sdt'] . "', " . $post['quocgia'] . ", '" . $time . "');";

	$exe = db_query_execute($query);
	header('Location: ' . base_path('index.php'));
?>