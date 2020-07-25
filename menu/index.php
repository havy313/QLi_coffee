<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; 
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">QUẢN LÝ THỰC ĐƠN</h2>
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
                                    <form method="GET" action="">
                                        <input type="submit"  value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="text" name="search" value= "" class="form-control input-sm" placeholder="Tìm kiếm" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>
                        
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th >ID</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Size</th>
                                        <th>Giá </th>
                                        <th>Mô tả</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query ='';
                                        if(isset($_GET['search'])){
                                            $search = trim($_GET['search']);
                                            if(($search)){
                                                $query = "SELECT * FROM ((sanpham
                                                                    INNER JOIN loai ON sanpham.id_loai = loai.id_loai) 
                                                                    INNER JOIN size ON sanpham.id_size = size.id_size) 
                                                            WHERE ten_sp = '{$search}'";
                                            } 
                                        } else {
                                                $query = "SELECT * FROM((sanpham 
                                                INNER JOIN loai ON sanpham.id_loai = loai.id_loai) 
                                                INNER JOIN size ON sanpham.id_size = size.id_size) 
                                                ORDER BY sanpham.id_sp ASC";
                                            }
                                                $result = $mysqli->query($query);
                                                while ($arItem = mysqli_fetch_assoc($result)) {
                                                
                                    ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $arItem['id_sp'];?></td>
                                        <td><?php echo $arItem['ten_sp'];?></td>
                                        <td><?php echo $arItem['ten_loai'];?></td>
                                        <td style="text-align: center;"><?php echo $arItem['ten_size'];?></td>
                                        <td style="text-align: center;"><?php echo $arItem['gia_sp'];?></td>
                                        <td><?php echo $arItem['mota'];?></td>
                                        <td class="center">
                                            <?php
                                             if ($arItem['hinhanh'] != '' ) {
                                                    
                                            ?>
                                            <img src="/files/<?php echo $arItem['hinhanh'];?>" alt="" height="100px" width="100px"/>
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                        <td class="center">
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ 1 đến 5 của 24 truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Trang trước</a></li>
                                            <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li>
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li>
                                            <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Trang tiếp</a></li>
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
   document.getElementById("item__thucdon").classList.add("nav-item--active")
   document.getElementById("item__nguoidung").classList.remove("nav-item--active")
   document.getElementById("item__doanhthu").classList.remove("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.remove("nav-item--active")
</script>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>