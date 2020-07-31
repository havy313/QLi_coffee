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
                                    // $messageCalendar;
                                    $querySR = "SELECT * FROM nhanvien WHERE id_nhanvien = {$id_nhanvien}";
                                    $resultSR = $mysqli->query($querySR);
                                    $arProduct = mysqli_fetch_assoc($resultSR);

                                    if (isset($_POST['submit'])) {
                                        $ten_nhanvien = $_POST['ten_nhanvien'];
                                        $ngay_sinh = $_POST['ngay_sinh'];
                                        $gioi_tinh = $_POST['gioi_tinh'];
                                        $phone = $_POST['phone'];
                                        $query = "UPDATE nhanvien SET ten_nhanvien = '{$ten_nhanvien}', ngay_sinh = '{$ngay_sinh}',gioi_tinh = '{$gioi_tinh}', phone = '{$phone}' WHERE id_nhanvien = '{$id_nhanvien}'";
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
                                    <form role="form" action="" method="POST" id="form-menu"
                                          enctype="multipart/form-data">
                                        <div class="col-6 col-sm-4" id=col-6>
                                            <div class="form-group">
                                                <label>Tên nhân viên</label>
                                                <input type="text" name="ten_nhanvien"
                                                    value="<?php echo $arProduct['ten_nhanvien'] ?>"
                                                    class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày sinh</label>
                                                <input type="text" name="ngay_sinh"
                                                    value="<?php echo $arProduct['ngay_sinh'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4" id=col-6>
                                            <div class="form-group">
                                                <label>Giới tính</label>
                                                <input type="text" name="gioi_tinh"
                                                    value="<?php echo $arProduct['gioi_tinh'] ?>" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone" value="<?php echo $arProduct['phone'] ?>"
                                                    class="form-control"/>
                                            </div>
                                        </div>
                    
                                        <table class="table table-striped table-bordered table-hover"
                                               id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th>Ngày làm</th>
                                                <th>Ca</th>
                                                <th>Giờ bắt đầu</th>
                                                <th>Giờ kết thúc</th>
                                                <th>Số giờ</th>
                                                <th width="160px">Chức năng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $queryGL = "SELECT * FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                                    inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                                    WHERE nv.id_nhanvien = {$id_nhanvien}  order by  ngay_lam ASC";
                                            $resultGL = $mysqli->query($queryGL);
                                            while ($arTime = mysqli_fetch_assoc($resultGL)) {
                                                $id_GL = $arTime['id'];
                                                $ten_nhanvien = $arTime['ten_nhanvien'];
                                                ?>
                                                <tr class="gradeX">
                                                    <td style="text-align: center;"><?php echo date("d/m/Y",strtotime($arTime['ngay_lam'])); ?></td>
                                                    <td style="text-align: center;"><?php echo $arTime['ten_ca'] ?></td>
                                                    <td style="text-align: center;"><?php echo $arTime['bat_dau']; ?></td>
                                                    <td style="text-align: center;"><?php echo $arTime['ket_thuc']; ?></td>
                                                    <td style="text-align: center;"><?php echo $arTime['so_gio']."h"; ?></td>
                                                    <td class="text-center">
                                                        <a type="edit" class="btn" data-toggle="modal" data-target="#<?php echo $id_GL; ?>" class="btn btn-primary"><i class="fa fa-pencil "></i></a>
                                                        <a href="del.php?id_gl=<?php echo $id_GL; ?>" onclick="return confirm('Bạn có thật sự muốn xóa danh mục này?')" title="" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: center;">
                                                <a type="add" data-toggle="modal"data-target="#nv<?php echo $id_nhanvien; ?>"><i class="fa fa-plus"></i> Thêm ca làm</a>
                                            </td>
                                            </tbody>
                                        </table>
                                        <p style='color: red'> <?php if(isset($_COOKIE["messageCalendar"])) { echo $_COOKIE['messageCalendar']; }?></p>
                                        <button type="submit" name="submit" class="btn btn-success btn-md">Cập nhật
                                        </button>
                                        <a class="btn btn-danger" href="index.php" role="button">Trở về</a>

                                        <!-- Modal Edit -->
                                    <?php
                                        $queryGL = "SELECT * FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                                inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                                WHERE nv.id_nhanvien = {$id_nhanvien}";
                                        $resultGL = $mysqli->query($queryGL);
                                        while ($arTime = mysqli_fetch_assoc($resultGL)) {
                                            $id_GL = $arTime['id'];
                                            $ngay_lam = date("d/m/Y", strtotime($arTime['ngay_lam']));
                                            $ten_ca = $arTime['ten_ca'];
                                            $bat_dau = $arTime['bat_dau'];
                                            $ket_thuc = $arTime['ket_thuc'];
                                            $so_gio = $arTime['so_gio'];
                                            ?>
                                            <div class="modal fade" id="<?php echo $id_GL; ?>" data-backdrop="static"
                                                 tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h5 class="modal-title text-bold"
                                                                id="staticBackdropLabel"><?php echo $arTime['ten_nhanvien']; ?></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            if (isset($_POST['update'])) {
                                                                $ngay_lam = $_POST['ngay_lam'];
                                                                $id_ca = $_POST['id_ca'];
                                                                $id_GL = $_POST['id'];
                                                                $giolam = "SELECT * FROM giolam where id_nhanvien = $id_nhanvien && id_ca = $id_ca && ngay_lam = '{$ngay_lam}'";
                                                                $resultCa = $mysqli->query($giolam);
                                                                if(mysqli_fetch_assoc($resultCa) == 0){           
                                                                    $query = "UPDATE giolam SET ngay_lam = '{$ngay_lam}', id_ca = {$id_ca} WHERE id = {$id_GL}";
                                                                    $result = $mysqli->query($query);
                                                                    if ($result) {
                                                                        setcookie ("messageCalendar","");  
                                                                        header("Location: edit.php?id=$id_nhanvien");
                                                                        die();
                                                                    } else {
                                                                        echo "Sửa dữ liệu không thành công";
                                                                        die();
                                                                    }
                                                                } else {
                                                                    $sql = "SELECT * FROM ca WHERE id_ca = '{$id_ca}'";
                                                                    $resultSql = $mysqli->query($sql);
                                                                    $arCa = mysqli_fetch_assoc($resultSql);
                                                                    $ten_ca =  $arCa['ten_ca'];
                                                                    $ngay_lam = date("d/m/Y", strtotime($ngay_lam));
                                                                    $messageCalendar = "Lịch ngày: $ngay_lam - Ca: $ten_ca đã được đăng kí!";
                                                                    setcookie ("messageCalendar", $messageCalendar, time()+ (10));  
                                                                }
                                                            }
                                                            ?>
                                                            <form role="form" action="" method="POST" id="form-menu" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id"
                                                                           value="<?php echo $arTime['id'] ?>"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label>Ngày làm</label>
                                                                    <input style="width: 100%;" type="date" name="ngay_lam"
                                                                           value="<?php echo $arTime['ngay_lam'] ?>"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label>Ca</label>
                                                                    <select class="form-control" name="id_ca" style="width: 100%;">
                                                                        <?php
                                                                        $sql = "SELECT * FROM ca";
                                                                        $resultSql = $mysqli->query($sql);
                                                                        while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                                            $selected = "";
                                                                            if ($arTime['id_ca'] == $arCat['id_ca']) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                            ?>
                                                                            <option <?php echo $selected ?>
                                                                                    value="<?php echo $arCat['id_ca'] ?>"><?php echo $arCat['ten_ca'] ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <p class="text_stong"><b>Số giờ làm: </b><span><?php echo $so_gio."h"; ?></span></p>
                                                                <button type="submit" name="update" style="float: right" class="btn btn-success btn-md" >Cập nhật
                                                                </button>
                                                                <p></p>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!-- End Modal Edit-->
                                        <!-- Modal New -->
                                        <?php
                                        $queryNV = "SELECT * FROM nhanvien WHERE id_nhanvien = {$id_nhanvien}";
                                        $resultNV = $mysqli->query($queryNV);
                                        $arNV = mysqli_fetch_assoc($resultNV);
                                        // $ten_nhanvien =  $arNV['ten_nhanvien'];
                                        //     $id_GL = $arTime['id'];
                                        ?>
                                        <div class="modal fade" id="<?php echo "nv$id_nhanvien"; ?>"
                                             data-backdrop="static" tabindex="-1" role="dialog"
                                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title text-bold"
                                                            id="staticBackdropLabel"><?php echo $arNV['ten_nhanvien']; ?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="" method="POST" id="form-menu" enctype="multipart/form-data">
                                                            <?php
                                                     
                                                            if (isset($_POST['add'])) {
                                                                $ngay_lam = $_POST['ngay_lam'];
                                                                $id_ca = $_POST['id_ca'];
                                                                $giolam = "SELECT * FROM giolam where id_nhanvien = $id_nhanvien && id_ca = $id_ca && ngay_lam = '{$ngay_lam}'";
                                                                $resultCa = $mysqli->query($giolam);
                                                                if(mysqli_fetch_assoc($resultCa) == 0){
                                                                    $query = "INSERT INTO giolam (ngay_lam, id_ca, id_nhanvien) VALUE ('{$ngay_lam}','{$id_ca}','{$id_nhanvien}')";
                                                                    $result = $mysqli->query($query);
                                                                    if ($result) {
                                                                        setcookie ("messageCalendar","");  
                                                                        header("Location: edit.php?id=$id_nhanvien");
                                                                        die();
                                                                    } else {
                                                                        echo "Sửa dữ liệu không thành công";
                                                                        die();
                                                                    }
                                                                } else {
                                                                    $sql = "SELECT * FROM ca WHERE id_ca = '{$id_ca}'";
                                                                    $resultSql = $mysqli->query($sql);
                                                                    $arCa = mysqli_fetch_assoc($resultSql);
                                                                    $ten_ca =  $arCa['ten_ca'];
                                                                    $ngay_lam = date("d/m/Y", strtotime($ngay_lam));
                                                                    $messageCalendar = "Lịch ngày: $ngay_lam - Ca: $ten_ca đã được đăng kí!";
                                                                    setcookie ("messageCalendar", $messageCalendar, time()+ (10));  
                                                                }
                                                            }

                                                            ?>
                                                            <div class="form-group col-sm-6">
                                                                <label>Ngày làm</label>
                                                                <input style="width: 100%;"type="date" name="ngay_lam" class="form-control"
                                                                       required="required"/>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label>Ca</label>
                                                                <select  style="width: 100%;" class="form-control" name="id_ca">
                                                                    <option value="">---Chọn ca---</option>
                                                                    <?php
                                                                    $sql = "SELECT * FROM ca";
                                                                    $resultSql = $mysqli->query($sql);
                                                                    while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                                        $ten_ca =  $arCat['ten_ca'];
                                                                        $selected = "";
                                                                        if ($arTime['id_ca'] == $arCat['id_ca']) {
                                                                            $selected = "selected='selected'";
                                                                        }
                                                                        ?>
                                                                        <option <?php echo $selected ?>
                                                                                value="<?php echo $arCat['id_ca'] ?>"><?php echo $arCat['ten_ca'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <p class="text_stong"><b>Số giờ làm: </b><span><?php echo $so_gio."h";; ?></span></p>
                                                            <input style="float: right;" type="submit" name="add" value="Thêm ca" class="btn btn-success btn-md">
                                                            <p></p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Modal New-->
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