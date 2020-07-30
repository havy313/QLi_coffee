<?php 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
if(isset($_GET['id'])){
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
} else {
    $id_gl = $_GET['id_gl'];
    $query = "DELETE FROM giolam WHERE id = {$id_gl}";
    $result = $mysqli->query($query);
    if($result){
        //xử lý xóa hình
        header("location: ". $_SERVER['HTTP_REFERER']);
        // echo "Xóa giờ làm thành công";
        die();
    }else {
        echo "Xóa giờ làm không thành công";
        die();
    }
}

?>


    
