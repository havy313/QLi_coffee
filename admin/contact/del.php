<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>

<?php 
  $contact_id = $_GET['id'];
  $query = "DELETE FROM contact WHERE contact_id = {$contact_id}";
  $result = $mysqli->query($query);
  if ($result) {
  	header("location:index.php?msg=Xóa thành công");
  	die();
  }else{
  	echo "Có lỗi khi xóa";
  	die();
  }
?>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>