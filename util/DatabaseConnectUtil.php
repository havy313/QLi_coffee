<?php
 	$localhost = 'localhost';
 	$username = 'root';
 	$password = '';
 	$database = 'bstory';

 	$mysqli = new mysqli($localhost, $username, $password, $database);
 	$mysqli->set_charset('utf8');
 	if (mysqli_connect_errno()){
 		echo 'Có lỗi khi kết nối database: '. mysqli_connect_error();
 		die();
 	}
?>