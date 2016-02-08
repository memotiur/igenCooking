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
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
			
		</div>
			<?php
			$total=0;
			
			include('igendb.php');
			session_start();
			$user=$_SESSION['username'];
			$sql="SELECT * FROM team WHERE teamName='$user'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$row=mysqli_fetch_assoc($result);
				
			}
				$amount=$row['amount'];
					echo'<div class="wrapper col-md-6 col-sm-offset-3">';
					echo'<h4 class="text-center text-success">Hi Team '.strtoupper($user).'</h4>';
					echo'<h4 class="text-center text-success">Your Remaining Balance is '.$row['amount'].'</h4>';
				$sql="SELECT * FROM item";
					$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result) > 0){
						echo'<form class="form-horizontal" method="POST" action="" >
					<div class="table-responsive">   <table class="table table-bordered">
					<thead>
					  <tr class="success">
						<th>Item</th>
						<th>Pic</th>
						<th>Rate</th>
						<th>Qty</th>
						<th>Total</th>
					  </tr>
					</thead>';
						while($row=mysqli_fetch_assoc($result)){
							$pic=$row['pic'];
							
							echo'<tbody>';
								echo'<td>';echo$row['itemName'].'</td>
								<td><img class="img-responsive" src="';echo$pic.'"alt="" max-height="50"></td>
								<td class="rate'.$row['itemId'].'">';echo$row['rate'].'</td>
								<td><select id="qty'.$row['itemId'].'" data-rel="'.$row['itemId'].'">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								  </select>
								</td>';
								if(empty($_POST['qty'])){
									$_POST['qty']=0;
									
								}

								//$qty = $_POST['qty'];echo$qty;
								//$total=$total+($qty*$row['rate']);
								
								echo'<td id="subtotal'.$row['itemId'].'" class="subTotal">0</td>
							  </tr>';
						}echo'</tbody>
						
						<thead>
					  <tr>
						<th>Total Cost</th>
						<th></th>
						<th></th>
						<th></th>
						<th class="total">0</th>
					  </tr>
					</thead>
						
						</table></div>
						<input class="mytotal" type="hidden" value="" name="mytotal">
						<div class="text-center"> 
						 <button type="done" class="btn btn-primary" name="done">Checkout</button>
						</div>
						</form>';
					}else
						echo'<div class="alert alert-info">
  <strong>No Items</strong>Found</div>';

	$sql="CREATE TABLE IF NOT EXISTS statistics(
			statId INT(20) AUTO_INCREMENT,
			total INT(20),
			remaining INT(20),
			team VARCHAR(100),
			PRIMARY KEY(statId)
		)";
		if(!mysqli_query($conn,$sql)){
			echo'Error is '.mysqli_error($conn);
		}
		//else
	if(isset($_POST['done'])){
		
		$mytotal=$_POST['mytotal'];
		$remaining=$amount-$mytotal;
		if($remaining<0){
			echo'<div class="alert alert-danger">
				<strong>Insufficient Balance! </strong>You are going to purchase by '.$amount.' TK. Try Again</div>';
		}
		else{
			$sql="SELECT * FROM statistics WHERE team='$user'";
		$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$sql="UPDATE statistics SET total='$mytotal',remaining='$remaining',team='$user' WHERE team='$user'";
				if(!mysqli_query($conn,$sql)){
					echo'Not yet Updated'.mysqli_query($conn);
				}
			}
			else{
				$sql="INSERT INTO statistics(total,remaining,team)
				VALUE('$mytotal','$remaining','$user')";
				if(!mysqli_query($conn,$sql)){
					echo'Not yet'.mysqli_query($conn);
				}
				
			}
			echo("<script>location.href = 'contestant_submit.php';</script>");
			
		}
		
	}
?>


		</div>
	</div>

	<div class="footer">
		<div class ="container">
				<div class="text-center"> 
					<p>&#169 Copyright <strong>IGEN- 2015</strong></p>
				</div>
		</div>
	</div>
	
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('select').change(function(){
                var subt
                var qut = $(this).val()
                var cId = $(this).attr('data-rel')
                subt = $(".rate"+cId).text()*qut
                $("#subtotal"+cId).text(subt)

                var sum = 0;
                $(".subTotal").each(function() {

                    var value = $(this).text();
                    if(!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                $(".total").text(sum);
				$(".mytotal").val(sum);
				
            })
        })
    </script>

</body>

</html>


