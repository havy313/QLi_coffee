<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                               //trước khi kiểm tra cần phải lấy id về, trong file index có key là id
                                $id_loai = $_GET['id'];
                                //để lấy được tên danh mục mà chúng ta đang muốn sửa hiển thị lại trong ô input thì sau khi nhận được id này thì lập tức viết một câu: 

                                $sql = "SELECT  * FROM loai WHERE id_loai = {$id_loai} ";
                                $result2 = $mysqli->query($sql);
                                //select này trả về một dòng dữ liệu duy nhất thì chúng ta đã where id_loai làm khóa chính rồi nên ko cần thiết phải lặp 
                                $arCat = mysqli_fetch_assoc($result2);

                                //kiểm tra người dùng bấm submit
                                    if (isset($_POST['submit'])) {
                                       $ten_loai = $_POST['ten_loai'];
                                       $query = "UPDATE loai SET ten_loai = '{$ten_loai}' WHERE id_loai = {$id_loai}";
                                       $result = $mysqli->query($query);
                                       if ($result) {
                                          HEADER("LOCATION:index.php?msg=Sửa thành công");
                                          die();
                                       }else{
                                             echo "Có lỗi khi sửa danh mục";
                                             die();
                                       }
                                    }
                                ?>
                                <form  action = "" method= "post" role="form">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="ten_loai" value="<?php echo $arCat['ten_loai'] ;?>" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                    <a class="btn btn-danger" href="index.php" role="button">Trở về</a>
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