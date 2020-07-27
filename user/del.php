<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php 
 $id = $_GET['id'];
 $query = "DELETE FROM users WHERE id = {$id}";
 $result =$mysqli->query($query);
 if ($result) {
	HEADER('location:index.php?msg=Xóa thành công');
	die();

}else {
	echo "Có lỗi khi xóa người dùng";
	die();
}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>