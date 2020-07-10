<?php 
    ob_start();
    session_start();
     require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
     require_once $_SERVER['DOCUMENT_ROOT'] . '/util/CheckUserUtil.php'; 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Starbucks | Quản lí</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/templates/admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/templates/admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/templates/admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-12">                                    
                        <div class="logo">
                            <a href="index.php">
                                <img src="/templates/admin/assets/img/logo.png" alt="logo" style="width: 120px"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-12 ">
                        <p class="star"> Starbuck Coffee </p>
                    </div>
                    <div class="col-lg-3 col-md-2 col-12 admin"> Xin chào, <b>Admin</b> &nbsp; <a href="/auth/logout.php" class="btn btn-danger square-btn-adjust">Đăng xuất</a> </div>
                </div>
            </div>
        </nav>
        <!-- /. NAV TOP  -->