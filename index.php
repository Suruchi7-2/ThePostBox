<?php
session_start();
if(isset($_SESSION["user"]))
{
    header("Location: dashboard.php");
}
?>

<?php

session_start();

include_once "vendor/autoload.php";

  $google_client = new Google_Client();

  $google_client->setClientId('935828866028-5ql62sk4plao8f1bsqp9m31sf8d3n5np.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('GOCSPX-zfHu4MY9Pxq_RMrtqNlzU2L9njG'); //Define your Client Secret Key

  $google_client->setRedirectUri('http://localhost:8080/cms/dashboard.php'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $_SESSION['access_token']=$token['access_token'];

    $google_service = new Google_Service_Oauth2($google_client);

    $data = $google_service->userinfo->get();

    $current_datetime = date('Y-m-d H:i:s');

   // print_r($data);

$_SESSION['first_name']=$data['given_name'];
$_SESSION['last_name']=$data['family_name'];
$_SESSION['email_address']=$data['email'];
$_SESSION['profile_picture']=$data['picture'];

   
   
   }
  }
  
  
  $login_button = '';
  
 // echo $_SESSION['access_token'];
  
  if(!$_SESSION['access_token'])
  {
	//  echo 'test';
	  
   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="asset/sign-in-with-google-icon-22.jpg"></a>';
   
  }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet", href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body><br><br><br>
    <div class="container">


        <div class="head my-4 "><h1 class="text-center" style="color: Red;font-family: 'Dancing Script', cursive;">ThePostHub</h1>
        <p class="text-center"><i>A Blog Hub website!!! Let's Login and Enjoy</i></p>
        <hr style="border-color: black; border-width: 6px;">
        <?php
        // if login button is submitted is checked by below sattement isset function does that 
        if(isset($_POST["login"]))
        // after above code when login clicked collect email and password data 
        {   $email=$_POST["email"];
            $password=$_POST["password"];
            // now check whetehr email and passwor exit into user database or not for login so, for that first connect to database 
            require_once "database.php";
            $sql= "select * from users where email='$email' ";
            $result=mysqli_query($conn,$sql);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user)
            {
                if(password_verify($password,$user["password"]))
                {
                    session_start();
                    $_SESSION["user"]="yes";
                    header("Location: dashboard.php");
                    die();
                }
                else{
                    echo"<div class='alert alert-danger'> PAssword doesn't match</div>";
                }

            }
            else
            {
                echo"<div class='alert alert-danger'>Email doesn't exist</div>";
            }

        }
        ?>
       <div class="row justify-content-center"> <form action="index.php" method="post" class="col-md-6 my-4"> <div class="form-group">
          <input type="email" placeholder="enter email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="enter password" name="password" class="form-control">
        </div>
        <div class="form-btn">
          <input type="submit" class="btn btn-primary btn-md" style="font-family: 'Dancing Script', cursive"; value="Login" name="login">
        </div>
    <!-- <div>
    <a href="dashboard.php" class="btn btn-success"  style="font-family: 'Dancing Script', cursive"; >Sign in with Google</a>

    </div> -->

    <div>
      <p><small>Not registered yet?<small></p>
      <a href="registration.php" class="btn btn-success" style="font-family: 'Dancing Script', cursive";>Register Here</a>
    </div>
    <div><br><br>
      <h4 align ="center"><bold>------or Signin using Google-------</bold></h4>
     
    </div>
    
   <!-- <h2 align="center">Login using Google Account with PHP</h2> -->
   <!-- <br /> -->
    <div class="panel panel-default">
   <?php
   if(!empty($_SESSION['access_token']))
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name : </b>'.$_SESSION["first_name"].' '.$_SESSION['last_name']. '</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button.'</div>';
   } 
   ?>
   </div>
  </div>
    </form>
    </div>
    </div>
  
</body>
</html>