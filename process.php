<?php
if (isset($_POST["create"])) {
    include("connect.php");
   
    $title=mysqli_real_escape_string($conn,$_POST["title"]);
    $summary=mysqli_real_escape_string($conn,$_POST["summary"]);
    $content=mysqli_real_escape_string($conn,$_POST["content"]);
    $date=mysqli_real_escape_string($conn,$_POST["date"]);
    $author=mysqli_real_escape_string($conn,$_POST["author"]);
    $sql="insert into posts(date,title,summary,content,author) values('$date','$title','$summary','$content','$author') ";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        header("Location:index.php");
    }
    else
    {
        die('SOmething went wrong');
    }
    
}
?>

<?php
if (isset($_POST["update"])) {
    include("connect.php");
    $title=mysqli_real_escape_string($conn,$_POST["title"]);
    $summary=mysqli_real_escape_string($conn,$_POST["summary"]);
    $content=mysqli_real_escape_string($conn,$_POST["content"]);
    $date=mysqli_real_escape_string($conn,$_POST["date"]);
    $id=mysqli_real_escape_string($conn,$_POST["id"]);
    // $author=mysqli_real_escape_string($conn,$_POST["author"]);
    $sql="UPDATE posts SET title = '$title', summary = '$summary', content = '$content', date = '$date' WHERE id = $id";

    $result=mysqli_query($conn,$sql);
    if($result)
    {
       header("Location:index.php");
    }
    else
    {
        die('SOmething went wrong');
    }
    
}
?>
    
    