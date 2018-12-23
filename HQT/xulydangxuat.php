<?php
	include_once 'db_connect.php';
	//session_destroy();
	unset($_SESSION['user_info']);
	header('Location: ' . base_path('login.php'));
?>