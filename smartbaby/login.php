<?php 
require 'db_connect.php';
session_start();




if(isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
              
				      	$sql = "SELECT user_id, username, Address, Phone, email, type  FROM users WHERE user_id = {$userId} AND status = 1";
								$result = $connect->query($sql);

								$row = $result->fetch_array();
								if($row['type'] == 'patient'){
	header('location: index.php');	
								}else if($row['type'] == 'admins'){
									header('location: admin/index.php');
								}else{
									header('location: index.php');
								}
}

$errors = array();

if($_POST) {		

	$email = $_POST['email'];
	$password = $_POST['password'];

	if(empty($email) || empty($password)) {
		if($email == "") {
			$errors[] = "email is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE email = '$email' ";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = $password;
			// exists
			$mainSql = "SELECT * FROM users WHERE email = '$email'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				if(password_verify($password, $value['password']))
					{
				$user_id = $value['user_id'];
				$type    = $value['type'];
				$username= $value['username'];


				// set session
				$_SESSION['userId']    = $user_id;
				$_SESSION['type']      = $type;
				$_SESSION['username']  = $username;
				$_SESSION['user_id']   = $user_id;
				

				

				// header('location: index.php?shop='.$dbname.'');	
				header("location: index.php");
					}else{
						$errors[] = "Incorrect password ";
					}
			} else{
				
				$errors[] = "Incorrect email/password combination";
			} // /else
		} else {		
			$errors[] = "email does not exists";		
		} // /else
	} // /else not empty email // password
	
} // /if $_POST

// require_once 'header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Retro Track</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-danger">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/tree.jpg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome, Please login!</h4>
                                    </div>
                                    <div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email"></div>
                                        <div class="form-group">
                                        <input class="form-control form-control-user" type="password"  placeholder="Password" name="password">
                                        </div>
                                        <button class="btn btn-dark btn-block text-white btn-user" name="submit" type="submit">Login</button>
                                        </form>
                                    <div
                                        class="text-center">
                                        <!-- <a class="small" href="forgot-password.php">Forgot Password?</a> -->
                                    </div>
                                <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>