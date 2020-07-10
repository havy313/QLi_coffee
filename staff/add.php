<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Nhân Viên</h2>
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
                                    if(isset($_POST['submit'])){
                                        $ten_nhanvien = $_POST['ten_nhanvien'];
                                        $ca = $_POST['ca'];
                                        $time = $_POST['Time'];
                                        $phone = $_POST['phone'];
                                        $query = "INSERT INTO nhanvien (ten_nhanvien, ca, Time, phone) VALUE ('{$ten_nhanvien}','{$ca}','{$time}', '{$phone}')";
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
                                        <label>Tên nhân viên</label>
                                        <input type="text" name="ten_nhanvien" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Ca làm</label>
                                        <select class="form-control" name="id_loai"> 
                                                <option value = "">---Chọn ca---</option>
                                                <?php
                                                    $sql = "SELECT * FROM ca";
                                                    $resultSql =$mysqli->query($sql);
                                                    while($arCat = mysqli_fetch_assoc($resultSql)){
                                                ?>  
                                                <option value = "<?php echo $arCat['id_ca']?>"><?php echo $arCat['ten_ca']?></option>
                                                <?php
                                                   }
                                                ?>                                                
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Time</label>
                                        <input type="text" name="Time" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" />
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