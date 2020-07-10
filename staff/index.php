<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; 
       
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý nhân viên</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <?php
          if (isset($_GET['msg'])){
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
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>                                   
                                        <th>Tên nhân viên</th>
                                        <th>Ca</th>
                                        <th>Time</th>
                                        <th>Phone</th>
                                        <th width="160px" >Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- lấy ra tất cả danh mục tin -->
                                    <?php 
                                        $query = 'SELECT * FROM nhanvien INNER JOIN ca ON nhanvien.ca = ca.id_ca
                                                   ORDER BY nhanvien.id_nhanvien ASC';
                                        $result = $mysqli->query($query);
                                        while ($arItem = mysqli_fetch_assoc($result)) {
                                           $id_nhanvien = $arItem['id_nhanvien'];
                                           $ten_nhanvien = $arItem['ten_nhanvien'];
                                           $ca = $arItem['ca'];
                                           $time = $arItem['Time'];
                                           $phone = $arItem['phone'];
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $id_nhanvien; ?></td>
                                        <td><?php echo $ten_nhanvien; ?></td>
                                        <td><?php echo $ca; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        
                                        <td class="center">
                                            <a href="edit.php?id=<?php echo $id_nhanvien; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="del.php?id=<?php echo $id_nhanvien; ?>" onclick="return confirm('Bạn có thật sự muốn xóa danh mục này?')" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
                                   <?php
                                        }
                                   ?>
                                </tbody>
                            </table>
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
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>