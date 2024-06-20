<?php
session_start();
$connection = mysqli_connect('localhost', 'root','','test');

if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = password_hash($password, PASSWORD_BCRYPT);

    $imgname = $_FILES['img']['name'];
    $tmpname = $_FILES['img']['tmp_name'];
    $folder = 'image/'. $imgname;

    move_uploaded_file($tmpname,$folder);


  $emailq = mysqli_query($connection , "select * from tbl_test where email = '{$email}'");

  $count = mysqli_num_rows($emailq);

  if($count>0){
    echo "<script>alert('email is already taken')</script>";
  }
  else{

      $q = mysqli_query($connection , "insert into tbl_test (name, email, password,img) values('{$name}', '{$email}', '{$password1}','{$folder}')");
    
      if($q){
          echo "<script>alert('Record Added');window.location='login.php'</script>";
      }
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
    <h1>Registration Form</h1>
    <form action="" method="post" enctype="multipart/form-data" id="myform">

Name : <input type="text" name="name" placeholder="Enter Your name" required > <br><br>
Email : <input type="email" name="email" placeholder="Enter your email address" required> <br><br>
Password : <input type="password" name="password" placeholder="Enter your password" required> <br><br>

Image : <input type="file" name="img" id="" required ><br><br>
<a href="login.php">Login</a>
<input type="submit" value="submit">


    </form>
</body>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>


<script>
    $(document).ready(function() {
        $('#myform').validate();
    })
</script>
<style>
    .error{
        color : red;
    }
</style>
</html>