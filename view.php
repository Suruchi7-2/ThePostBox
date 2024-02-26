<?php
include("admin/template/header.php");
?>
<div class="post w-100 bg-light p-5">
      <?php
            if(isset($_GET["id"]))
            {
                $id=$_GET["id"];
                include('connect.php');
                $sql="select * from posts where id=$id";
                $result=mysqli_query($conn,$sql);
               while( $row=mysqli_fetch_array($result))
               {?>
               <h1><?php echo $row['title'];?></h1>
               <p><?php echo $row['date'];?></p>
               <p><?php echo $row['content'];?></p>



<?php
               }
              }
              else{
                echo"post not found";
              }
              ?>
              </div>

<?php
include("admin/template/footer.php");
?>