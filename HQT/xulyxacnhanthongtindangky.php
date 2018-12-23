<?php
	include_once 'db_connect.php';

	$post = $_POST;
	$mess = 'failed';

	$acc = db_query_load_data("select * from tunghiepsinh where tns_cmnd='" . $post['cmnd'] . "';");

	if(empty($acc)) {
		$time = strtotime($post['ngaysinh']);

		//trong nay co 2 query co the su dung store procedure.
		$add_new = db_query_execute("insert into tunghiepsinh(tns_hoten, tns_ngaysinh, tns_gioitinh, tns_cmnd, tns_email, tns_sodt, tns_diachi, tns_id_quocgia) values('" . $post['hoten'] . "', '" . $time . "', " . $post['gioitinh'] . ", '" . $post['cmnd'] . "', '" . $post['email'] . "', '" . $post['sdt'] . "', '" . $post['diachi'] . "', " . $post['quocgia'] . ");");
		if($add_new) {
			$del = db_query_execute("delete from dangky_tns where id_dk='" . $post['id_dk'] . "';");
			$mess = 'success';
			unset($add_new);
		}
	}
	unset($post);
	header('Location: ' . base_path('list.php' . '?mess=' . $mess));
?>