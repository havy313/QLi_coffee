<?php
 	$localhost = 'localhost:3308';
 	$username = 'root';
 	$password = '12345';
 	$database = 'starbucks';

 	$mysqli = new mysqli($localhost, $username, $password, $database);
 	$mysqli->set_charset('utf8');
 	if (mysqli_connect_errno()){
 		echo 'Có lỗi khi kết nối database: '. mysqli_connect_error();
 		die();
 	}
?>