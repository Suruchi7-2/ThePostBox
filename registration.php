<?php
session_start();
if(isset($_SESSION["user"]))
{
    header("Location: index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>LoginRegister</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

    <?php
    // print_r($_POST);
    // it just check what the current value have in post variable
    if(isset($_POST['submit']))
    {
        $fullname=$_POST["fullname"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $password_repeat=$_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors=array();
        // any error happens add to above array 
        // empty function of php check for any empty value provided by the users 
        if(empty($fullname) or empty($email) or empty($password) or empty($password_repeat))
        {
            array_push($errors, " All fields are requuired");
        }
        // check filter_var finction check user provided email is valisd or not 
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            array_push($errors,"Email is not valid");
        }
        if(strlen($password)<3)
        {
            array_push($errors,"Password must be set atleast 8 character long");
        }
        if($password !=$password_repeat)
        {
            array_push($errors,"Password doen't match");
        }

        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0) {
         array_push($errors,"Email already exists!");
        }
        if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
$sql="insert into users(full_name,email,password) values(?,?,?)";
$stmt=mysqli_stmt_init($conn);
$preparestmt=mysqli_stmt_prepare($stmt,$sql);
if($preparestmt)
{
    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
    mysqli_stmt_execute($stmt);
    echo"<div class='alert alert-success'>You are registered successfully</div>";
}
else
{
    die("Something went wrong");
}
// 1.so above code just have a sql query to insert record as submit clicked 
// 2. and then sql sattemnet intialised
// 3. and then prepare stament is there used to prevent sql injection as in sql query we don't put user input directly 
// instead we put placeholder ? into values  and then if prepare statment is true bind up all sattement with user input 
// 4. in this form, we don't want user to use same email multiple times or dame usernam eso, write code above.
           }
            
    }
    ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <!-- form control class for form element and for nutton classs btn btn-primary just a framework of bootsrarp  -->
                <input type="text" class="form-control" name="fullname" placeholder="FULL NAME">
            </div>
            <div class="form-group">
                <input type="email"class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control"name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="text"class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit" >
            </div>
        </form>
        <div><p>Already Registered!</p>
    <a href="index.php" class="btn btn-success">Login Here</a></div></div>
</body>
</html>