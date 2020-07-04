<?php
    if(!isset($_SESSION['user'])){
                header("location:/auth/login.php");
            }
 ?>