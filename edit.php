<?php 
include("admin/template/header.php");
?>

<?php
$id = $_GET['id'];
if($id){
    include("connect.php");
    $sqlEdit = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sqlEdit);
}else{
    echo "No post found";
}

?>
        <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
            <form action="process.php" method="post">
                <?php 
                while ($data = mysqli_fetch_array($result)) {
                ?>

                <div class="form-field mb-4">
                    <input type="text" class="form-control" style="width:900px;" name="title" id="" placeholder="Enter Title:" value="<?php echo $data['title']; ?>">
                </div>
                <div class="form-field mb-4">
                    <input type="text" class="form-control" style="width:900px;"  name="author" id="" placeholder="Enter Author Name:"  value="<?php echo $data['author']; ?>" disabled>
                </div>
                <div class="form-field mb-4">
                    <textarea name="summary"  class="form-control" id="default" cols="30" rows="10" placeholder="Enter Summary:"><?php echo $data['summary']; ?></textarea>
                </div>
                <div class="form-field mb-4">
                    <textarea name="content" class="form-control" id="default" cols="30" rows="10" placeholder="Enter Post:"><?php echo $data['content']; ?></textarea>
                </div>
                <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-field">
                    <input type="submit" class="btn btn-primary" value="Submit" name="update">
                </div>

                <?php
                }
                ?>
            </form>
            <script src="tinymce/tinymce.min.js"></script>
    <script src="script.js"></script>
        </div>
<?php 
include("admin/template/footer.php");
?>+