<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">Thêm Nhân Viên</h2>
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
                                    if(isset($_GET['isRegister'])){
                                        $isRegister = isset($_GET['isRegister']);
                                    } else {
                                        $isRegister = false;
                                    }
                                   
                                    if(isset($_POST['add'])){
                                        $ten_nhanvien = $_POST['ten_nhanvien'];
                                        $ngay_sinh = $_POST['ngay_sinh'];
                                        $gioi_tinh = $_POST['gioi_tinh'];
                                        $phone = $_POST['phone'];
                                        $query = "INSERT INTO nhanvien (ten_nhanvien, ngay_sinh, gioi_tinh, phone) VALUE ('{$ten_nhanvien}','{$ngay_sinh}','{$gioi_tinh}', '{$phone}')";
                                        $result = $mysqli->query($query);
                                        $id_nhanvien = $mysqli->insert_id;
                                        if($result){
                                            setcookie ("id_nhanvien", $id_nhanvien, time()+ (10 * 365 * 24 * 60 * 60));  
                                            setcookie ("ten_nhanvien", $ten_nhanvien, time()+ (10 * 365 * 24 * 60 * 60));  
                                            setcookie ("ngay_sinh", $ngay_sinh, time()+ (10 * 365 * 24 * 60 * 60));  
                                            setcookie ("gioi_tinh", $gioi_tinh, time()+ ( 10 * 365 * 24 * 60 * 60));  
                                            setcookie ("phone", $phone, time()+ (10 * 365 * 24 * 60 * 60));  
                                            echo "Thêm nhân viên thành công! Hãy thêm lịch làm cho nhân viên.";
                                            $queryNV = "SELECT * FROM nhanvien where id_nhanvien ='{$id_nhanvien}'";
                                            $resultNV = $mysqli->query($queryNV);
                                            $arNV = mysqli_fetch_assoc($resultNV);
                                            // $id_nhanvien = $arNV['id_nhanvien'];
                                            header("Location: add.php?isRegister=true?id_nhanvien=$id_nhanvien");
                                        }else {
                                            setcookie ("id_nhanvien", "");
                                            setcookie ("ten_nhanvien", "");  
                                            setcookie ("ngay_sinh","");  
                                            setcookie ("gioi_tinh","");  
                                            setcookie ("phone", "");
                                            echo "Thêm nhân viên không thành công!";  
                                        }                               
                                    }
                                ?>
                                <form role="form" action= "" method = "POST" enctype = "multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="id_nhanvien" class="form-control"
                                            value="<?php if(isset($_COOKIE["id_nhanvien"])) { echo $_COOKIE["id_nhanvien"]; } ?>"/>
                                    </div>
                                    <div class="col-6 col-sm-4" id=col-6>
                                        <div class="form-group"  >
                                            <label>Tên nhân viên</label>
                                            <input type="text" name="ten_nhanvien" class="form-control"
                                                value="<?php if(isset($_COOKIE["ten_nhanvien"])) { echo $_COOKIE["ten_nhanvien"]; } ?>" required="required"/>
                                        </div>
                                        <div class="form-group" >
                                            <label>Ngày sinh</label>
                                            <input type="date" name="ngay_sinh" class="form-control"
                                            value="<?php if(isset($_COOKIE["ngay_sinh"])) { echo $_COOKIE["ngay_sinh"]; } ?>" required="required"/>
                                        </div> 
                                        <?php
                                            if($isRegister == false){
                                        ?>                                              
                                        <button type="submit" name="add" class="btn btn-success btn-md">Thêm ca làm</button>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-6 col-sm-4" id=col-6>
                                        <div class="form-group" >
                                            <label>Giới tính</label>
                                            <select class="form-control" name="gioi_tinh">
                                                <option value="" selected>Chọn giới tính</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <?php
                                                    if(isset($_COOKIE['gioi_tinh'])){
                                                ?>
                                                <option value="<?php echo $_COOKIE['gioi_tinh'];?>" selected>
                                                    <?php echo $_COOKIE['gioi_tinh'];?>
                                                </option> 
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <!-- <input type="text" name="gioi_tinh" class="form-control" -->
                                            <!-- value="<?php if(isset($_COOKIE["gioi_tinh"])) { echo $_COOKIE["gioi_tinh"]; } ?>" required="required"/> -->
                                        </div>
                                        <div class="form-group" >
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                            value="<?php if(isset($_COOKIE["phone"])) { echo $_COOKIE["phone"]; } ?>" required="required"/>
                                        </div>
                                    </div>
                                      
                                   
                                </form>
                                <?php
                                    if(isset($_COOKIE["id_nhanvien"])) { 
                                        $id_nhanvien =  $_COOKIE["id_nhanvien"];
                                    } else {
                                        $id_nhanvien = isset($_GET['id_nhanvien']);
                                    }
                                    if($isRegister){
                                        
                                ?>
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
                                            
                                            // $queryNV = "SELECT * FROM nhanvien where id_nhanvien ='{$id_nhanvien}'";
                                            // $resultNV = $mysqli->query($queryNV);
                                            // $arNV = mysqli_fetch_assoc($resultNV);
                                            // $id_nhanvien = $arNV['id_nhanvien'];

                                            $queryGL = "SELECT * FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                                    inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                                   where nv.id_nhanvien = '{$id_nhanvien}' order by  ngay_lam ASC";
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
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <a type="add" class="btn" data-toggle="modal"data-target="#<?php echo $id_nhanvien?>"class="btn btn-primary"><i class="fa fa-plus"></i> Thêm ca làm</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <form role="form" action= "" method = "POST" enctype = "multipart/form-data">
                                        <?php 
                                            if(isset($_POST['done'])){
                                                setcookie ("id_nhanvien", "");  
                                                setcookie ("ten_nhanvien", "");  
                                                setcookie ("ngay_sinh","");  
                                                setcookie ("gioi_tinh","");  
                                                setcookie ("phone", "");
                                                header("Location: index.php");
                                            } else if(isset($_POST['back'])){
                                                $deleteNV = "DELETE FROM nhanvien WHERE id_nhanvien = '{$id_nhanvien}'";
                                                $resultNV = $mysqli->query($deleteNV);
                                                $queryTime = "SELECT * FROM giolam WHERE id_nhanvien = '{$id_nhanvien}'";
                                                $resultTime = $mysqli->query($queryTime);
                                                while($arTime = mysqli_fetch_assoc($resultTime)){
                                                    $id_GL = $arTime['id'];
                                                    $deleteGL = "DELETE FROM giolam WHERE id = {$id_GL}";
                                                    $resultGL = $mysqli->query($deleteGL);
                                                }
                                                header("Location: index.php");
                                            }
                                        ?>
                                        <button type="submit" name="done" class="btn btn-success btn-md">Thêm</button>
                                        <button type="submit" name="back" class="btn btn-danger">Trở về</button>
                                    </form>
                                    <?php
                                        }
                                    ?>
                                  
                                    <!-- modal edit -->
                                    <?php
                                    if($isRegister){
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
                                                                <div class="form-group">
                                                                    <label>Ngày làm</label>
                                                                    <input type="date" name="ngay_lam"
                                                                           value="<?php echo $arTime['ngay_lam'] ?>"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Ca</label>
                                                                    <select class="form-control" name="id_ca">
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

                                                                <p class="text_stong"><b>Số giờ làm: </b><span><?php echo $so_gio;
                                                                        echo "h"; ?></span></p>
                                                                <button type="submit" name="update"
                                                                        class="btn btn-success btn-md">Cập nhật
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <!-- end modal edit -->
                                      <!-- Modal New -->
                                      <div class="modal fade" id="<?php echo $id_nhanvien?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <?php 
                                                $queryNV = "SELECT * FROM nhanvien where id_nhanvien ='{$id_nhanvien}'";
                                                $resultNV = $mysqli->query($queryNV);
                                                $arNV = mysqli_fetch_assoc($resultNV);
                                                $ten_nhanvien = $arNV['ten_nhanvien'];
                                            ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title text-bold"
                                                            id="staticBackdropLabel"><?php echo  $ten_nhanvien?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="" method="POST" id="form-menu" enctype="multipart/form-data">
                                                            <?php
                                                            if (isset($_POST['addTime'])) {
                                                                $ngay_lam = $_POST['ngay_lam'];
                                                                $id_ca = $_POST['id_ca'];
                                                                $id_nhanvien = $_POST['id_nhanvien'];
                                                                $giolam = "SELECT * FROM giolam where id_nhanvien = $id_nhanvien && id_ca = $id_ca && ngay_lam = '{$ngay_lam}'";
                                                                $resultCa = $mysqli->query($giolam);
                                                                if(mysqli_fetch_assoc($resultCa) == 0){
                                                                    $query = "INSERT INTO giolam (ngay_lam, id_ca, id_nhanvien) VALUE ('{$ngay_lam}','{$id_ca}','{$id_nhanvien}')";
                                                                    $result = $mysqli->query($query);
                                                                    if ($result) {
                                                                        setcookie ("messageCalendar","");  
                                                                        header("Location: add.php?isRegister=true?id_nhanvien=$id_nhanvien");
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
                                                            <div class="form-group">
                                                                <input type="hidden" name="id_nhanvien" class="form-control" value="<?php echo $id_nhanvien?>"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ngày làm</label>
                                                                <input type="date" name="ngay_lam" class="form-control"
                                                                       required="required"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ca</label>
                                                                <select class="form-control" name="id_ca">
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
                                                            
                                                            <p class="text_stong"><b>Số giờ làm: </b><span>5h</span></p>
                                                            <input type="submit" name="addTime" value="Thêm ca" class="btn btn-success btn-md">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- End Modal new -->
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