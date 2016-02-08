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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="assets/jquery.js"></script>
	<script type="text/javascript" src="assets/jquery.canvasjs.min.js"></script>
		<?php
			include('igendb.php');
			$team='';
			session_start();
			$user=$_SESSION['username'];//echo$user;
			$sql="SELECT * FROM statistics WHERE team='$user'ORDER BY statId DESC";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$row=mysqli_fetch_assoc($result);
				$remaining=$row['remaining'];//echo$remaining;
				$total=$row['total'];//echo$total;
				$team=$row['team'];
			}
			else
				echo"Result Not found"
			//$value=100;
		?>
		<script type="text/javascript">
	window.onload = function () {

	//Better to construct options first and then pass it as a parameter
		var options = {
			title: {
				text: "PIE Statistics"
			},
					animationEnabled: true,
			data: [
			{
				type: "pie", //change it to line, area, bar, pie, etc
				dataPoints: [
					{ label: "Remaining ", y: <?php echo$remaining?> },
					{ label: "Total Cost ", y: <?php echo$total?> },
				]
			}
			]
		};

		$("#chartContainer").CanvasJSChart(options);

	}

	</script>

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
                <a class="navbar-brand" href="contestant_home.php">
                    <img src="img/igen-logo.png" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li> <a href="logout.php"><span class="fa fa-sign-out"></span>Logout</a></span></li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
	<div class="content">
		<div class ="container">
			<div class="col-md-10 col-sm-offset-1">
				<h4 class="text-center text-success">Good Luck <?php echo strtoupper($team)?>.<br>  Your Reamining Balance: <?php echo$remaining?> Your Total Cost: <?php echo$total?></h4>
				<div id="chartContainer" style="height: 500px; width: 100%;"></div>
					<div class="text-center"> 
						<a href="contestant_home.php"><button type="done" class="text-center btn btn-primary" name="done">Shop Again</button></a>
						<a href="logout.php"><button type="done" class="text-center btn btn-primary" name="done">Done</button></a>
					</div><br>
			</div>
		</div>
				
		</div>
	</div>

	<div class="footer">
		<div class ="container">
				<div class="text-center"> 
					<p>IGEN- 2015</p>
				</div>
		</div>
	</div>
	
    <!-- /.container -->

    <!-- jQuery -->
   

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>