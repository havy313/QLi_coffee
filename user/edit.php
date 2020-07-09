<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa người dùng</h2>
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
                                $id = $_GET['id'];
                                $query2 = "SELECT * FROM users WHERE id = {$id}";
                                $result2 = $mysqli->query($query2);
                                $arUser = mysqli_fetch_assoc($result2) ;
                                //ki?m tra ng??i dùng b?m submit
                                    if (isset($_POST['submit'])) {
                                       $username = $_POST['username'];

                                       //mã hóa m?t chi?u md5(chuy?n cho m?t chu?i b?t kì và s? có 50 ??n 70 kí t? )
                                       $password = $_POST['password'];

                                       $fullname = $_POST['fullname'];

                                       if ($password == '') {
	                                            $query = "UPDATE users SET fullname = '{$fullname}' WHERE id = {$id}";
                                           $result = $mysqli->query($query);
                                           if ($result) {
                                              HEADER("LOCATION:index.php?msg=Sửa thành công");
                                              die();
                                           }else{
                                                 echo "Có lổi khi sửa người dùng";
                                                 die();
                                           }
                                        }else {
                                                    $password = md5($password);
                                                    $query3 = "UPDATE users SET fullname = '{$fullname}', password = '{$password}' WHERE id = {$id}";
                                                       $result3 = $mysqli->query($query3);
                                                       if ($result3) {
                                                          HEADER("LOCATION:index.php?msg=Sửa thành công");
                                                          die();
                                                       }else{
                                                             echo "Có lổi khi sửa người dùng";
                                                             die();
                                                       }
                                                 }
                                                 }
                                ?>
                                <form  action = "" method= "post" role="form">
                                    <div class="form-group">
                                        <label>Username: </label>
                                        <!-- 'readonly' là khóa không cho người dùng nhập -->
                                        <input type="text" name="username"  value ="<?php echo $arUser['username'];?>" readonly  class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname: </label>
                                        <input type="text" name="fullname"  value ="<?php echo $arUser['fullname'];?>" class="form-control" />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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