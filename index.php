<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="cat/" title="">Quản lý danh mục</a></p>
                        <p class="text-muted">Có 4 danh mục</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-book"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="menu/" title="">Quản lý thực đơn</a></p>
                        <p class="text-muted">Có danh sách các món </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-user"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="user/" title="">Quản lý người dùng</a></p>
                        <p class="text-muted">Có 5 người dùng</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-violet set-icon">
                <i class="fa fa-users"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="Staff/" title="">Quản lý nhân viên</a></p>
                        <p class="text-muted">Có 20 nhân viên</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                <i class="fa fa-bar-chart-o"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="revenue/" title="">Quản lý doanh thu</a></p>
                        <p class="text-muted">Doanh thu 1 ngày</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-pink set-icon">
                <i class="fa fa-phone-square"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="contact/" title="">Quản lý liên hệ</a></p>
                        <p class="text-muted" id="demo">chủ cửa hàng</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
   // alert("sadasdasd", document.getElementById("demo"))
   document.getElementById("item__trangchu").classList.add("nav-item--active")
   document.getElementById("item__danhmuc").classList.remove("nav-item--active")
   document.getElementById("item__thucdon").classList.remove("nav-item--active")
   document.getElementById("item__nguoidung").classList.remove("nav-item--active")
   document.getElementById("item__doanhthu").classList.remove("nav-item--active")
   document.getElementById("item__nhanvien").classList.remove("nav-item--active")
   document.getElementById("item__lienhe").classList.remove("nav-item--active")
</script>

<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>