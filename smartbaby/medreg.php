<?php
require_once 'db_connect.php';


if(isset($_POST['submit'])) {	

  $UserName 		= $_POST['UserName'];
  $first 		    = $_POST['first'];
  $last 		    = $_POST['last'];
//   $UserImage 	= $_POST['UserImage'];
  $password 		= $_POST['password'];
  $password2 		= $_POST['password2'];
  $email 			  = $_POST['email'];
  $address 			= $_POST['address'];
  $phone 			  = $_POST['phone'];
  $Terms 			  = $_POST['Terms'];
  $UserType 		= 2;
  $UserStatus   = 1;
  $date         = date("Y-m-d H:i:s");
//   $UserStatus 	    = $_POST['UserStatus'];
$sqlCheck = "SELECT count(*) FROM users WHERE email = '$email'";
$result = $connect->query($sqlCheck);
$row = $result->fetch_row();

if($row[0] > 0){
  $valid = "the email used is already in the system ! Please try again with another Email";
}else{


if ($password!=$password2){

	$valid = "Password do not match, both password should be same";
	// $valid.= "<p>Password do not match, both password should be same.<br /><br /></p>";
	  }
	  if($valid != ""){
      $valid = "Password do not match, both password should be same";
	}else{
  $password = password_hash($password, PASSWORD_DEFAULT);
	

				$sql = "INSERT INTO users (username, first_name, last_name, User_image, password, email, Address, Phone, Terms, type, status, joined_date) 
				VALUES ('$UserName', '$first', '$last', '$url', '$password', '$email', '$address', '$phone', '$Terms', '$UserType', '$UserStatus', '$date')";

				if($connect->query($sql) == TRUE) {
					
					$valid = "Successfully created an account <a href='login.php'>login</a>";
				} else {
					$valid = "Error while adding the members";
        }
      }

			
}




	$connect->close();

	
  
 
  
} // /if $_POST

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Smart Baby Monitor</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/syringe-1884784_1920.jpg&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <div class="error-message"><div id="add-User-messages">
</div>
	
  <?php if($valid) {
 
    echo '<div class="alert alert-success" role="alert">
    <i class="glyphicon glyphicon-exclamation-sign"></i>
    '.$valid.'</div>';										
    
  } ?>

</div>
                            <form class="user" action="register.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="First Name" name="first" value="<?php
                    if($_POST){
                      echo $_POST['first'];
                    }
                    ?>" name="first"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Last Name" name="last" value="<?php
                    if($_POST){
                      echo $_POST['last'];
                    }
                    ?>"></div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="username" name="UserName" value="<?php
                    if($_POST){
                      echo $_POST['UserName'];
                    }
                    ?>"></div>
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" value="<?php
                    if($_POST){
                      echo $_POST['email'];
                    }
                    ?>"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password"></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password2"></div>
                                </div>
                                
                                <div class="form-group"><input type="phone" class="form-control form-control-user"  id="phone" placeholder="263 771 000000" name="phone" value="<?php
                    if($_POST){
                      echo $_POST['phone'];
                    }
                    ?>" autocomplete="off" required></div>
                    <div class="form-group"><label for="email"><input type="text" class="form-control form-control-user" id="address" placeholder="Address" name="address" value="<?php
                    if($_POST){
                      echo $_POST['address'];
                    }
                    ?>" autocomplete="off" required></div>
                    <div class="form-group"><input type="hidden" class="form-control form-control-user"  id="Terms" placeholder="Terms" name="Terms" autocomplete="off" value="<?php
                    if($_POST){
                      echo $_POST['Terms'];
                    }else{
                      echo 'agree';
                    }
                    ?>" required></div>
                                
                                <button  type="submit" class="btn btn-primary btn-block text-white btn-user" name="submit">Register Account</button>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
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