<?php
session_start();
$connection = mysqli_connect('localhost', 'root','','test');

if(isset($_GET['did'])){
    $did = $_GET['did'];


$deleteimg = mysqli_query($connection , "select  * from tbl_test where id = '{$did}'");
$row = mysqli_fetch_array($deleteimg);
unlink($row['img']);


    $dq = mysqli_query($connection, "delete from tbl_test where id = '{$did}'");
    if($dq) {

echo "<script>alert('Record deleted')</script>";
    }
}

if( $_SESSION['email'] == true){


$q = mysqli_query($connection , "SELECT * FROM tbl_test");

echo "<table border='2'>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Name</td>";
echo "<td>Email</td>";
echo "<td>Image</td>";
echo "<td>Action</td>";
echo "</tr>";

while ($row = mysqli_fetch_array($q)) {
    
echo "<tr>";
echo "<td>{$row['id']}</td>";
echo "<td>{$row['name']}</td>";
echo "<td>{$row['email']}</td>";
echo "<td> <img src='{$row['img']}' height='90px' width='90px'</td>";
echo "<td><a href='edit.php?eid={$row['id']}'> Edit</a> | <a href='display.php?did={$row['id']}'> Delete</a></td>";
echo "</tr>";


}
echo "</table>";
}
else{
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <a href="registration.php">Registration</a>
</body>
</html>