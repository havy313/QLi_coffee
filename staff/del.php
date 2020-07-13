<?php 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
$id  = $_GET ['id'];
$query = "DELETE FROM nhanvien WHERE id_nhanvien = {$id}";
$result = $mysqli->query($query);
if($result){
    //xử lý xóa hình
    header("location:index.php?msg=Xóa nhân viên thành công");
    die();
}else {
    echo "Xóa nhân viên không thành công";
    die();
}
?>


    
