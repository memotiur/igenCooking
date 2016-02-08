<?php
	include('igendb.php');
		$sql="CREATE TABLE IF NOT EXISTS team (
		teamId INT(20) AUTO_INCREMENT,
		teamName VARCHAR(100),
		amount INT(20),
		pass VARCHAR(100),
		PRIMARY KEY(teamID)
	)";
	if(mysqli_query($conn,$sql)){
		//echo'Yes';
	}
	else
		echo'<div class="alert alert-info">
  <strong>There was a problem</strong></div>';
?>
		
		<div class = "container">
			<div class="wrapper col-md-6">
				<form action="" method="POST" name="Login_Form" class="form-signin">       
					<h3 class="form-signin-heading">Add Team</h3>
					<hr class="colorgraph"><br>
					<label>Team Name </label><input type="text" class="form-control" name="teamname" placeholder="Team Name" required="" autofocus="" />
					<label>Given Amount</label><input type="text" class="form-control" name="given_money" placeholder="Given Amount" required="" />
					<label>Password</label><input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  
					<button class="btn btn-lg btn-primary btn-block"  name="submit" value="Login" type="Submit">Add Team</button>  			
				</form>	
			</div>
			<?php
			if(isset($_POST['submit'])){
				$teamname=$_POST['teamname'];
				$amount=$_POST['given_money'];
				$pass=$_POST['password'];
				$sql="INSERT INTO team(teamName,amount,pass)
				VALUE('$teamname','$amount','$pass')";
				if(mysqli_query($conn,$sql)){
					//echo'done';
				}
				else
					echo'<div class="alert alert-info">
  <strong>There was a problem</strong></div>';
			}
			?>
			
					
			
				<?php
					$sql="SELECT * FROM team";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) > 0){
						echo'<div class="wrapper col-md-6">
				<table class="table table-bordered">
					<thead>
					  <tr class="info">
						<th>Team Name</th>
						<th>Given Amount</th>
						<th>Password</th>
						<th>Delete</th>
					  </tr>
					</thead>';
						while($row=mysqli_fetch_assoc($result)){
							echo'<tbody><tr class="danger">';
								echo'<td>';echo$row['teamName'].'</td>
								<td>';echo$row['amount'].'</td>
								<td>';echo$row['pass'].'</td>
								<td><a href="delete_team.php?id=' . $row['teamId'] . '">Delete</a></td>
							  </tr>';
						}echo'</tbody>
						</table>';
					}else
						echo'<div class="alert alert-info">
  <strong>No Items</strong>Found</div>';
				?>
			</div>
		</div>