<?php 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
$story_id  = $_GET ['story_id'];
$query = "DELETE FROM story WHERE story_id = {$story_id}";
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


    
