<?php
 	$localhost = 'localhost';
 	$username = 'root';
<<<<<<< HEAD
 	$password = '12345';
 	$database = 'lalalalala';
=======
 	$password = '308trungthuc';
 	$database = 'starbucks';
>>>>>>> 0a5496bcbba729f989eda2f21d687cd724abf61c

 	$mysqli = new mysqli($localhost, $username, $password, $database);
 	$mysqli->set_charset('utf8');
 	if (mysqli_connect_errno()){
 		echo 'Có lỗi khi kết nối database: '. mysqli_connect_error();
 		die();
 	}
?>