<?php
include('igendb.php');
echo $_GET['id'];
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM team WHERE teamId=$id";
    if(mysqli_query($conn,$sql))
    {
        echo "Item deleted";
		 $url='admin_home.php?page=add_team';
                 echo '<script>window.location = "'.$url.'";</script>';

    }
    else{
        echo "Item did not deleted".mysqli_error($conn);
echo '<script>window.location = "'.$url.'";</script>';
        //header('location:admin_home.php');
    }

}

?>