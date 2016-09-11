<?php
session_start();

if(isset($_SESSION['session_id']) && isset($_SESSION['remember_me'])) {
    header("Location: html/main.php");
}

include_once 'php/db/connect.php';

$error = false;

// Login
if (isset($_POST['login-submit'])) {
	
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$password = mysqli_real_escape_string($db,$_POST['password']); 
	  
	$sql = "SELECT id FROM user WHERE username = '$username' and password = '$password'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result);
	$id = $row['id'];
	 
	$count = mysqli_num_rows($result);
		
	if($count == 1) {
		if(isset($_POST['remember'])) {
			$_SESSION['remember_me'] = true;
		}
		$_SESSION['session_id'] = $id;
		header("location: html/main.php");
		
		}else {
			$loginerror = "Your Login Name or Password is invalid";
	}
}

// Register
if (isset($_POST['register-submit'])) {
    $name = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword = mysqli_real_escape_string($db, $_POST['confirm-password']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        $stmt= $db->prepare("INSERT INTO user(username, password, email) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $password, $email);

		// execute
		$stmt->execute();

		header("location: html/main.php");
		
		$stmt->close();
		$db->close();

    }
}
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>MySocialNetworkingWebSite</title>
    <!--#region meta-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--#endregion meta-->
    <!--#region CSS-->
    <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/themes/overcast/jquery-ui.css">
    <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <link href="css/index.css" rel="stylesheet" />
    <!--#endregion CSS-->
    <!--#region javascript-->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.0.0.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js"></script>

    <!--<script src="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js"></script>-->

    <script src="js/index.js"></script>
    
    <!--#endregion javascript-->

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" style="display: block;">
									<span class="text-danger"><?php if (isset($loginerror)) echo $loginerror; ?></span>
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember"> Remember Me</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="javascript:alert('forgot-password');" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" style="display: none;">
								
                                    <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
									<div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php if($error) echo $name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php if($error) echo $email; ?>">
                                    </div>
									 
									<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" >
                                    </div>
									
									<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" >
                                    </div>
									
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
