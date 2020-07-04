<?php
    ob_start();
    session_start();
    if(isset($_SESSION['user'])){
        //hủy session
        unset($_SESSION['user']);

        //chuyển hướng
        header("location:/index.php");
        die();
    }
    
    ob_end_flush();
?>