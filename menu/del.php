<?php 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
$id_sp  = $_GET ['id_sp'];
$query = "DELETE FROM sanpham WHERE id_sp = {$id_sp}";
$result = $mysqli->query($query);
if($result){
    //xử lý xóa hình
    header("location:index.php?msg=Xóa bài viết thành công");
    die();
}else {
    echo "Xóa bài viết không thành công";
    die();
}
?>


    
