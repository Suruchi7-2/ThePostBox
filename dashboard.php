<?php
include("admin/template/header.php");
include("admin/template/submit_form.php")

?>
<div class="post-list w-100 p-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10%;">Publication Date</th>
                <th style="width:15%;" >Title</th>
                <th style="width:45%;">Article</th>
                <th style="width:20%;">Action</th>
                <th style="width:10%;">AuthorName</th>
</tr>
</thead>
<tbody>
    <?php 
    include('connect.php');
    $sql ="select * from posts";
   $result= mysqli_query($conn,$sql);
   while($row=mysqli_fetch_array($result))
   {
    ?>
    <tr>
        <td> <?php echo $row["date"]?> </td>
        <td> <?php echo $row["title"]?> </td>
        <td> <?php echo $row["summary"]?> </td>
       <td> <a href="view.php?id=<?php echo $row['id'] ?>" class="btn btn-info">View</a>
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
   </td>
   <td> <?php echo $row["author"]?> </td>
   </tr>
    <?php

   }
    ?>
</tbody>
</table>
</div>
<?php 
include("admin/template/footer.php");
?>