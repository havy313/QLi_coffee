
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; 
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<?php
    //tổng số dòng
    $queryTSD = "SELECT COUNT(*) AS TSD  FROM doanhthu";
    $resultTSD = $mysqli->query($queryTSD);
    $arTSD = mysqli_fetch_assoc($resultTSD);
    $TongSoDong = $arTSD['TSD'];
    $row_count = ROW_COUNT;
    //tổng số trang
    $TongSoTrang = ceil($TongSoDong/$row_count);
    //trang hiện tại
    $current_page = 1;
    if(isset($_GET['page'])){
            $current_page = $_GET['page']; 
    }
    //offset
    $offset = ($current_page-1)* $row_count;
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">QUẢN LÝ DOANH THU</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-12" style="text-align: right;">
                                    <form method="get" action="">
                                        <input type="submit"  value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="search" class="form-control input-sm" placeholder="Nhập tên hoặc danh mục của sản phẩm" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Số lượng SP</th>
                                        <th>Đơn giá</th>
                                        <th>Giá tổng</th>
                                        <th>Hình ảnh</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query ='';
                                        $tong = 0;
                                        $tong_SL = 0;
                                        if(isset($_GET['search'])){
                                            $search = trim($_GET['search']);
                                            if(($search)){
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM ((doanhthu dt 
                                                                    inner join sanpham sp on dt.id_sp = sp.id_sp)
                                                                    inner join loai  on  sp.id_loai= loai.id_loai)
                                                                    WHERE dt.ten_sp = '{$search}'  
                                                                    GROUP BY dt.id_sp ORDER BY `tong_sp` DESC";
                                                if(mysqli_fetch_assoc($mysqli->query($query)) == 0){
                                                    $query = "SELECT *, SUM(so_luong) tong_sp FROM ((doanhthu dt 
                                                                        inner join sanpham sp on dt.id_sp = sp.id_sp)
                                                                        inner join loai  on  sp.id_loai= loai.id_loai)
                                                                        WHERE loai.ten_loai = '{$search}' 
                                                                        GROUP BY dt.id_sp ORDER BY `tong_sp` DESC "; 
                                                }
                                            } 
                                        } else {
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM ((doanhthu dt 
                                                                    inner join sanpham sp on dt.id_sp = sp.id_sp)
                                                                    inner join loai  on  sp.id_loai= loai.id_loai)
                                                                    GROUP BY dt.id_sp ORDER BY `tong_sp` DESC LIMIT {$offset}, {$row_count}";
                                            }
                                                $result = $mysqli->query($query);
                                                while ($arItem = mysqli_fetch_assoc($result)) {
                                                    $id_sp =  $arItem['id_sp'];
                                                    $ten_sp = $arItem['ten_sp'];
                                                    $ten_loai = $arItem['ten_loai'];
                                                    $tong_sp = $arItem['tong_sp'];
                                                    $gia_sp = $arItem['gia_sp'];
                                                    $gia_tong = $gia_sp * $tong_sp;
                                                    $hinh_anh = $arItem['hinhanh'];
                                                    $tong_SL +=  $tong_sp;
                                                    $tong += $gia_tong;    
                                    ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $id_sp;?></td>
                                            <td><?php echo $ten_sp;?></td>
                                            <td><?php echo $ten_loai;?></td>
                                            <td style="text-align: center;"><?php echo $tong_sp;?></td>
                                            <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($gia_sp);
                                                    echo "đ";
                                                ?>
                                            </td>
                                            <td style="text-align: center;"><?php echo number_format($gia_tong); echo "đ";?></td>
                                            <td style="text-align: center;">
                                                <?php
                                                if ( $hinh_anh != '' ) {
                                                        
                                                ?>
                                                <img src="/files/<?php echo $hinh_anh;?>" alt="" height="100px" width="100px"/>
                                                <?php 
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                    <a type="submit" class="btn" data-toggle="modal" data-target="#<?php echo $id_sp;?>">
                                                        <img src="/templates/admin/assets/img/icondetail.png"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    <?php 
                                            }
                                    ?>
                                    <tr class="gradeX">
                                            <td class="text_bold">Tổng: </td>
                                            <td></td>
                                            <td></td>
                                            <td class="text_bold"><?php echo $tong_SL?></td>
                                            <td></td>
                                            <td class="text_bold"><?php echo number_format($tong); echo "đ"?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                            <?php 
                                if(isset($_GET['search'])){
                            ?>
                            <div class="row">
                                <div class="col-sm-12" style="text-align: right;">
                                    <a href="index.php" title="" class="btn btn-primary"><i class="fa fa-reply"></i> Trở về</a>    
                                </div>
                            </div>
                            <?php 
                                }
                                        $query ='';
                                        if(isset($_GET['search'])){
                                            $search = trim($_GET['search']);
                                            if(($search)){
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM doanhthu dt 
                                                            inner join sanpham sp on dt.id_sp = sp.id_sp
                                                            WHERE dt.ten_sp = '{$search}' GROUP BY dt.id_sp";
                                            } 
                                        } else {
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM doanhthu dt inner join sanpham sp on dt.id_sp = sp.id_sp
                                                GROUP BY dt.id_sp ORDER BY `tong_sp` ASC LIMIT {$offset}, {$row_count}";
                                            }
                                                $result = $mysqli->query($query);
                                                while ($arItem = mysqli_fetch_assoc($result)) {
                                                    $id_sp =  $arItem['id_sp'];
                            ?>
                            <!-- Modal -->
                            <div class="modal fade" id="<?php echo $id_sp;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title text-bold" id="staticBackdropLabel"><?php echo $arItem['ten_sp'];?></h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Đơn giá</th>
                                                <th>Giá tổng</th>
                                                <th>Ngày - Giờ</th> 
                                                <th>Ca</th>
                                                <th>Nhân viên</th>                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $queryDB = "SELECT * FROM ((( doanhthu dt INNER JOIN sanpham sp ON dt.id_sp = sp.id_sp)
                                                                                        INNER JOIN nhanvien nv ON nv.id_nhanvien = dt.id_nhanvien)
                                                                                        INNER JOIN ca ON dt.id_ca = ca.id_ca)
                                                                            WHERE dt.id_sp = $id_sp";
                                                $resultDB = $mysqli->query($queryDB);
                                                $tongDH = 0;       
                                                while ($arItem = mysqli_fetch_assoc($resultDB)){
                                                    $so_luong = $arItem['so_luong'];
                                                    $gia_sp   = $arItem['gia_sp'];
                                                    $gia_tong = $arItem['gia_sp'] * $arItem['so_luong'];
                                                    $ngay_mua = $arItem['ngay_mua'];
                                                    $ca = $arItem['ten_ca'];
                                                    $nhan_vien = $arItem['ten_nhanvien'];
                                                    $tongDH += $gia_tong;
                                            ?>   
                                            
                                                <tr class="gradeX">
                                                    <th><?php echo $so_luong;?></th>
                                                    <th><?php echo number_format($gia_sp); echo "đ";?></th>
                                                    <th><?php echo number_format($gia_tong); echo "đ";?></th>
                                                    <th><?php echo $ngay_mua;?></th>
                                                    <th><?php echo $ca;?></th>
                                                    <th><?php echo $nhan_vien;?></th>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                         </tbody>
                                    </table>
                                   
                                    <p class="text_stong"><b>Tổng: </b><span><?php echo number_format($tongDH); echo "đ";?></span></p> 
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- End modal -->
                            <?php 
                                }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Trang 1 của 1 trang doanh thu</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
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
   document.getElementById("item__doanhthu").classList.add("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.remove("nav-item--active")
</script>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>
