<head>
<script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery.canvasjs.min.js"></script>
	<div class="container">
	<div class="col-sm-12">
		<div id="chartContainer" style="height: 550px; width: 100%;"></div>
		</div><br>
		<div class="col-sm-offset-2 col-sm-8">
			
			<?php
				include('igendb.php');
				$value=100;
				$sql="SELECT * FROM statistics";
				//$sql="DELETE * FROM statistics WHERE team='test'";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) > 0){
						echo'<div class="wrapper">
						<h3 class="text-center"><strong>Remaining Balance Table</strong></h3>
						<table class="table table-bordered">
							<thead>
							  <tr class="success">
								<th>Team Name</th>
								<th>Given Amount</th>
								<th>Shop Cost</th>
								<th>Remaining</th>
							  </tr>
							</thead>';
						//echo(mysqli_num_rows($result));
						while($row=mysqli_fetch_assoc($result)){
							echo'<tbody><tr class="danger">';
										echo'<td>';echo$row['team'].'</td>
										<td>';echo$row['total']+$row['remaining'].'</td>
										<td>';echo$row['total'].'</td>
										<td>';echo$row['remaining'].'</td>
										
									  </tr>';
								}echo'</tbody>
								</table>';
							
						
					}
				
			?></div>
		</div>
		
	</div>
	
<script type="text/javascript">

window.onload = function () {

//Better to construct options first and then pass it as a parameter
	var options = {
		title: {
			text: "Remaining Balance Chart"
		},
                animationEnabled: true,
		data: [
		{
			type: "column", //change it to line, area, bar, pie, etc
			dataPoints: [
				{ label: "Rajshahi", y: 896 },
				{ label: "Chittagong", y: 647 },
				{ label: "Rangpur", y: 1007 },
				{ label: "Sylhet",  y: 639 },                                    
				{ label: "Barisal",  y: 1295 },
				{ label: "Khulna",  y: 1120 },
				{ label: "Dhaka-1",  y: 605 },
				{ label: "Dhaka-2",  y: 134 },
				{ label: "Mymensingh",  y: 770 }
			]
		}
		]
	};

	$("#chartContainer").CanvasJSChart(options);

}
</script>
</head>
<div class="col-md-10 col-sm-offset-1">

	<div id="chartContainer" style="height: 500px; width: 100%;"></div>
</div>
