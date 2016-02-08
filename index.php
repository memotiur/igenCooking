<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IGEN Competition</title>
<link rel='shortcut icon' type='image/x-icon' href='img/igen-logo.png' />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="img/igen-logo.png" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                   <li> <a href="#"><span class="fa fa-sign-out"></span>Login</a></span></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class = "container">
		<div class="wrapper">
			<form action="" method="POST" name="Login_Form" class="form-signin">       
				<h3 class="form-signin-heading">Please Sign In</h3>
				  <hr class="colorgraph"><br>
				  
				  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
				  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  
				 
				  <button class="btn btn-lg btn-primary btn-block"  name="submit" value="Login" type="Submit">Login</button>  			
			</form>			
		</div>
	</div>
    <!-- /.container -->
	<div class="footer">
		<div class ="container">
				<div class="text-center"> 
					<p>&#169 Copyright <strong>IGEN- 2015</strong></p>
				</div>
		</div>
	</div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php
session_start();
include('igendb.php');
	if(isset($_POST['submit'])){
	
		$username=$_POST['username'];
		$pass=$_POST['password'];
		$_SESSION['username'] = $username;
		$_SESSION['pass'] = $pass;
		if($username=='admin' && $pass=='123'){
			//header("location:admin_home.php");
			$url='admin_home.php';
			echo '<script>window.location = "'.$url.'";</script>';
		}
		else
		{
			$sql="SELECT * FROM team WHERE teamName='$username' AND pass='$pass'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$url='contestant_home.php';
			echo '<script>window.location = "'.$url.'";</script>';
			}
			else
				echo'<div class="container alert alert-danger">
  <strong>Username & Password is incorrect!</strong>
</div>';
		}
		
	}
?>