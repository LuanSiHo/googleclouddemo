<?php
	include_once 'db_connect.php';

	$post = $_POST;

	$check = db_query_load_data("select * from tns_camket_khamsk where id_tns=" . $post['id_tns'] . ";");

	if(empty($check)) {
		$add_new = db_query_execute("insert into tns_camket_khamsk(id_tns, dacamket) values(" . $post['id_tns'] . ", 1);");
		if($add_new) {
			unset($add_new);
		}
		unset($check);
	}
	/**
	 * kiem tra xem tu nghiep sinh nay da camket chua
	 * neu ko co du lieu thi them moi du lieu roi quay sang list kham suc khoe
	 * neu co roi thi quay lai list kham suc khoe
	 */
	unset($post);
	header('Location: ' . base_path('list_daxacnhan.php'));
?>