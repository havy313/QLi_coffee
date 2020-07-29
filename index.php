<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner" >
        <div class="row">
            <div class="col-md-12">
                <h2 class="section_heading">TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
       
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <a href="cat/">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-bell-o"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">Quản Lý Danh Mục</p>
                            <p class="text-muted">Có 9 danh mục</p>
                        </div>
                    </a>
                </div>
            </div>
           
                <div class="col-md-4 col-sm-4 col-xs-4">                   
                    <div class="panel panel-back noti-box">
                        <a href="menu/">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-book"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text">Quản Lý Thực Đơn</p>
                                <p class="text-muted">Danh sách các món</p>
                            </div>
                        </a>
                    </div>                 
                </div>
           
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <a href="user/">
                        <span class="icon-box bg-color-brown set-icon">
                            <i class="fa fa-user"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">Quản lý Người Dùng</p>
                            <p class="text-muted">Có 6 người dùng</p>
                        </div>
                    </a>
                </div>
            </div>          
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <a href="revenue/">
                        <span class="icon-box bg-color-red set-icon">
                            <i class="fa fa-bar-chart-o"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">Quản Lý Doanh Thu</p>
                            <p class="text-muted">Doanh thu 1 ngày</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <a href="staff/">
                        <span class="icon-box bg-color-violet set-icon">
                            <i class="fa fa-users"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">Quản Lý Nhân Viên</p>
                            <p class="text-muted">Có 6 nhân viên</p>
                        </div>
                    </a>
                </div>    
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <a href="contact/">
                        <span class="icon-box bg-color-pink set-icon">
                            <i class="fa fa-phone-square"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">Quản Lý Liên Hệ</p>
                            <p class="text-muted" id="demo">Chủ cửa hàng</p>
                        </div>
                    </a>
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