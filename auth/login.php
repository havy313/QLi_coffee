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
      <title>Starbucks Coffee | Đăng nhập</title>
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
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
			<form action="" method="POST">
			<?php 
				if(isset($_POST['login'])  && $_POST["username"]!=''&& $_POST["password"]!=''){
							$username = $_POST['username'];
							$password =$_POST['password'];
							$passwordEncrypt = md5($password);
					$query = "SELECT * FROM users WHERE username = '{$username}' && password = '{$passwordEncrypt}'";
					$result = $mysqli->query($query);
					$user = mysqli_fetch_assoc($result);
					if($user == null){     
						echo "<span style='color: white'>Sai username hoặc pasword</span><br /><br/>";   
					} else {
						if(!empty($_POST['remember_me'])){
							setcookie ("username", $username, time()+ (10 * 365 * 24 * 60 * 60));  
							setcookie ("password",	$password,	time()+ (10 * 365 * 24 * 60 * 60));
						} else {
							setcookie ("username",""); 
							setcookie ("password","");
						}
						$_SESSION['user'] = $user;
						header("location:/");
						die();
						}
					}
          			?>
				
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required="required">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="password" required="required">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" name="remember_me">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="signup.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="forgotPass.php">Forgot your password?</a>
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
