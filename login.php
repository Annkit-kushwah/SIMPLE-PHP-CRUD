<?php
session_start();
$connection = mysqli_connect('localhost', 'root','','test');
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = mysqli_query($connection , "select * from tbl_test where email = '{$email}'");
  
    $count  =mysqli_num_rows($q);
   if($count>0){

    $_SESSION['email'] = $email;
    $row = mysqli_fetch_array($q);
    $varify = password_verify($password, $row['password']);

    if($varify== 1){
        header("Location:display.php");
    }else{
        echo "<script>alert(' your password is incorrect')</script>";
    }
   }else{
    echo "<script>alert('user is not exist')</script>";
   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>
<body>
    <h1>Login From</h1>
    <form action="" method="post" enctype="multipart/form-data">

Email : <input type="email" name="email" placeholder="Enter your email address"> <br><br>
Password : <input type="password" name="password" placeholder="Enter your password"> <br><br>


<input type="submit" value="submit">

<a href="registration.php">Registration</a>

    </form>
</body>
</html>