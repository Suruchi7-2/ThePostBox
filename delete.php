<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    include('connect.php');
   $sql="delete  from posts where id='$id' " ;
   $result=mysqli_query($conn,$sql) or die('Query failed');
   if($result)
   {echo "Product Deleted";
    header("Location:index.php");
   }
   else{
    echo "Product not deleted";
    echo "Product Deletion getting error";
   }
   // echo $delete;
}
?>