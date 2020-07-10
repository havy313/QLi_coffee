
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; 
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý doanh thu</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

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
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                            Launch static backdrop modal
                            </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Trà Gần Nhau Hơn</h5>
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
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Size</th>
                                        <th>Giá</th>
                                        <th>Mô tả</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT *, story.name AS name, cat.name AS cat_name FROM story INNER JOIN cat ON story.cat_id = cat.cat_id ORDER BY story_id DESC";
                                        $result = $mysqli->query($query);
                                        while ($arItem = mysqli_fetch_assoc($result)) {
                                           
                                        
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $arItem['story_id'];?></td>
                                        <td><?php echo $arItem['name'];?></td>
                                        <td><?php echo $arItem['cat_name'];?></td>
                                        <td class="center"><?php echo $arItem['counter'];?></td>
                                        <td class="center">
                                            <?php
                                             if ($arItem['picture'] != '' ) {
                                                    
                                            ?>
                                            <img src="/files/<?php echo $arItem['picture'];?>" alt="" height="80px" width="100px" />
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                        <td class="center">
                                            <a type="" class="btn" data-toggle="modal" data-target="#staticBackdrop">
                                                <img src="http://qlht.ued.udn.vn/templates/ued/images/icondetail.png" class=""></i></a>
                                            <a href="edit.php?story_id=<?php echo $arItem['story_id'] ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="del.php?story_id=<?php echo $arItem['story_id']?>" title="" class="btn btn-danger"><i class="fa"></i> Xóa</a>
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
