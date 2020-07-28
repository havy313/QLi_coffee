<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">SỬA THÔNG TIN NHÂN VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $id_nhanvien = $_GET['id'];
                                $querySR = "SELECT * FROM nhanvien WHERE id_nhanvien = {$id_nhanvien}";
                                $resultSR = $mysqli->query($querySR);
                                $arProduct = mysqli_fetch_assoc($resultSR);

                                if (isset($_POST['submit'])) {
                                    $ten_nhanvien = $_POST['ten_nhanvien'];
                                    $id_ca = $_POST['id_ca'];
                                    $ngay = $_POST['ngay'];
                                    $phone = $_POST['phone'];
                                    $query = "UPDATE nhanvien SET ten_nhanvien = '{$ten_nhanvien}', id_ca = '{$id_ca}',ngay = '{$ngay}' WHERE id_nhanvien = '{$id_nhanvien}'";
                                    $result = $mysqli->query($query);
                                    if ($result) {
                                        header("Location: index.php?msg=Sửa dữ liệu thành công!");
                                        die();
                                    } else {
                                        echo "Sửa dữ liệu không thành công";
                                        die();
                                    }
                                }
                                ?>
                                <form role="form" action="" method="POST" id="form-menu" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Tên nhân viên</label>
                                        <input type="text" name="ten_nhanvien" value="<?php echo $arProduct['ten_nhanvien'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Ca</label>
                                        <select class="form-control" name="id_ca">
                                            <option value="">--Chọn ca làm--</option>
                                            <?php
                                            $sql = "SELECT * FROM ca";
                                            $resultSql = $mysqli->query($sql);
                                            while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                $selected = "";
                                                if ($arProduct['id_ca'] == $arCat['id_ca']) {
                                                    $selected = "selected='selected'";
                                                }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $arCat['id_ca'] ?>"><?php echo $arCat['ten_ca'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày làm </label>
                                        <input type="date" name="ngay" value="<?php echo $arProduct['ngay'] ?>"></input>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?php echo $arProduct['phone'] ?>" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Cập nhật</button>
                                    <a class="btn btn-danger" href="index.php" role="button">Trở về</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>