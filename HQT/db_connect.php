<?php
	include 'violetq_debug/class.violetq.php';
	header('Content-Type: text/html; charset=utf-8');
	session_start();

	function connect_db_mysql() {
		$mysqli = new mysqli("localhost", "lenguyen", "123456", "hqt-csdl");
		mysqli_set_charset($mysqli, "utf8");
		if($mysqli === false) {
			die('ERROR: could not connect' . mysqli_connect_error());
		}
		return $mysqli;
	} 


	function db_query_load_data($query = '') {
		if(!empty($query)) {
			$con = connect_db_mysql();
			$result = mysqli_query($con, $query);
			mysqli_close($con);
			if($result) {
				$rows = mysqli_fetch_all($result);
				return $rows;
			}
		}
		return '';
	}

	function db_query_execute($query = '') {
		if(!empty($query)) {
			$con = connect_db_mysql();
			if($result = mysqli_query($con, $query)) {
				mysqli_close($con);
				return $result;
			}
		}
		return false;
	}

	function show_alert($mess = '') {
		if(!empty($mess)) {
			echo "<script type='text/javascript'>alert('$mess');</script>"; 
		}
	}

	function IntToDate($int = 0) {
		return date('Y-m-d', $int);
	}

	function HoanThanhKhamSK($id_tns = '') {
		if(!empty($id_tns)) {
			$data = db_query_load_data("select status from tns_camket_khamsk where id_tns=" . $id_tns . ";");
			if(!empty($data) && $data[0][0] == 1) {
				return true;
			}
		}
		return false;
	}
?>
