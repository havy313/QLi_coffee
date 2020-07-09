<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm người dùng</h2>
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
                                //kiểm tra người dùng bấm submit
                                    if (isset($_POST['submit'])) {
                                       $username = $_POST['username'];

                                       //mã hóa một chiều md5(chuyển cho một chuổi bất kì và sẽ có 50 đến 70 kí tự )
                                       $password = md5 ($_POST['password']);

                                       $fullname = $_POST['fullname'];
                                       $query = "INSERT INTO users(username, password, fullname) VALUES ('{$username}', '{$password}', '{$fullname}')";
                                       $result = $mysqli->query($query);
                                       if ($result) {
                                          HEADER("LOCATION:index.php?msg=Thêm thành công");
                                          die();
                                       }else{
                                             echo "Có lỗi khi thêm người dùng";
                                             die();
                                       }
                                    }
                                ?>
                                <form  action = "" method= "post" role="form">
                                    <div class="form-group">
                                        <label>Username: </label>
                                        <input type="text" name="username" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname: </label>
                                        <input type="text" name="fullname" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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