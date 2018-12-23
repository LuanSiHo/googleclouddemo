<?php 
	include_once 'db_connect.php';
	$post = $_POST;
	$acc = db_query_load_data("select * from taikhoan where tk_email='" . $post['email'] . "' AND tk_password='" . $post['password'] . "';");

	if(!empty($acc[0])) {
		$user_info = $acc[0];
		$_SESSION['user_info'] = $user_info;
		header('Location: ' . base_path('list.php'));
	} else {
		header('Location: ' . base_path('login.php'));
	}
?>