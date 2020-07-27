<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa doanh thu</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                //Lấy thông tin story
                                $id_sp = $_GET['id_sp'];
                                $querySR = "SELECT * FROM doanhthu WHERE id_sp = {$id_sp}";
                                $resultSR = $mysqli->query($querySR);
                                $arProduct = mysqli_fetch_assoc($resultSR);
                                $pictureName = $arProduct['hinhanh'];

                                if (isset($_POST['submit'])) {
                                    $ten_sp = $_POST['ten_sp'];
                                    
                                    $so_luong = $_POST['so_luong'];
                                    $id_nhanvien = $_POST['id_nhanvien'];
                                    $id_ca = $_POST['id_ca'];
                                    $ngay_mua = $_POST['ngay_mua'];
                                    $picture = $_FILES['hinhanh'];
                                    if (isset($picture['name']) && $picture['name'] != '') {
                                        unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName);
                                        //Xử lý up hình ảnh
                                        $fileName = $picture['name'];
                                        $arFileName = explode('.', $fileName);
                                        $fileType = strtolower(end($arFileName));
                                        $pictureName = "menu-" . time() . "." . $fileType;
                                        $tmpName = $picture['tmp_name'];
                                        $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName;
                                        $resultUpload = move_uploaded_file($tmpName, $pathUpload);
                                    }
                                    $query = "UPDATE sanpham SET ten_sp = '{$ten_sp}', so_luong = '{$so_luong}', id_nhanvien = {$id_nhanvien}, 
                                                id_ca = '{$id_ca}', ngay_mua = '{$ngay_mua}' WHERE id_sp = '{$id_sp}'";
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
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="ten_sp" value="<?php echo $arProduct['ten_sp'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="text" name="gia_sp" value="<?php echo $arProduct['so_luong'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nhân viên</label>
                                        <select class="form-control" name="id_nhanvien">
                                            <option value="">--Nhân viên--</option>
                                            <?php
                                            $sql = "SELECT * FROM nhanvien";
                                            $resultSql = $mysqli->query($sql);
                                            while ($arStaff = mysqli_fetch_assoc($resultSql)) {
                                                $selected = "";
                                                if ($arProduct['id_nhanvien'] == $arStaff['id_nhanvien']) {
                                                    $selected = "selected='selected'";
                                                }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $arStaff['id_nhanvien'] ?>"><?php echo $arStaff['ten_nhanvien'] ?></option>
                                            <?php
                                                }  
                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ca</label>
                                        <input type="text" name="id_ca" value="<?php echo $arProduct['id_ca'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày mua</label>
                                        <input type="text" name="ngay_mua" value="<?php echo $arProduct['ngay_mua'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" />
                                        <?php
                                        if ($arProduct['hinhanh'] != '') {
                                            echo "<img src='/files/{$arProduct['hinhanh']}' style='width: 100px;margin-top: 10px'></img>";
                                        }
                                        ?>
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