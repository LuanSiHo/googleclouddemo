<?php
	include_once 'db_connect.php';

	$post = $_POST;
	

	if(!empty($post)) {
		$hs_data = db_query_load_data("select * from hoso where id_hoso=" . $post['id_hs'] . ";");
		if(!empty($hs_data)) {
			//nếu rớt.
			if($post['kq'] == 0) {
				$solanrot = $hs_data[0][6] + 1;
				$update_hs = db_query_execute("update hoso set hs_ketquaphongvan=0, hs_solanrot=" . $solanrot . " where id_hoso=" . $post['id_hs'] . ";");
			} else {
				$update_hs = db_query_execute("update hoso set hs_ketquaphongvan=" . $post['kq'] . ", id_donhang=" . $post['donhang'] . " where id_hoso=" . $post['id_hs'] . ";");
			}
		}
		
	}
	unset($post);
	header('Location: ' . base_path('list_phongvan.php'));
?>