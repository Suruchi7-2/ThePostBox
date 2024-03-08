<?php 
include("admin/template/header.php");
?>
        <div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
            <form action="process.php" method="post">
                <div class="form-field mb-4">
                    <input type="text" class="form-control" style="width:900px;" name="title" placeholder="Enter post title">

                </div>
                <div class="form-field mb-4">
                    <input type="text" class="form-control" style="width:900px;" name="author" placeholder="Enter author name">

                </div>

                <div class="form-field mb-4">
                    <input type="email" class="form-control" style="width:900px;" name="email" placeholder="Enter author's email">

                </div>
                <div class="form-field mb-4">
                    <textarea name="summary" class= "form-control" id="default" cols="30" rows="10" placeholder="Enter summary"></textarea>

                </div>
                <div class="form-field mb-4">
                    <textarea name="content" class="form-control" id="default" cols="30" rows="10" placeholder="content"></textarea>

                </div>
                <input type="hidden" name="date" value="<?php echo date("Y/m/d");?>">
               
                <div class="form-field mb-4">
                <input type="submit" class="btn btn-primary" value="Submit" name="create">

                </div>
</form>
<script src="tinymce/tinymce.min.js"></script>
    <script src="script.js"></script>
        </div>
        <?php 
include("admin/template/footer.php");
?>
</body>
</html>



