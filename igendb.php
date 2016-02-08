<?php
	$server="localhost";
	$username="root";
	$password="";
	$conn=mysqli_connect($server,$username,$password);
	if(!$conn){
		echo "Connected".mysqli_error($conn);
	}
	
	$sql="CREATE DATABASE IF NOT EXISTS igendb";
    if(!mysqli_query($conn,$sql)){
         echo'Database Not Created'.mysqli_error($sql);
    }
    $conn =mysqli_connect($server,$username,$password,'igendb');
    if(!$conn)
    	echo "Database Not connected";

	
?>