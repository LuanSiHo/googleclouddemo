<?php
	include_once 'db_connect.php';

	$post = $_POST;

	if(isset($post['coc']) && $post['coc']==1) {
		$update_coc = db_query_execute("update hoso set hs_hoanthanhcoc=1 where id_hoso=" . $post['id_hs'] . ";");
		unset($update_coc);
	}

	if(isset($post['training']) && $post['training']==1) {
		$update_training = db_query_execute("update hoso set hs_1tuanhoc=1 where id_hoso=" . $post['id_hs'] . ";");
		unset($update_training);
	}
	
	unset($post);
	header('Location: ' . base_path('list_dauvao.php'));
?>