<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa bài viết</h2>
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
                                $querySR = "SELECT * FROM sanpham WHERE id_sp = {$id_sp}";
                                $resultSR = $mysqli->query($querySR);
                                $arProduct = mysqli_fetch_assoc($resultSR);
                                $pictureName = $arProduct['hinhanh'];

                                if (isset($_POST['submit'])) {
                                    $ten_sp = $_POST['ten_sp'];
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
                                    $mota = $_POST['mota'];
                                    $id_loai = $_POST['id_loai'];
                                    $gia_sp = $_POST['gia_sp'];
                                    $id_size = $_POST['id_size'];
                                    $query = "UPDATE sanpham SET ten_sp = '{$ten_sp}', gia_sp = '{$gia_sp}', mota = '{$mota}',id_size = '{$id_size}', id_loai = {$id_loai}, hinhanh = '{$pictureName}' WHERE id_sp = '{$id_sp}'";
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
                                        <label>Loại</label>
                                        <select class="form-control" name="id_loai">
                                            <option value="">--Chọn loại--</option>
                                            <?php
                                            $sql = "SELECT * FROM loai";
                                            $resultSql = $mysqli->query($sql);
                                            while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                $selected = "";
                                                if ($arProduct['id_loai'] == $arCat['id_loai']) {
                                                    $selected = "selected='selected'";
                                                }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $arCat['id_loai'] ?>"><?php echo $arCat['ten_loai'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <select class="form-control" name="id_size"> 
                                        <option value="">--Chọn size--</option>
                                            <?php
                                                $sql = "SELECT * FROM size";
                                                $resultSql = $mysqli->query($sql);
                                                while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                    $selected = "";
                                                    if ($arProduct['id_size'] == $arCat['id_size']) {
                                                        $selected = "selected='selected'";
                                                    }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $arCat['id_size'] ?>"><?php echo $arCat['ten_size'] ?></option>
                                            <?php
                                                }
                                            ?>                                            
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="gia_sp" value="<?php echo $arProduct['gia_sp'] ?>" class="form-control" />
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
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="mota"><?php echo $arProduct['mota'] ?></textarea>
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