<?php
session_start();
$connection = mysqli_connect('localhost', 'root','','test');

$eid = $_GET['eid'];

$eq = mysqli_query($connection, "select * from tbl_test where id = '{$eid}'");

$row = mysqli_fetch_array($eq);

if($_POST){

  
    $name = $_POST['name'];
    $email = $_POST['email'];

    $oldimg = $_POST['oldimg'];
    if($_FILES['img']['name']!=""){

        $imgname = $_FILES['img']['name'];
        $tmpname = $_FILES['img']['tmp_name'];
        $folder = 'image/'. $imgname;
    
        move_uploaded_file($tmpname,$folder);

        $deleteimg = mysqli_query($connection , "select  * from tbl_test where id = '{$eid}'");
        $row = mysqli_fetch_array($deleteimg);
        unlink($row['img']);
        
    }else{

        $folder = $oldimg;
    }

    
      $q = mysqli_query($connection , "update tbl_test set name='{$name}',email='{$email}',img = '{$folder}' where id = '{$eid}'");
    
      if($q){
          echo "<script>alert('Record Updated');window.location='display.php'</script>";
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
    <form action="" method="post" enctype="multipart/form-data" id="myform">

Name : <input type="text" name="name" value="<?php echo $row['name']?>" placeholder="Enter Your name"  > <br><br>
Email : <input type="email" name="email" value="<?php echo $row['email']?>"  placeholder="Enter your email address" > <br><br>

<input type="hidden" name='oldimg' value="<?php echo $row['img']?>">

Old image = <img src="<?php echo $row['img']?>" height="90px" width="90px"  alt="" srcset=""><br><br>
Image : <input type="file" name="img" id=""  ><br><br>

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