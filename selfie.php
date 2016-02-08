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
                   
                   <li> <a href="logout.php"><span class="fa fa-sign-out"></span>Logout</a></span></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
session_start();
	echo$_SESSION['username'];;
		
?>
		
		<div class = "container">
			<div class="wrapper col-md-6">
				<form class="form-horizontal form-signin" method="POST" action="" enctype="multipart/form-data">  
					<h3 class="form-signin-heading">Add Item</h3>
					<hr class="colorgraph"><br>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Item Name</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control"  name="itemname" placeholder="Item Name" required="" autofocus="" />
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Image</label>
						<div class="col-sm-9">
						   <input type="file" name="fileToUpload" id="fileToUpload">
						</div>
					  </div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Rate</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" name="rate" placeholder="Rate" required="" />
						</div>
					</div>
					<button class="btn btn-lg btn-primary btn-block"  name="submit" value="Login" type="Submit">Add Item</button>  			
				</form>	
			</div>
			<?php
			if(isset($_POST['submit'])){
				$itemName=$_POST['itemname'];
				
				$rate=$_POST['rate'];
				
				//File Upload
				$target_dir = "items/";
				$bool=true;
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$filetype=pathinfo($target_file,PATHINFO_EXTENSION);
				$temp=substr($itemName, 0, 5);
				$newfilename="items/". $temp.".".$filetype;

				/*if(file_exists($newfilename)){
						$itemName=$itemName.rand();
						$newfilename="items/". $temp.rand().".".$filetype; 
					}*/
				//if($_FILES["fileToUpload"]["error"] == 4) {
					//$newfilename="items/event.jpg";
				//}
				if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg"
				&& $filetype != "gif" ) {
					$msg= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$bool=false;
				}
				if($bool==true){
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename);
					$msg="File uploaded";
				}
				
				
				
				
				$sql="INSERT INTO item(itemName,pic,rate)
				VALUE('$itemName','$newfilename','$rate')";
				if(mysqli_query($conn,$sql)){
					echo'<div class="alert alert-info">
  <strong>Inserted!</strong></div>';
				}
				else
					echo'Not yet';
			}

			echo'<div class="wrapper col-md-6">';
				$sql="SELECT * FROM item";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) > 0){
						echo'<div class="table-responsive">   <table class="table table-bordered">
					<thead>
					  <tr class="info">
						<th>Item Name</th>
						<th>Pic</th>
						
						<th>Rate</th>
						<th>Delete</th>
					  </tr>
					</thead>';
						while($row=mysqli_fetch_assoc($result)){
							$pic=$row['pic'];
							echo'<tbody><tr class="danger">';
								echo'<td>';echo$row['itemName'].'</td>
								<td><img class="img-responsive" src="';echo$pic.'"alt="" max-height="50"></td>
								
								<td>';echo$row['rate'].'</td>
								<td><a href="delete_item.php?id=' . $row['itemId'] . '">Delete</a></td>
							  </tr>';
						}echo'</tbody>
						</table></div>';
					}else
						echo'<div class="alert alert-info">
  <strong>No Items</strong>Found</div>';
				?>
			</div>
		</div>
		