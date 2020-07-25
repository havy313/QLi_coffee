<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">QUẢN LÝ LIÊN HỆ</h2>
            </div>
        </div>
        <!-- /. ROW  -->
      
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
                                   
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Tìm kiếm" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Nội dung</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- lấy ra tất cả danh mục tin -->
                                    <?php 
                                        $query = 'SELECT * FROM contact ';
                                        $result = $mysqli->query($query);
                                        while ($arItem = mysqli_fetch_assoc($result)) {
                                           $contact_id = $arItem['contact_id'];
                                           $name = $arItem['name'];
                                           $email = $arItem['email'];
                                           $Website = $arItem['website'];
                                           $content = $arItem['content'];
                                    ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $contact_id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $Website; ?></td>
                                        <td><?php echo $content; ?></td>
                                        
                                        <td class="center">
                                            
                                            <a href="del.php?id=<?php echo $contact_id; ?>" onclick = "return confirm('Bạn thực sự muốn xóa danh mục này?')" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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

<script>
     document.getElementById("item__trangchu").classList.remove("nav-item--active")
   document.getElementById("item__danhmuc").classList.remove("nav-item--active")
   document.getElementById("item__thucdon").classList.remove("nav-item--active")
   document.getElementById("item__nguoidung").classList.remove("nav-item--active")
   document.getElementById("item__doanhthu").classList.remove("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.add("nav-item--active")
</script>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>