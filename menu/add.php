<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">Thêm Sản Phẩm</h2>
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
                                    if(isset($_POST['submit'])){
                                        $ten_sp = $_POST['ten_sp'];
                                        $pictureName = "";
                                        $picture = $_FILES['hinhanh'];
                                        if(isset($picture['name']) && $picture['name'] != ''){
                                            //xử lý up hình ảnh 
                                            $fileName = $picture['name'];
                                            $arFileName = explode('.', $fileName);
                                            $fileType = strtolower(end($arFileName));
                                            $pictureName = "menu-". time(). ".". rand(1,100). ".".$fileType;
                                            $tmpName = $picture['tmp_name'];
                                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName;
                                            $resultUpload = move_uploaded_file($tmpName, $pathUpload);
                                        }
                                        $mota = $_POST['mota'];
                                        $id_loai = $_POST['id_loai'];
                                        $gia_sp = $_POST['gia_sp'];
                                        $id_size = $_POST['id_size'];
                                        $query = "INSERT INTO sanpham (ten_sp, gia_sp, mota,id_size, id_loai, hinhanh) VALUE ('{$ten_sp}','{$gia_sp}','{$mota}', '{$id_size}',{$id_loai},'{$pictureName}')";
                                        $result = $mysqli->query($query);
                                        if($result){
                                            header("location:index.php?msg=Thêm dữ liệu thành công");
                                            die();

                                        }else {
                                            echo "Thêm không thành công";
                                            die();
                                        }                               
                                    }
                                ?>
                                <form role="form" action= "" method = "POST" enctype = "multipart/form-data">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="ten_sp" class="form-control" required="required"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select class="form-control" name="id_loai" required="required"> 
                                                <option value = "">---Chọn loại---</option>
                                                <?php
                                                    $sql = "SELECT * FROM loai";
                                                    $resultSql =$mysqli->query($sql);
                                                    while($arCat = mysqli_fetch_assoc($resultSql)){
                                                ?>  
                                                <option value = "<?php echo $arCat['id_loai']?>"><?php echo $arCat['ten_loai']?></option>
                                                <?php
                                                   }
                                                ?>                                                
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <select class="form-control" name="id_size" required="required"> 
                                                <option value = "">---Chọn size---</option>
                                                <?php
                                                    $sql = "SELECT * FROM size";
                                                    $resultSql =$mysqli->query($sql);
                                                    while($arSize = mysqli_fetch_assoc($resultSql)){
                                                ?>  
                                                <option value = "<?php echo $arSize['id_size']?>"><?php echo $arSize['ten_size']?></option>
                                                <?php
                                                   }
                                                ?>                                                
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="gia_sp" class="form-control" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="mota" required="required"></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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