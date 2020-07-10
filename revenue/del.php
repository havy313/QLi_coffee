<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>

<?php
	$cat_id = $_GET['id'];
	$query = "DELETE FROM  cat WHERE cat_id = {$cat_id}";
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