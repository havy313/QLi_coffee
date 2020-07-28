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
      <title>Starbucks Coffee | Đăng kí</title>
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
				<h3>Sign Up</h3>
				<p style='color: white'>Please fill this form to create an account</p>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<?php 
						$messagePass ="";
						$messageUser = "";
						if(isset($_POST['submit'])){
							$fullname =  $_POST['fullname'];
							$username = $_POST['username'];
							$password =($_POST['password']);
							$cnfPassword = ($_POST['confirmPassword']);
							if($password !=  $cnfPassword){
								$messagePass ="Incorrect Password";
							} else {
								$password = md5 ($_POST['password']);
								$query = "SELECT * FROM users WHERE username = '{$username}'";
								$result = $mysqli->query($query);
								if($result != NULL){
									$createUser = "INSERT INTO users(username, password, fullname) VALUES ('{$username}', '{$password}', '{$fullname}')";
									$resultUser = $mysqli->query($createUser);
									$queryUser = "SELECT * FROM users WHERE username = '{$username}'";
            						$resultDB = $mysqli->query($queryUser);
            						$user = mysqli_fetch_assoc($resultDB);
									//B1: tạo session
									$_SESSION['user'] = $user;
									//b2: Cho chuyển hướng sang admin
									header("location:/");
									die();
									
								} else {
									$messageUser = "Username have existed on website";
								} 
							}
						}
					?>
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-address-card"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Fullname" name="fullname" required="required">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Username" name="username" required="required">
					</div>
					<?php if($messageUser) echo "<p style='color: red'>$messageUser</p>"?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password" required="required">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required="required">
					</div>
					<?php if($messagePass) echo "<p style='color: red'>$messagePass</p>"?>
					<div class="row align-items-center remember">
						<input type="checkbox" required="required">I accept the <a href="#">Terms of Use</a> & <a href="#"> Privacy Policy</a>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Register Now" class="btn btn-success btn-lg btn-block">
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
