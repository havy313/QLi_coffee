<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';

?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<?php
//tổng số dòng
$queryTSD = "SELECT COUNT(*) AS TSD  FROM nhanvien";
$resultTSD = $mysqli->query($queryTSD);
$arTSD = mysqli_fetch_assoc($resultTSD);
$TongSoDong = $arTSD['TSD'];
$row_count = ROW_COUNT;
//tổng số trang
$TongSoTrang = ceil($TongSoDong / $row_count);
//trang hiện tại
$current_page = 1;
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
}
//offset
$offset = ($current_page - 1) * $row_count;
?>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section_heading">QUẢN LÝ NHÂN VIÊN</h2>
                </div>
            </div>
            <!-- /. ROW  -->

            <?php
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <form role="form" action= "" method = "POST" enctype = "multipart/form-data">
                                            <?php 
                                                if(isset($_POST['done'])){
                                                    setcookie ("id_nhanvien", "");  
                                                    setcookie ("ten_nhanvien", "");  
                                                    setcookie ("ngay_sinh","");  
                                                    setcookie ("gioi_tinh","");  
                                                    setcookie ("phone", "");
                                                    header("Location: add.php");
                                                }
                                            ?>
                                            <button type="submit" name="done" class="btn btn-success btn-md">Thêm</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <form method="get" action="">
                                            <input type="submit" value="Tìm kiếm" class="btn btn-warning btn-sm"
                                                   style="float:right"/>
                                            <input type="search" name="search" class="form-control input-sm"
                                                   placeholder="Nhập tên của nhân viên"
                                                   style="float:right; width: 300px;"/>
                                            <div style="clear:both"></div>
                                        </form>
                                        <br/>
                                    </div>
                                </div>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên nhân viên</th>
                                        <th>Ngày sinh</th>
                                        <th>Giới tính</th>
                                        <th>Phone</th>
                                        <th>Số giờ</th>
                                        <th>Tổng lương</th>
                                        <!-- <th>Ca làm</th>
                                        <th>Ngày làm</th> -->
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- lấy ra tất cả danh mục tin -->
                                    <?php
                                    $luongH = 20000;
                                    $query = '';
                                    if (isset($_GET['search'])) {
                                        $search = trim($_GET['search']);
                                        if (($search)) {
                                            $query = "SELECT * , sum(so_gio) tong_gio  FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                                                inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                        WHERE ten_nhanvien = '{$search}'";
                                            // if(mysqli_fetch_assoc($mysqli->query($query)) == 0){
                                            //     echo "search $search";
                                            //     $query = "SELECT *, sum(so_gio) tong_gio FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                            //                 inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                            //                 where nv.phone = '{$search}' GROUP BY nv.id_nhanvien 
                                            //                 ORDER BY nv.id_nhanvien ASC LIMIT {$offset}, {$row_count}";
                                            // }
                                        }
                                    } else {
                                        $query = "SELECT *, sum(so_gio) tong_gio FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                        inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                        GROUP BY nv.id_nhanvien ORDER BY nv.id_nhanvien ASC LIMIT {$offset}, {$row_count}";
                                    }
                                    $result = $mysqli->query($query);
                                    $tongH = 0;
                                    $sumGioNV = 0;
                                    $sumSalary = 0;
                                    while ($arItem = mysqli_fetch_assoc($result)) {
                                        $id_nhanvien = $arItem['id_nhanvien'];
                                        $ten_nhanvien = $arItem['ten_nhanvien'];
                                        $ngay_sinh = date("d/m/Y", strtotime($arItem['ngay_sinh']));
                                        $phone = $arItem['phone'];
                                        $gioi_tinh = $arItem['gioi_tinh'];
                                        $so_gio = $arItem['so_gio'];
                                        $tongH = $arItem['tong_gio'];
                                        $luong_nv = $luongH * $tongH;
                                        $sumGioNV += $tongH;
                                        $sumSalary += $luong_nv;
                                        ?>
                                        <tr class="gradeX">
                                            <td style="text-align: center;"><?php echo $id_nhanvien; ?></td>
                                            <td><?php echo $ten_nhanvien; ?></td>
                                            <td style="text-align: center;"><?php echo $ngay_sinh; ?></td>
                                            <td style="text-align: center;"><?php echo $gioi_tinh; ?></td>
                                            <td style="text-align: center;"><?php echo $phone; ?></td>
                                            <td style="text-align: center;"><?php echo $tongH."h"; ?></td>
                                            <td style="text-align: center;"><?php echo number_format($luong_nv)."đ";?></td>
                                            <td class="text-center">
                                                <a type="submit" class="btn" data-toggle="modal"
                                                   data-target="#<?php echo $id_nhanvien; ?>">
                                                    <img src="/templates/admin/assets/img/icondetail.png"></i>
                                                </a>
                                                <a href="edit.php?id=<?php echo $id_nhanvien; ?>" title=""
                                                   class="btn btn-primary"><i class="fa fa-pencil "></i></a>
                                                <a href="del.php?id=<?php echo $id_nhanvien; ?>"
                                                   onclick="return confirm('Bạn có thật sự muốn xóa danh mục này?')"
                                                   title="" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="text_bold">Tổng</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text_bold"><?php echo $sumGioNV."h" ?></td>
                                        <td class="text_bold"><?php echo number_format($sumSalary)."đ";?></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php
                                if (isset($_GET['search'])) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: right;">
                                            <a href="index.php" title="" class="btn btn-primary"><i
                                                        class="fa fa-reply"></i> Trở về</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $query = '';
                                if (isset($_GET['search'])) {
                                    $search = trim($_GET['search']);
                                    if (($search)) {
                                        $query = "SELECT * , sum(so_gio) tong_gio  FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                        inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                                        WHERE ten_nhanvien = '{$search}'";
                                            // if(mysqli_fetch_assoc($mysqli->query($query)) == 0){
                                            //     echo "search $search";
                                            //     $query = "SELECT *, sum(so_gio) tong_gio FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                            //                 inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien)
                                            //                 where nv.phone = '{$search}' GROUP BY nv.id_nhanvien 
                                            //                 ORDER BY nv.id_nhanvien ASC LIMIT {$offset}, {$row_count}";
                                            // }
                                    }
                                } else {
                                    $query = "SELECT *  FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                            inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien) 
                                                            GROUP BY nv.id_nhanvien ORDER BY nv.id_nhanvien ASC LIMIT {$offset}, {$row_count}";
                                }
                                $result = $mysqli->query($query);
                                while ($arItem = mysqli_fetch_assoc($result)) {
                                    $id_nhanvien = $arItem['id_nhanvien'];
                                    ?>
                                    <div class="modal fade" id="<?php echo $id_nhanvien; ?>" data-backdrop="static"
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
                                                        id="staticBackdropLabel"><?php echo $arItem['ten_nhanvien']; ?></h5>

                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Ngày làm</th>
                                                            <th>Ca</th>
                                                            <th>Giờ bắt đầu</th>
                                                            <th>Giờ kết thúc</th>
                                                            <th>Số giờ</th>
                                                            <th>Lương</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $queryDB = "SELECT *  FROM ((giolam gl inner join ca on ca.id_ca = gl.id_ca)
                                                                                    inner join nhanvien nv  on  nv.id_nhanvien = gl.id_nhanvien) 
                                                                            WHERE nv.id_nhanvien = $id_nhanvien  order by  ngay_lam ASC";
                                                        $resultDB = $mysqli->query($queryDB); 
                                                        $tongGio = 0;
                                                        $tongLuong = 0;
                                                        while ($arItem = mysqli_fetch_assoc($resultDB)) {
                                                            $ngay_lam = date("d/m/Y", strtotime($arItem['ngay_lam']));
                                                            $ten_ca = $arItem['ten_ca'];
                                                            $bat_dau = $arItem['bat_dau'];
                                                            $ket_thuc = $arItem['ket_thuc'];
                                                            $so_gio = $arItem['so_gio'];
                                                            $luongCa = $so_gio * $luongH;
                                                            $tongGio += $so_gio;
                                                            $tongLuong += $luongCa;
                                                            ?>
                                                            <tr class="gradeX">
                                                                <th><?php echo $ngay_lam; ?></th>
                                                                <th><?php echo $ten_ca; ?></th>
                                                                <th><?php echo $bat_dau; ?></th>
                                                                <th><?php echo $ket_thuc; ?></th>
                                                                <th><?php echo $so_gio."h"; ?></th>
                                                                <th><?php echo number_format($luongCa)."đ";?></th>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    <p class="text_stong"><b>Số giờ làm: </b><span><?php echo $tongGio."h";?></span></p>
                                                    <p class="text_stong">
                                                        <b>Lương: </b><span><?php echo number_format($tongLuong)."đ";?></span></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_info" id="dataTables-example_info"
                                             style="margin-top:27px">Trang <?php echo $current_page; ?>
                                            của <?php echo $TongSoTrang; ?> trang nhân viên
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="dataTables-example_paginate">
                                            <ul class="pagination">
                                                <?php
                                                if ($current_page > 1 && $TongSoTrang > 1) {
                                                    ?>
                                                    <li class="paginate_button previous "
                                                        aria-controls="dataTables-example" tabindex="0"
                                                        id="dataTables-example_previous"><a
                                                                href="index.php?page=<?php echo($current_page - 1) ?>">Trang
                                                            trước</a></li>
                                                    <?php
                                                }
                                                for ($i = 1; $i <= $TongSoTrang; $i++) {
                                                    if ($i == $current_page) {
                                                        ?>
                                                        <li class="paginate_button active"
                                                            aria-controls="dataTables-example" tabindex="0"><a
                                                                    href="#"><?php echo $current_page; ?></a></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="paginate_button " aria-controls="dataTables-example"
                                                            tabindex="0"><a
                                                                    href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                if ($current_page < $TongSoTrang && $TongSoTrang > 1) {
                                                    ?>
                                                    <li class="paginate_button next" aria-controls="dataTables-example"
                                                        tabindex="0" id="dataTables-example_next"><a
                                                                href="index.php?page=<?php echo($current_page + 1) ?>">Trang
                                                            tiếp</a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById("item__trangchu").classList.remove("nav-item--active")
        document.getElementById("item__danhmuc").classList.remove("nav-item--active")
        document.getElementById("item__thucdon").classList.remove("nav-item--active")
        document.getElementById("item__nguoidung").classList.remove("nav-item--active")
        document.getElementById("item__doanhthu").classList.remove("nav-item--active")
        document.getElementById("item__nhanvien").classList.add("nav-item--active")
        document.getElementById("item__lienhe").classList.remove("nav-item--active")
    </script>
    <!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>