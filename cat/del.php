<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>

<?php
	$id_loai = $_GET['id'];
	$query = "DELETE FROM  loai WHERE id_loai = {$id_loai}";
	$result = $mysqli->query($query);
	if ($result) {
		header("location:index.php?msg=Xóa thành công" );
		die();
	}else{
		echo "có lỗi khi xóa";
		die();
	}
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>