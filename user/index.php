<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
        
 ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<?php
    //tổng số dòng
    $queryTSD = "SELECT COUNT(*) AS TSD  FROM users";
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
                <h2 class="section_heading">QUẢN LÝ NGƯỜI DÙNG</h2>
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
                                        <th>Username</th>
                                        <th>Fullname</th>
                                        <th width="160px" >Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- lấy ra tất cả danh mục tin -->
                                    <?php 
                                        $query ='';
                                        if(isset($_GET['search'])){
                                            $search = trim($_GET['search']);
                                            if(($search)){
                                                $query = "SELECT * FROM users WHERE username = '{$search}'";
                                            } 
                                        } else {
                                            $query = "SELECT * FROM users ORDER BY id ASC LIMIT {$offset}, {$row_count}";
                                        }
                                            $result = $mysqli->query($query);
                                            while ($arItem = mysqli_fetch_assoc($result)) {
                                            $id = $arItem['id'];
                                            $username = $arItem['username'];
                                            $fullname = $arItem['fullname'];
                                        ?>
                                    <tr class="gradeX">
                                        <td style="text-align: center;"><?php echo $id; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td class="text-center">
                                            <a href="edit.php?id=<?php echo $id; ?>" title="" class="btn btn-primary"><i class="fa fa-pencil "></i></a>
                                            <a href="del.php?id=<?php echo $id; ?>" onclick="return confirm('Bạn có thật sự muốn xóa danh mục này?')" title="" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
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
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Trang <?php echo $current_page; ?> của <?php echo $TongSoTrang; ?> trang người dùng</div>
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
   document.getElementById("item__nguoidung").classList.add("nav-item--active")
   document.getElementById("item__doanhthu").classList.remove("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.remove("nav-item--active")
</script>

<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>