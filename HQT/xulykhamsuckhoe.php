<?php
	include_once 'db_connect.php';

	$post = $_POST;
	
	/**
	 * neu kq_khamsk == 1 tạo mới dữ liệu hồ sơ cbị fỏng vấn, update stt = 1.
	 * neu kq_khamsk == 0 update số lần khám sức khoẻ tăng thêm 1.
	 */

	if(isset($post['id_tns'])) {
		$data = db_query_load_data("select * from tns_camket_khamsk where id_tns=" . $post['id_tns'] . ";");
		if(!empty($data)) {
			if($post['kq_khamsk'] == 0) {
				$solankham = $data[0][3] + 1;
				$update = db_query_execute("update tns_camket_khamsk set solankhamsk=" . $solankham . " where id_camket_khamsk=" . $data[0][0] . ";");
				unset($update);
				unset($solankham);

			} else {
				$update = db_query_execute("update tns_camket_khamsk set status=1 where id_camket_khamsk=" . $data[0][0] . ";");
				$insert = db_query_execute("insert into hoso(id_tns) values(" . $post['id_tns'] . ");");
				unset($insert);
				unset($update);
			}
		}
	}
	unset($post);
	header('Location: ' . base_path('list_cankhamsk.php'));
?>