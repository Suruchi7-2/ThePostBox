<?php
include("admin/template/header.php");
//written from here
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
               {
                 ?>
                <form method="post">
                  <button class="btn btn-success" name="subscribe">Subscribe</button>
               </form>
            <?php  if (isset($_POST['subscribe'])) 
              {
               echo'<script> alert("Successfully subscribe")</script>';
            }
              ?>
               <h1><?php echo $row['title'];?></h1>
               <p><?php echo  $row['date'];?></p>
               <?php
$author = $row['author']; // Assign author name to variable
echo "<p><small><i>Published by " . $author . "</i></small></p>"; // Output formatted string
?>

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