<?php
	include_once 'db_connect.php';

	$post = $_POST;
	$mess = 'failed';

	$acc = db_query_load_data("select * from taikhoan where tk_email='" . $post['email'] . "';");

	if(empty($acc)) {
		$add_new = db_query_execute("insert into taikhoan(tk_email, tk_password) values('" . $post['email'] . "', '" . $post['password'] . "');");
		if($add_new) {
			$mess = 'success';
		}
	}

	unset($add_new);
	unset($post);
	header('Location: ' . base_path('taouser.php') . '?mess=' . $mess);
?>