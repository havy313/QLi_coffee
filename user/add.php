<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">Thêm người dùng</h2>
            </div>
        </div>
        <!-- /. ROW  -->
       
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    $messagePass ="";
                                    $messageUser = "";
                                    if (isset($_POST['submit'])) {
                                       $username = $_POST['username'];
                                        $password = md5 ($_POST['password']);
                                        $cnfPassword = md5($_POST['cnfPassword']);
                                        $fullname = $_POST['fullname'];
                                        
                                        if($cnfPassword != $password){
                                            $messagePass = "Incorrect Password";
                                        } else {
                                            $query = "SELECT * FROM users WHERE username = '{$username}'";
                                            $result = $mysqli->query($query);
                                            if(mysqli_fetch_assoc($result) == 0){
                                                $query = "INSERT INTO users(username, password, fullname) VALUES ('{$username}', '{$password}', '{$fullname}')";
                                                $result = $mysqli->query($query);
                                                if ($result) {
                                                    HEADER("LOCATION:index.php?msg=Thêm thành công");
                                                    die();
                                                }else{
                                                    echo "Có lỗi khi thêm người dùng";
                                                    die();
                                                }
                                            } else {
                                                $messageUser = "Username have existed on website";
                                            } 
                                        }
                                    }
                                ?>
                                <form  action = "" method= "post" role="form">
                                <div class="col-6 col-sm-4" id=col-6>
                                <div class="form-group">
                                        <label>Fullname: </label>
                                        <input type="text" name="fullname" class="form-control" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Username: </label>
                                        <input type="text" name="username" class="form-control" required="required"/>
                                    </div>
                                    <?php if($messagePass) echo "<p style='color: red'>$messagePass</p>"?>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                    <a class="btn btn-danger" href="index.php" role="button">Trở về</a>
                                    </div>
                                    <div class="col-6 col-sm-4" id=col-6>
                                    <?php if($messageUser) echo "<p style='color: red'>$messageUser</p>"?>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input type="password" name="password" class="form-control" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password: </label>
                                        <input type="password" name="cnfPassword" class="form-control" required="required"/>
                                    </div>
                                    </div>
                                    
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