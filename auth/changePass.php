<?php 
    ob_start();
    session_start();
     require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="icon" type="image/png" href="/templates/admin/assets/img/favicon.png">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Starbucks Coffee | Đặt mật khẩu</title>
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="/templates/admin/assets/css/login.css">
   </head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Reset Password</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
	  <?php 
			  $messagePass = "";
			  $messageReset = "";
			  $username = $_GET['username'];
            if(isset($_POST['reset'])){
                $password = md5($_POST['password']);
				$cnfPassword = md5($_POST['confirmPassword']);
				if(strcmp($password, $cnfPassword) == 0){
					$query = "UPDATE users SET password = '{$password}' WHERE username  = '{$username}'";
					$result = $mysqli->query($query);
					if($result){
						HEADER("LOCATION:login.php?msg=Password was changed successfully!");
						// echo "ok";
                        die();
					} else {
						$messageReset = "Password was changed unsuccessfully!";
					}
				} else {
					$messagePass =  "Incorrect Password";
				}
          }
          ?>
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" value="<?php echo $username?>" readonly>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" required="required">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required="required">
					</div>
					<?php 
						if($messagePass) {
							echo "<p style='color: red'>$messagePass</p>";
						}
						if($messageReset) {
							echo "<p style='color: red'>$messageReset</p>";
						}
						?>
					<div class="form-group">
						<input type="submit" name="reset" value="Reset Password" class="btn btn-success btn-lg btn-block">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="login.php">Sign In</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
  ob_end_flush();	
?>
