
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; 
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<?php
    //tổng số dòng
    $queryTSD = "SELECT COUNT(*) AS TSD  FROM doanhthu";
    $resultTSD = $mysqli->query($queryTSD);
    $arTSD = mysqli_fetch_assoc($resultTSD);
    $TongSoDong = $arTSD['TSD'];
    //Lấy truyện trên một trang
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
                                <div class="col-sm-6">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="get" action="">
                                        <input type="submit"  value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="search" class="form-control input-sm" placeholder="Tìm kiếm" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <!-- <th>Giá</th> -->
                                        <th>Số lượng/Lần</th>
                                        <th>Tổng sản phẩm</th>
                                        <!-- <th>Hình ảnh</th> -->
                                        <th width="250px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query ='';
                                        if(isset($_GET['search'])){
                                            $search = trim($_GET['search']);
                                            if(($search)){
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM doanhthu 
                                                        WHERE ten_sp = '{$search}' GROUP BY id_sp ";
                                            } 
                                        } else {
                                                $query = "SELECT *, SUM(so_luong) tong_sp FROM doanhthu 
                                                                GROUP BY id_sp ORDER BY `tong_sp` ASC LIMIT {$offset}, {$row_count}";
                                            }
                                                $result = $mysqli->query($query);
                                                while ($arItem = mysqli_fetch_assoc($result)) {
                                                
                                    ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $arItem['id_sp'];?></td>
                                        <td><?php echo $arItem['ten_sp'];?></td>
                                        <!-- <td><?php echo $arItem['gia_sp'];?></td> -->
                                        <td style="text-align: center;"><?php echo $arItem['so_luong'];?></td>
                                        <td style="text-align: center;"><?php echo $arItem['tong_sp'];?></td>
                                        <!-- <td class="center">
                                            <?php
                                             if ($arItem['hinhanh'] != '' ) {
                                                    
                                            ?>
                                            <img src="/files/<?php echo $arItem['hinhanh'];?>" alt="" height="100px" width="100px"/>
                                            <?php 
                                                }
                                            ?>
                                        </td> -->
                                        <td class="center">
                                            <a type="" class="btn" data-toggle="modal" data-target="#staticBackdrop">
                                                <img src="/templates/admin/assets/img/icondetail.png" class=""></i></a>
                                            <a href="edit.php?id_sp=<?php echo $arItem['id_sp'] ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="del.php?id_sp=<?php echo $arItem['id_sp']?>" onclick="return confirm('Bạn có thật sự muốn xóa sản phẩm này ?')" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    <?php 
                                            }
                                    ?>
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
                            ?>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                            Launch static backdrop modal
                            </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <?php
                                    while ($arItem = mysqli_fetch_assoc($result))
                                ?>
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-bold" id="staticBackdropLabel">Trà Gần Nhau Hơn</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button> -->
                                    </div>
                                    <div class="modal-body">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Giá</th>
                                                <th>Ngày</th>
                                                <th>Ca</th>
                                                <th>Nhân viên</th>                                               
                                                <th width="160px">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <th>1</th>
                                                <th>vy</th>
                                                <th>08/07/2002</th>
                                                <th>sáng</th>
                                                <th>sfd</th>
                                                <th>sfd</th>                                               
                                            </tr>
                                            <tr class="gradeX">
                                                <th>1</th>
                                                <th>vy</th>
                                                <th>08/07/2002</th>
                                                <th>sáng</th>
                                                <th>sfd</th>
                                                <th>sfd</th>                                               
                                            </tr>
                                            <tr class="gradeX">
                                                <th>1</th>
                                                <th>vy</th>
                                                <th>08/07/2002</th>
                                                <th>sáng</th>
                                                <th>sfd</th>
                                                <th>sfd</th>                                               
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>Tổng: <span> 60kg</span> </p> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End modal -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Trang <?php echo $current_page; ?> của <?php echo $TongSoTrang; ?> truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                        <?php 
                                            if($current_page >1 && $TongSoTrang >1){
                                        ?>
                                                 <li class="paginate_button previous " aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="index.php?page=<?php echo ($current_page -1)?>">Trang trước</a></li>
                                        <?php       
                                            }
                                        ?>
                                        <?php
                                            for($i=1; $i<=$TongSoTrang; $i++){  
                                                if( $i == $current_page){
                                        ?>
                                                     <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#"><?php echo $current_page;?></a></li>
                                        <?php 
                                            }else{
                                           
                                        ?>
                                           
                                           
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                      
                                            
                                        <?php
                                            }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        <?php 
                                            if($current_page < $TongSoTrang && $TongSoTrang >1){
                                        ?>
                                               <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="index.php?page=<?php echo ($current_page +1)?>">Trang tiếp</a></li>
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
   document.getElementById("item__doanhthu").classList.add("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.remove("nav-item--active")
</script>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>
